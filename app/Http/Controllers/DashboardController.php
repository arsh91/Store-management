<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Users;
use App\Models\Stores;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $Stores = $this->getAllStores();
        if (auth()->user()->role_id==env('SUPER_ADMIN'))
		{
            $userCount = Users::where('store_id',session('storeId'))->orderBy('id','desc')->get()->count();
        }
        else
        {
            $userCount=Users::where('store_id',session('storeId'))->get()->count();
        }
        return view('dashboard.index',compact('userCount','Stores'));
    }

    public function selectStore(Request $request)
    {
        session(['storeId' => $request->selectStore]);
        return redirect()->back()->with(['status'=>200]);
    }
}