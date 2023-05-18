<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreOutwardVendors;

class StoreOutwardVendorsController extends Controller
{
     /**
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $Stores = $this->getAllStores();
		$StoreOutwardVendors=StoreOutwardVendors::where('store_id',session('storeId'))->orderBy('id','desc')->get(); //database query
        return view('storeoutwardvendors.index',compact('Stores','StoreOutwardVendors'));
		
    }

    public function create()
    {
        $Stores = $this->getAllStores();
        return view('storeoutwardvendors.create',compact('Stores'));
		
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
       	
        $StoreOutwardVendors =StoreOutwardVendors::create([
            'store_id' => session('storeId'),
            'vendor_name' => $validated['vendor_name'],
            'vendor_description' => $validated['vendor_description'],
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);
		$request->session()->flash('message','Store outward vendor added successfully.');
        return redirect('/storeoutwardvendors')->with(['status'=>200, 'Store'=>$StoreOutwardVendors]);
    }
	
	 public function edit(Request $request)
    {   
        $Stores = $this->getAllStores();
		$storeoutwardvendors=StoreOutwardVendors::where('id',$request->id)->first(); //database query
        return view('storeoutwardvendors.edit', compact('storeoutwardvendors', 'Stores'));
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
      
        StoreOutwardVendors::where('id',$id)  
		->update([
            'vendor_name' => $validated['vendor_name'],
            'vendor_description' => $validated['vendor_description'],
            'updated_by' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $request->session()->flash('message','Store outward Vendor updated successfully.');
        return redirect('/storeoutwardvendors')->with(['status'=>200]);
    }

	 public function destroy(Request $request)
    {
        StoreOutwardVendors::where('id',$request->id)->update(['deleted_by' => auth()->user()->id]);
        $StoreOutwardVendors = StoreOutwardVendors::where('id',$request->id)->delete(); 
		$request->session()->flash('message','Store outward vendor deleted successfully.');
        return Response()->json(['status'=>200]);  
    }
}