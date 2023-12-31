<?php

namespace App\Http\Controllers;

use App\Interfaces\CoinInterface;
use App\Jobs\ProcessCoinRate;
use App\Models\Coin;
use App\Models\CoinPricePump;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

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
                ->addColumn('buy_profit', function ($coin) {
                    return $coin->buy_profit;
                })
                ->addColumn('sell_profit', function ($coin) {
                    return $coin->sell_profit;
                })
                ->addColumn('actions', function ($coin) {
                    return '<a href="javascript:void(0);" data-id="' . $coin->id . '"
                    class="btn btn-sm btn-create-pump btn-dark mr-1" ><i class="fas fa-bolt mr-1"></i>Create Pump</a>
                    <a href="javascript:void(0);" data-id="' . $coin->id . '"
                    class="btn btn-sm btn-view-pump btn-primary mr-1" ><i class="fas fa-eye mr-1"></i>View Pump</a>
                    <a href="javascript:void(0);" data-id="' . $coin->id . '"
                    class="btn btn-sm btn-edit btn-secondary mr-1" ><i class="fas fa-edit mr-1"></i>Edit</a>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.coins.listing');
    }

    public function coinModal($id = null)
    {
        if ($id) {
            $res["title"] = 'Edit Coin';
            $coin = Coin::find($id);
            $res["html"] = view('admin.coins.form', compact(['coin']))->render();
        } else {
            $res["title"] = 'Add New Coin';
            $res["html"] = view('admin.coins.form')->render();
        }

        return response()->json($res);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'min_value' => 'required',
            'max_value' => 'required',
            'buy_profit' => 'required',
            'sell_profit' => 'required'
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

    public function generateCoinRateData(Request $request, $id, $dateParam)
    {
        ini_set('max_execution_time', 0);
        date_default_timezone_set('UTC');
        $date = strtotime($dateParam . ' 00:00:00');
        $endDate = strtotime($dateParam . ' 03:59:59');
        $arr = [];
        $coin = Coin::find($id);

        while ($date <= $endDate) {
            $rate = rand($coin->min_value, $coin->max_value);
            array_push($arr, ['rate' => $rate, 'coin_id' => $id, 'timestamp' => $date]);
//            $date = date ("Y-m-d H:i:s", strtotime("+1 second", strtotime($date)));
            $date = strtotime("+1 second", $date);
        }

        if (dispatch(new ProcessCoinRate($arr))) {
            return redirect('admin/dashboard')->with('success', 'data generated !');
        }

        return redirect('admin/dashboard')->with('error', 'something went wrong !');
    }

    public function getCoinRateData(Request $request, $coinId)
    {
//        $priceData = DB::table('coin_rates')->selectRaw("
//            (FLOOR((timestamp) / 5) * 5) AS interval_start,
//            MIN(rate) AS low_price,
//            MAX(rate) AS high_price,
//            SUBSTRING_INDEX(GROUP_CONCAT(rate ORDER BY timestamp ASC), ',', 1) AS open_price,
//            SUBSTRING_INDEX(GROUP_CONCAT(rate ORDER BY timestamp DESC), ',', 1) AS close_price")
//            ->groupBy('interval_start')
//            ->orderBy('interval_start')
//            ->get()->toArray();

        // Prepare data for the chart
//        $candleData = [];
//        foreach ($priceData as $price) {
//            $candleData[] = [
//                ($price->interval_start) * 1000, // Convert to milliseconds
//                (int) $price->open_price,
//                $price->high_price,
//                $price->low_price,
//                (int) $price->close_price,
//            ];
//        }
//        ini_set('max_execution_time', 0);

        date_default_timezone_set('Asia/Karachi');
        $coin = Coin::find($coinId);
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $coin->created_at);
        $now = Carbon::now();

        $diffInMinutes = $now->diffInMinutes($date);

        $res = [
            'id' => $coin->id,
            'name' => $coin->name,
            'coin_price' => $coin->price,
            'coin_max_price' => $coin->max_value,
            'coin_min_price' => $coin->min_value,
            'diff_in_min' => $diffInMinutes,
            'buy_profit' => $coin->buy_profit,
            'sell_profit' => $coin->sell_profit
        ];

//        $chartData = [];
//        $res = [];
//        $i = 0;
//        while ($date <= $endDate) {
//            $open = rand($coin->min_value, $coin->max_value);
//            $close = rand($coin->min_value, $coin->max_value);
//            $high = max(range($open, $close));
//            $low = min(range($open, $close));
//
//            $chartData[$i]['x'] = [$date];
//            $chartData[$i]['y'] = [$open, $high, $low, $close];
//
//
//
//            $date = strtotime("+1 second", $date);
//            $i++;
//        }

//        $res = $chartData;

        return response()->json($res);
    }

    public function coinPumpModal($coinId)
    {
        $res["title"] = 'Pump Coin Price';
        $res["html"] = view('admin.coins.pump.form', compact(['coinId']))->render();

        return response()->json($res);
    }

    public function viewCoinPumpModal($coinId)
    {
        $pump = CoinPricePump::with('coin')->where('coin_id', $coinId)->first();
//        dd($pump);
        $res["title"] = 'Coin Pump';
        $res["html"] = view('admin.coins.pump.view', compact(['pump']))->render();

        return response()->json($res);
    }

    public function storeCoinPump(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coin_id' => 'required',
            'pump_type' => 'required',
            'start_date_time' => 'required',
            'end_date_time' => 'required'
        ]);
        if (!$validator->fails()) {
            $res = $this->coinInterface->storeCoinPump($request);
            if ($res) {
                $msg ='Coin Pump Created';

                return redirect('admin/coins')->with('success', $msg);
            } else {
                return redirect('admin/coins')->with('error', 'Something went wrong');
            }
        } else {
            return redirect(url('admin/coins'))->withErrors($validator->errors());
        }
    }


    public function getCoinPump(Request $request, $coinId){
        $pump = CoinPricePump::where('coin_id', $coinId)->first();

        return response()->json(['success' => $pump ? 1 : 0, 'data' => $pump]);
    }

}
