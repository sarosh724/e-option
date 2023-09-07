<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Interfaces\SettingInterface;
use App\Models\Referral;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    /**
     * @var SettingInterface
     */
    protected SettingInterface $settingInterface;

    public function __construct(SettingInterface $settingInterface)
    {
        $this->settingInterface = $settingInterface;
    }

    /**
     * Register api
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required | min: 8 | max: 12',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        DB::beginTransaction();
        try {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['demo_account_balance'] = $this->settingInterface->getDemoAmount();
        $user = User::create($input);

        if ($request->refcode) {
            $refAmount = Setting::first()->referral_sign_up_amount;
            $u = User::where("id", base64_decode($request->refcode))->first();
            $u->account_balance +=  $refAmount;
            $u->save();
            # adding record in referral table
            Referral::create(['referred_by' => base64_decode($request->refcode), 'referral' => $user->id]);
        }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError('something went wrong', 'User register Unsuccessful.');
        }

        $success['token'] = $user->createToken('EOption')->plainTextToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, 'User registered successfully.');
    }

    /**
     * Login api
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function login(Request $request): JsonResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('EOption')->plainTextToken;
            $success['name'] = $user->name;

            return $this->sendResponse($success, 'User login successful');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    public function logout(Request $request)
    {
        if (auth()->user()->tokens()->delete()) {
            return $this->sendResponse('', 'User logged out');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

}
