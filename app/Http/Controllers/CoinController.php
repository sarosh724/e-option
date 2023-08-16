<?php

namespace App\Http\Controllers;

use App\Interfaces\CoinInterface;
use App\Models\Coin;
use App\Models\CoinRate;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class CoinController extends Controller
{
    /**
     * @var
     */
    protected CoinInterface $coinInterface;

    public function __construct(CoinInterface $coinInterface)
    {
        $this->coinInterface = $coinInterface;
    }

    public function index(Request $request, $id = null)
    {
        if ($request->ajax()) {
            $coin = $this->coinInterface->coinListing($request, $id);

            return DataTables::of($coin)
                ->addColumn('name', function ($coin) {
                    return $coin->name;
                })
                ->addColumn('price', function ($coin) {
                    return $coin->price;
                })
                ->addColumn('min_price', function ($coin) {
                    return $coin->min_value;
                })
                ->addColumn('max_price', function ($coin) {
                    return $coin->max_value;
                })
                ->addColumn('profit', function ($coin) {
                    return $coin->profit_percentage;
                })
                ->addColumn('actions', function ($coin) {
                    return '<a href="javascript:void(0);" data-id="' . $coin->id . '"
                    class="btn btn-sm btn-edit btn-primary mr-1" ><i class="fas fa-edit mr-1"></i>Edit</a>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.coins.listing');
    }

    public function coinModal($id = null){
        if($id){
            $res["title"]   = 'Edit Coin';
            $coin = Coin::find($id);
            $res["html"]    = view('admin.coins.form', compact(['coin']))->render();
        }
        else{
            $res["title"]   = 'Add New Coin';
            $res["html"]    = view('admin.coins.form')->render();
        }

        return response()->json($res);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'min_value' => 'required',
            'max_value' => 'required',
            'profit_percentage' => 'required'
        ]);
        if (!$validator->fails()) {
            $res = $this->coinInterface->storeCoin($request);
            if ($res) {
                $msg = $request->id ? 'Coin Updated' : 'Coin Added';
                return redirect('admin/coins')->with('success', $msg);
            } else {
                return redirect('admin/coins')->with('error', 'Something went wrong');
            }
        } else {
            return redirect(url('admin/coins'))->withErrors($validator->errors());
        }
    }

    public function generateCoinRateData(Request $request, $id){
//        ini_set('max_execution_time', 0);
        date_default_timezone_set('UTC');
        $date = '2023-08-16 00:00:00';
        $end_date = '2023-08-16 01:59:59';
        $arr = [];
        $coin = Coin::find($id);

        while (strtotime($date) <= strtotime($end_date)) {
            $rate = rand($coin->min_value, $coin->max_value);
            array_push($arr, ['rate' => $rate, 'coin_id' => $id, 'created_at' => $date]);
            $date = date ("Y-m-d H:i:s", strtotime("+1 second", strtotime($date)));
        }

        CoinRate::insert($arr);

        return redirect('admin/dashboard')->with('success', 'data generated !');
    }
}
