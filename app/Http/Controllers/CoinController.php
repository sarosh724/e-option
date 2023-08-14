<?php

namespace App\Http\Controllers;

use App\Interfaces\CoinInterface;
use App\Models\Coin;
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
            'price' => 'required'
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
}
