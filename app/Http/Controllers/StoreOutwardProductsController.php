<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreOutwardProducts;
use App\Models\StoreProductCategories;
use App\Models\StoreProducts;
use App\Models\StoreOutwardVendors;


class StoreOutwardProductsController extends Controller
{
     /**
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $Stores = $this->getAllStores();
        $StoreOutwardProducts=StoreOutwardProducts::with('storeproduct', 'storeoutwardvendors','outwardby')->where('store_id',session('storeId'))->orderBy('id','desc')->get();
        return view('storeoutwardproducts.index',compact('Stores','StoreOutwardProducts'));
    }

    public function create()
    {
        $StoreProducts =StoreProducts::where('store_id',session('storeId'))->orderBy('id','desc')->get();
        $StoreOutwardVendors =StoreOutwardVendors::where('store_id',session('storeId'))->orderBy('id','desc')->get(); //database query
        $Stores = $this->getAllStores();
        return view('storeoutwardproducts.create',compact('Stores','StoreProducts','StoreOutwardVendors'));
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
            'store_outward_vendor' => 'required',
            'stock_outward' => 'required',
            'outward_person' => 'required',
            'outward_image'=>'required|image|mimes:jpg,png,jpeg,gif', 
        ]);

        $outwardImage = time().'.'.$request->outward_image->extension(); 
		$request->outward_image->move(public_path('outwardImages'), $outwardImage);
		$path ='outwardImages/'.$outwardImage;

        $StoreOutwardProducts =StoreOutwardProducts::create([
            'store_id' => session('storeId'),
            'store_product_id' => $validated['store_product'],
            'store_outward_vendor_id' => $validated['store_outward_vendor'],
            'stock_outward' => $validated['stock_outward'],
            'outward_by' => auth()->user()->id,
            'outward_image' => $path,
            'outward_person' => $validated['outward_person'],
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);
		$request->session()->flash('message','Store outward product added successfully.');
        return redirect('/storeoutwardproducts')->with(['status'=>200, 'StoreOutwardProducts'=>$StoreOutwardProducts]);
    }
	
	 public function edit(Request $request)
    {   
        $Stores = $this->getAllStores();
		$StoreOutwardVendors =StoreOutwardVendors::where('store_id',session('storeId'))->orderBy('id','desc')->get(); 
        $StoreProducts =StoreProducts::where('store_id',session('storeId'))->orderBy('id','desc')->get();
        $storeoutwardproducts=StoreOutwardProducts::where('store_id',session('storeId'))->where('id',$request->id)->orderBy('id','desc')->first();
        return view('storeoutwardproducts.edit', compact('StoreOutwardVendors', 'Stores', 'storeoutwardproducts','StoreProducts'));
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
            'store_outward_vendor' => 'required',
            'stock_outward' => 'required',
            'outward_person' => 'required',
        ]);

        $validatedArr = [
            'store_id' => session('storeId'),
            'store_product_id' => $validated['store_product'],
            'store_outward_vendor_id' => $validated['store_outward_vendor'],
            'stock_outward' => $validated['stock_outward'],
            'outward_by' => auth()->user()->id,
            'outward_person' => $validated['outward_person'],
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        if($request->has('outward_image')){
            $outwardImage = time().'.'.$request->outward_image->extension(); 
            $request->outward_image->move(public_path('outwardImages'), $outwardImage);
            $path ='outwardImages/'.$outwardImage;
            $validatedArr['outward_image'] = $path;
        }
        
        StoreOutwardProducts::where('id',$id)  
		->update($validatedArr);

        $request->session()->flash('message','Store outward product updated successfully.');
        return redirect('/storeoutwardproducts')->with(['status'=>200]);
    }

	 public function destroy(Request $request)
    {
        StoreOutwardProducts::where('id',$request->id)->update(['deleted_by' => auth()->user()->id]);
        $StoreOutwardProducts = StoreOutwardProducts::where('id',$request->id)->delete(); 
		$request->session()->flash('message','Store outward product deleted successfully.');
        return Response()->json(['status'=>200]);  
    }
}