<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;

class UsersController extends Controller
{
    /**
	 * 
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
        $Users=Users::where([['store_id','=',session('storeId')], ['id','!=',auth()->user()->id], ['id','!=',1]])->orderBy('id','desc')->get(); //database query
        $Stores = $this->getAllStores();
		return view('users.index', compact('Stores','Users'));

    }

	public function create(){
		$Stores = $this->getAllStores();
		return view('users.create', compact('Stores'));
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
			'phone'=>'required|unique:users', 
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'district' => 'required',
			'email'=>'required|unique:users', 
			'password'=>'required|confirmed:', 
			'password_confirmation'=>'required', 
        ]);
        $pincode='';
        if(!empty($request->pincode)){
            $pincode= $request->pincode;
        }
       	
        $user =Users::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'state' => $validated['state'],
            'city' => $validated['city'],
            'district' => $validated['district'],
            'password' => $validated['password'],
            'pincode' => $pincode,
			'role_id' => 2,
			'store_id' =>session('storeId'),
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);
		$request->session()->flash('message','User added successfully.');
        return redirect('/users')->with(['status'=>200, 'user'=>$user]);
    }

    public function edit(Request $request)
    {   
        $Stores = $this->getAllStores();
		$usersData=Users::where('id',$request->id)->first(); //database query
        return view('users.edit', compact('usersData', 'Stores'));
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
			'phone'=>'required', 
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'district' => 'required',
			'email'=>'required', 
        ]);
        $pincode='';
        if(!empty($request->pincode)){
            $pincode= $request->pincode;
        }
       	
        Users::where('id',$id)  
		->update([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'state' => $validated['state'],
            'city' => $validated['city'],
            'district' => $validated['district'],
            'pincode' => $pincode,
            'updated_by' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $request->session()->flash('message','User updated successfully.');
        return redirect('/users')->with(['status'=>200]);
    }	
    public function destroy(Request $request)
    {
        Users::where('id',$request->id)->update(['deleted_by' => auth()->user()->id]);
        $users = Users::where('id',$request->id)->delete(); 
		$request->session()->flash('message','User deleted successfully.');
        return Response()->json(['status'=>200]);  
    }
}
