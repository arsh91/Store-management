<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreInwardVendors;

class StoreInwardVendorsController extends Controller
{
     /**
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $Stores = $this->getAllStores();
		$StoreInwardVendors=StoreInwardVendors::where('store_id',session('storeId'))->orderBy('id','desc')->get(); //database query
        return view('storeinwardvendors.index',compact('Stores','StoreInwardVendors'));
		
    }

    public function create()
    {
        $Stores = $this->getAllStores();
        return view('storeinwardvendors.create',compact('Stores'));
		
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
            'vendor_name' => 'required',
            'vendor_description' => 'required',
        ]);
       	
        $StoreInwardVendors =StoreInwardVendors::create([
            'store_id' => session('storeId'),
            'vendor_name' => $validated['vendor_name'],
            'vendor_description' => $validated['vendor_description'],
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);
		$request->session()->flash('message','Store Inward Vendor added successfully.');
        return redirect('/storeinwardvendors')->with(['status'=>200, 'Store'=>$StoreInwardVendors]);
    }
	
	 public function edit(Request $request)
    {   
        $Stores = $this->getAllStores();
		$storeinwardvendors=StoreInwardVendors::where('id',$request->id)->first(); //database query
        return view('storeinwardvendors.edit', compact('storeinwardvendors', 'Stores'));
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
            'vendor_name' => 'required',
            'vendor_description' => 'required',
        ]);
      
        StoreInwardVendors::where('id',$id)  
		->update([
            'vendor_name' => $validated['vendor_name'],
            'vendor_description' => $validated['vendor_description'],
            'updated_by' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $request->session()->flash('message','Store Inward Vendor updated successfully.');
        return redirect('/storeinwardvendors')->with(['status'=>200]);
    }

	 public function destroy(Request $request)
    {
        StoreInwardVendors::where('id',$request->id)->update(['deleted_by' => auth()->user()->id]);
        $StoreInwardVendors = StoreInwardVendors::where('id',$request->id)->delete(); 
		$request->session()->flash('message','Store inward vendor deleted successfully.');
        return Response()->json(['status'=>200]);  
    }
}