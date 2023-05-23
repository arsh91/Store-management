<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreInwardProducts;
use App\Models\StoreProductCategories;
use App\Models\StoreProducts;
use App\Models\StoreInwardVendors;


class StoreInwardProductsController extends Controller
{
     /**
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $Stores = $this->getAllStores();
        $StoreInwardProducts=StoreInwardProducts::with('storeproduct', 'storeinwardvendors','inwardby')->where('store_id',session('storeId'))->orderBy('id','desc')->get();
        return view('storeinwardproducts.index',compact('Stores','StoreInwardProducts'));
    }

    public function create()
    {
        $StoreProducts =StoreProducts::where('store_id',session('storeId'))->orderBy('id','desc')->get();
        $StoreInwardVendors =StoreInwardVendors::where('store_id',session('storeId'))->orderBy('id','desc')->get(); //database query
        $Stores = $this->getAllStores();
        return view('storeinwardproducts.create',compact('Stores','StoreProducts','StoreInwardVendors'));
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
            'store_inward_vendor' => 'required',
            'stock_inward' => 'required',
            'product_price' => 'required',
            'total_amount' => 'required',
            'bill_no' => 'required',
            'inward_person_from' => 'required',
            'bill_image'=>'required|image|mimes:jpg,png,jpeg,gif', 
        ]);

        $billImage = time().'.'.$request->bill_image->extension(); 
		$request->bill_image->move(public_path('billImages'), $billImage);
		$path ='billImages/'.$billImage;

        $StoreInwardProducts =StoreInwardProducts::create([
            'store_id' => session('storeId'),
            'store_product_id' => $validated['store_product'],
            'store_inward_vendor_id' => $validated['store_inward_vendor'],
            'stock_inward' => $validated['stock_inward'],
            'inward_by' => auth()->user()->id,
            'product_price' => $validated['product_price'],
            'total_amount' => $validated['total_amount'],
            'bill_no' => $validated['bill_no'],
            'bill_image' => $path,
            'inward_person_from' => $validated['inward_person_from'],
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);
		$request->session()->flash('message','Store inward product added successfully.');
        return redirect('/storeinwardproducts')->with(['status'=>200, 'StoreInwardProducts'=>$StoreInwardProducts]);
    }
	
	 public function edit(Request $request)
    {   
        $Stores = $this->getAllStores();
		$StoreInwardVendors =StoreInwardVendors::where('store_id',session('storeId'))->orderBy('id','desc')->get(); 
        $StoreProducts =StoreProducts::where('store_id',session('storeId'))->orderBy('id','desc')->get();
        $storeinwardproducts=StoreInwardProducts::where('store_id',session('storeId'))->where('id',$request->id)->orderBy('id','desc')->first();
        return view('storeinwardproducts.edit', compact('StoreInwardVendors', 'Stores', 'storeinwardproducts','StoreProducts'));
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
            'store_inward_vendor' => 'required',
            'stock_inward' => 'required',
            'product_price' => 'required',
            'total_amount' => 'required',
            'bill_no' => 'required',
            'inward_person_from' => 'required',
        ]);

        $validatedArr = [
            'store_id' => session('storeId'),
            'store_product_id' => $validated['store_product'],
            'store_inward_vendor_id' => $validated['store_inward_vendor'],
            'stock_inward' => $validated['stock_inward'],
            'inward_by' => auth()->user()->id,
            'product_price' => $validated['product_price'],
            'total_amount' => $validated['total_amount'],
            'bill_no' => $validated['bill_no'],
            'inward_person_from' => $validated['inward_person_from'],
            'updated_by' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if($request->has('bill_image')){
            $billImage = time().'.'.$request->bill_image->extension(); 
            $request->bill_image->move(public_path('billImages'), $billImage);
            $path ='billImages/'.$billImage;
            $validatedArr['bill_image'] = $path;
        }
        

        StoreInwardProducts::where('id',$id)  
		->update($validatedArr);

        $request->session()->flash('message','Store inward product updated successfully.');
        return redirect('/storeinwardproducts')->with(['status'=>200]);
    }

	 public function destroy(Request $request)
    {
        StoreInwardProducts::where('id',$request->id)->update(['deleted_by' => auth()->user()->id]);
        $StoreInwardProducts = StoreInwardProducts::where('id',$request->id)->delete(); 
		$request->session()->flash('message','Store inward product deleted successfully.');
        return Response()->json(['status'=>200]);  
    }
}