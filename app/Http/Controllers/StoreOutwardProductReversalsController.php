<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreOutwardProducts;
use App\Models\StoreOutwardVendors;
use App\Models\StoreProducts;
use App\Models\StoreOutwardProductReversals;


class StoreOutwardProductReversalsController extends Controller
{
     /**
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $Stores = $this->getAllStores();
        $StoreOutwardProductReversals=StoreOutwardProductReversals::with('storeproduct')->where('store_id',session('storeId'))->orderBy('id','desc')->get();
        return view('storeoutwardproductreversals.index',compact('Stores','StoreOutwardProductReversals'));
    }

    public function create()
    {
        $StoreProducts =StoreProducts::where('store_id',session('storeId'))->orderBy('id','desc')->get();
        $StoreOutwardVendors =StoreOutwardVendors::where('store_id',session('storeId'))->orderBy('id','desc')->get(); //database query
        $Stores = $this->getAllStores();
        return view('storeoutwardproductreversals.create',compact('Stores','StoreProducts','StoreOutwardVendors'));
    }
  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'store_product' => 'required',
            'outward' => 'required',
            'reversal_quantity' => 'required',
        ]);

        $StoreOutwardProductReversals =StoreOutwardProductReversals::create([
            'store_id' => session('storeId'),
            'store_product_id' => $validated['store_product'],
            'outward_id' => $validated['outward'],
            'reversal_quantity' => $validated['reversal_quantity'],
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);
		$request->session()->flash('message','Store outward product reversal added successfully.');
        return redirect('/storeoutwardproductreversals')->with(['status'=>200, 'StoreOutwardProductReversals'=>$StoreOutwardProductReversals]);
    }
	
	 public function edit(Request $request)
    {   
        $Stores = $this->getAllStores();
		$StoreOutwardVendors =StoreOutwardVendors::where('store_id',session('storeId'))->orderBy('id','desc')->get(); 
        $StoreProducts =StoreProducts::where('store_id',session('storeId'))->orderBy('id','desc')->get();
        $storeoutwardproductreversals=StoreOutwardProductReversals::where('store_id',session('storeId'))->where('id',$request->id)->orderBy('id','desc')->first();
        return view('storeoutwardproductreversals.edit', compact('StoreOutwardVendors', 'Stores', 'storeoutwardproductreversals','StoreProducts'));
    }
	/**
     * Update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {		
        $validated = $request->validate([
            'store_product' => 'required',
            'outward' => 'required',
            'reversal_quantity' => 'required',
        ]);

        StoreOutwardProductReversals::where('id',$id)  
		->update([
            'store_id' => session('storeId'),
            'store_product_id' => $validated['store_product'],
            'outward_id' => $validated['outward'],
            'reversal_quantity' => $validated['reversal_quantity'],
            'updated_by' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $request->session()->flash('message','Store outward product Reversal updated successfully.');
        return redirect('/storeoutwardproductreversals')->with(['status'=>200]);
    }

	 public function destroy(Request $request)
    {
        StoreOutwardProductReversals::where('id',$request->id)->update(['deleted_by' => auth()->user()->id]);
        $StoreOutwardProductReversals = StoreOutwardProductReversals::where('id',$request->id)->delete(); 
		$request->session()->flash('message','Store outward product Reversal deleted successfully.');
        return Response()->json(['status'=>200]);  
    }
}