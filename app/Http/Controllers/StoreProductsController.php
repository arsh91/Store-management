<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreProducts;
use App\Models\StoreProductCategories;

class StoreProductsController extends Controller
{
     /**
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $Stores = $this->getAllStores();
        $StoreProducts=StoreProducts::with('productcategory')->where('store_id',session('storeId'))->orderBy('id','desc')->get();
        return view('storeproducts.index',compact('Stores','StoreProducts'));
    }

    public function create()
    {
		$StoreProductCategories =StoreProductCategories::where('store_id',session('storeId'))->orderBy('id','desc')->get(); //database query
        $Stores = $this->getAllStores();
        return view('storeproducts.create',compact('Stores','StoreProductCategories'));
		
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
            'product_code' => 'required',
            'product_name' => 'required',
            'product_description' => 'required',
            'current_stock' => 'required',
            'min_price' => 'required',
            'max_price' => 'required',
            'product_category' => 'required',
            'product_image'=>'required|image|mimes:jpg,png,jpeg,gif', 
        ]);

        $productPicture = time().'.'.$request->product_image->extension(); 
		$request->product_image->move(public_path('productImages'), $productPicture);
		$path ='productImages/'.$productPicture;

        $StoreProducts =StoreProducts::create([
            'store_id' => session('storeId'),
            'product_code' => $validated['product_code'],
            'product_name' => $validated['product_name'],
            'product_description' => $validated['product_description'],
            'current_stock' => $validated['current_stock'],
            'min_price' => $validated['min_price'],
            'max_price' => $validated['max_price'],
            'product_category_id' => $validated['product_category'],
            'product_image' => $path,
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);
		$request->session()->flash('message','Store product added successfully.');
        return redirect('/storeproducts')->with(['status'=>200, 'StoreProducts'=>$StoreProducts]);
    }
	
	 public function edit(Request $request)
    {   
        $Stores = $this->getAllStores();
		$StoreProductCategories =StoreProductCategories::where('store_id',session('storeId'))->orderBy('id','desc')->get();
        $storeproducts=StoreProducts::where('store_id',session('storeId'))->where('id',$request->id)->orderBy('id','desc')->first();
        return view('storeproducts.edit', compact('StoreProductCategories', 'Stores', 'storeproducts'));
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
            'product_code' => 'required',
            'product_name' => 'required',
            'product_description' => 'required',
            'current_stock' => 'required',
            'min_price' => 'required',
            'max_price' => 'required',
            'product_category' => 'required',
        ]);

        $validatedArr = [
            'store_id' => session('storeId'),
            'product_code' => $validated['product_code'],
            'product_name' => $validated['product_name'],
            'product_description' => $validated['product_description'],
            'current_stock' => $validated['current_stock'],
            'min_price' => $validated['min_price'],
            'max_price' => $validated['max_price'],
            'product_category_id' => $validated['product_category'],
            'updated_by' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if($request->has('productImages')){
            $productPicture = time().'.'.$request->product_image->extension(); 
            $request->product_image->move(public_path('productImages'), $productPicture);
            $path ='productImages/'.$productPicture;
            $validatedArr['product_image'] = $path;
        }
       

        StoreProducts::where('id',$id)  
		->update($validatedArr);

        $request->session()->flash('message','Store product updated successfully.');
        return redirect('/storeproducts')->with(['status'=>200]);
    }

	 public function destroy(Request $request)
    {
        StoreProducts::where('id',$request->id)->update(['deleted_by' => auth()->user()->id]);
        $StoreProducts = StoreProducts::where('id',$request->id)->delete(); 
		$request->session()->flash('message','Store product deleted successfully.');
        return Response()->json(['status'=>200]);  
    }
}