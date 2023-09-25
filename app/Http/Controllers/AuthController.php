<?php

namespace App\Http\Controllers;

use App\Interfaces\SettingInterface;
use App\Models\Referral;
use App\Models\Setting;
use App\Models\User;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    protected SettingInterface $settingInterface;

    public function __construct(SettingInterface $settingInterface)
    {
        $this->settingInterface = $settingInterface;
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->stateless()
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')
                ->stateless()
                ->user();

            $finduser = User::where('google_id', $user->id)->orWhere('email', $user->email)
                ->first();

            if ($finduser) {
                Auth::login($finduser);

                return redirect()->intended('/');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('eoptionpasswd'),
                    'demo_account_balance' => $this->settingInterface->getDemoAmount(),
                ]);

                Auth::login($newUser);

                return redirect()->intended('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function login(Request $request)
    {
        if ($request->post()) {

            $credentials = $request->validate([
                'email' => ['required'],
                'password' => ['required'],
            ]);

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1])) {
                $request->session()
                    ->regenerate();

                return redirect()->intended('admin');
            } elseif (Auth::attempt($credentials)) {
                $request->session()
                    ->regenerate();

                return redirect(url('/market'));
            }

            return back()
                ->withErrors([
                    'email' => 'Email Or Password Is Not Correct',
                ])
                ->onlyInput('email');
        }

//        return view('auth.login');
        return view('user-site.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()
            ->invalidate();

        $request->session()
            ->regenerateToken();

        return redirect('login');
    }

    public function register(Request $request)
    {
        if ($request->post()) {
            $validator = Validator::make($request->all(), [
                'name' => 'required | max:50',
                'email' => 'required | email | max:200 | unique:users',
                'password' => 'required | min:8'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            DB::beginTransaction();
            try {
                $newUser = new User();
                $newUser->email = preg_replace('/\s+/', '', strtolower($request->email));
                $newUser->password = password_hash($request->password, PASSWORD_DEFAULT);
                $newUser->name = $request->name;
                $newUser->country = $request->country;
                $newUser->demo_account_balance = $this->settingInterface->getDemoAmount();
                $newUser->save();

                if ($request->refCode) {
                    $refAmount = Setting::first()->referral_sign_up_amount;
                    $u = User::where("id", base64_decode($request->refCode))->first();
                    $u->account_balance +=  $refAmount;
                    $u->save();
                    # adding record in referral table
                    Referral::create(['referred_by' => base64_decode($request->refCode), 'referral' => $newUser->id]);
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();

                //dd($e);
                return redirect(url('register'));
            }

            if ($newUser) {
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    $request->session()
                        ->regenerate();

                    return redirect(url('/market'));
                }
            }
        }

        $refCode = $request->get('refcode');

        return view('user-site.register', compact('refCode'));
    }

    public function forgotPassword(Request $request){

        if($request->all()) {
            $validation = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);

            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation->errors());
            }

            $user = User::where('email', $request->post('email')) -> first();

            if($user) {
                $token = Str::random(64);
                $password_reset_token_expiry_datetime = date("Y-m-d G:i:s", strtotime('+180 minutes'));

                $user -> password_reset_token = $token;
                $user -> password_reset_token_expiry_datetime = $password_reset_token_expiry_datetime;
                $user -> save();

                //return view('mails.password-forgot', compact(['token', 'user']));
                $is_mail_send = send_email($user -> email, "Reset password",  ['user' => $user] , 'password-forgot');
                if(!$is_mail_send){
                    return redirect() -> back() -> with('error', 'Email was not sent, please contact to administrator.');
                }
                return redirect( 'forgot-password') -> with('success', "If it is registered email, we sent you an email which includes instructions to reset your password. please check spam in case you didn't receive it.");

            }
            return redirect('forgot-password') -> with('success', "If it is registered email, We sent you an email which includes instructions to reset your password. please check spam in case you didn't receive it");
        }
        return view('site.pages.forgot-password');

    }

    public function resetPassword($token) {

        if(!$token) {
            return redirect( route('/') ) -> with('error', 'No token found.');
        }

        $user = DB::table('users')->where('password_reset_token', $token)->first();

        //if token not found in database
        if(!$user) {
            return redirect( route('forgot-password') ) -> with('error', 'Password reset request was invalid or it has been expired.');
        }

        // check token expiry if greater than 1 hour
        if($user){
            $date1 = new DateTime(date('Y-m-d h:i:s'));
            $date2 = new DateTime($user -> password_reset_token_expiry_datetime);
            $interval = $date1->diff($date2);
            $hour = $interval->format('%h');
            if($hour ==  0  ){
                return redirect( route('forgot-password') ) -> with('error', 'Password reset request was invalid or it has been expired.');
            }
        }

        return view('site.pages.reset-password')->with(compact(['user']));
    }

    public function doResetPassword(Request $request) {

        $validation = Validator::make($request->all(), [
            'password' => 'min:8|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:8',
            'token'   => 'required'
        ]);
        if ($validation->fails()) {
            $res['status'] = false;
            $res['message'] = implode('<br>', $validation->errors()->all());
//            return response()->json($res);
            return redirect()->back()->with('error', $res['message']);
        }
        $token = ($request -> post('token'));

        $user = User::where('password_reset_token', $token)->first();
        // check token is valid or not
        if($user){
            // Update user password with the new one
            $user -> password = password_hash($request -> post('password'), PASSWORD_DEFAULT);

            // update token after setting new password
            $user ->password_reset_token = Str::random(64);
            $user -> save();
            $res['message'] = 'Password has been reset successfully';
            return redirect('login')->with('success', $res['message']);
        }
        $res['message'] = 'Invalid token';

        return redirect('login')->with('error', $res['message']);
    }

}
