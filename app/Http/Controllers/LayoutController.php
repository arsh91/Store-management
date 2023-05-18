<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Users;
use App\Models\Stores;

use Carbon\Carbon;

class LayoutController extends Controller
{
    /**
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $Stores = Stores::orderBy('storeId','desc')->get();
        return view('layout',compact('Stores'));
    }
}