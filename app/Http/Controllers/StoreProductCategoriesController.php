<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreProductCategories;

class StoreProductCategoriesController extends Controller
{
     /**
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $Stores = $this->getAllStores();
		$StoreProductCategories=StoreProductCategories::where('store_id',session('storeId'))->orderBy('id','desc')->get(); //database query
        return view('storeproductcategories.index',compact('Stores','StoreProductCategories'));
		
    }

    public function create()
    {
        $Stores = $this->getAllStores();
        return view('storeproductcategories.create',compact('Stores'));
		
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
            'category_name' => 'required',
        ]);
       	
        $StoreProductCategories =StoreProductCategories::create([
            'store_id' => session('storeId'),
            'category_name' => $validated['category_name'],
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);
		$request->session()->flash('message','Store product category added successfully.');
        return redirect('/storeproductcategories')->with(['status'=>200, 'Store'=>$StoreProductCategories]);
    }
	
	 public function edit(Request $request)
    {   
        $Stores = $this->getAllStores();
		$storeproductcategories=StoreProductCategories::where('id',$request->id)->first(); //database query
        return view('storeproductcategories.edit', compact('storeproductcategories', 'Stores'));
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
            'category_name' => 'required',
        ]);
      
        StoreProductCategories::where('id',$id)  
		->update([
            'category_name' => $validated['category_name'],
            'updated_by' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $request->session()->flash('message','Store product category updated successfully.');
        return redirect('/storeproductcategories')->with(['status'=>200]);
    }

	 public function destroy(Request $request)
    {
        StoreProductCategories::where('id',$request->id)->update(['deleted_by' => auth()->user()->id]);
        $StoreProductCategories = StoreProductCategories::where('id',$request->id)->delete(); 
		$request->session()->flash('message','Store product category deleted successfully.');
        return Response()->json(['status'=>200]);  
    }
}