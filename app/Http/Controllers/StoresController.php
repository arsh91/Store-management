<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stores;

class StoresController extends Controller
{
     /**
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
		$Stores=Stores::orderBy('storeId','desc')->get(); //database query
        return view('stores.index',compact('Stores'));
		
    }

    public function create()
    {
        $Stores = $this->getAllStores();
        return view('stores.create',compact('Stores'));
		
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
            'name' => 'required',
            'location' => 'required',
            'city' => 'required',
            'state' => 'required',
        ]);
        $pincode='';
        if(!empty($request->pincode)){
            $pincode= $request->pincode;
        }
       	
        $Store =Stores::create([
            'name' => $validated['name'],
            'location' => $validated['location'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'pincode' => $pincode,
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);
		$request->session()->flash('message','Store added successfully.');
        return redirect()->back()->with(['status'=>200, 'Store'=>$Store]);
    }
	
	 public function edit(Request $request)
    {   
        $Stores = $this->getAllStores();
		$storeData=Stores::where('storeId',$request->id)->first(); //database query
        return view('stores.edit', compact('storeData', 'Stores'));
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
            'name' => 'required',
            'location' => 'required',
            'city' => 'required',
            'state' => 'required',
        ]);
        $pincode='';
        if(!empty($validated['pincode'])){
            $pincode= $request->pincode;
        }
       	
        Stores::where('storeId',$id)  
		->update([
            'name' => $validated['name'],
            'location' => $validated['location'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'pincode' => $pincode,
            'updated_by' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $request->session()->flash('message','Store updated successfully.');
        return redirect()->back()->with(['status'=>200]);
    }		
	 public function destroy(Request $request)
    {
        Stores::where('storeId',$request->id)->update(['deleted_by' => auth()->user()->id]);
        $Stores = Stores::where('storeId',$request->id)->delete(); 
		$request->session()->flash('message','Store deleted successfully.');
        return Response()->json(['status'=>200]);  
    }
    public function storeStatusChange(Request $request){

        Stores::where('storeId', $request->storeId)
		->update([
		'active' => $request->status
		]);
		$request->session()->flash('message','Store status updated  successfully.');
		return Response()->json(['status'=>200]);
    }
}