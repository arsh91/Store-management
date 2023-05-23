<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StoresController;
use App\Http\Controllers\StoreInwardVendorsController;
use App\Http\Controllers\StoreOutwardVendorsController;
use App\Http\Controllers\StoreProductCategoriesController;
use App\Http\Controllers\StoreProductsController;
use App\Http\Controllers\StoreInwardProductsController;
use App\Http\Controllers\StoreOutwardProductsController;
use App\Http\Controllers\StoreOutwardProductReversalsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 Route::get('/', function () {
    return view('welcome');
 });

/**
* Login Routes
*/
Route::get('/', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.user');
Route::group(['middleware' => ['auth']], function() {
	Route::resource('/dashboard', DashboardController::class);
	Route::middleware(['storepermission'])->group(function () {
		Route::get('/users', [UsersController::class, 'index'])->name('users.index');
		Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
		Route::post('/users/store', [UsersController::class, 'store'])->name('users.store');
		Route::get('/users/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
		Route::post('/users/update/{id}', [UsersController::class, 'update'])->name('users.update');
		Route::delete('/users/delete', [UsersController::class, 'destroy']);
		Route::post('/update/users/status', [UsersController::class, 'updateUserStatus']);

		Route::get('/storeinwardvendors', [StoreInwardVendorsController::class, 'index'])->name('storeinwardvendors.index');
		Route::get('/storeinwardvendors/create', [StoreInwardVendorsController::class, 'create'])->name('storeinwardvendors.create');
		Route::post('/storeinwardvendors/store', [StoreInwardVendorsController::class, 'store'])->name('storeinwardvendors.store');
		Route::get('/storeinwardvendors/edit/{id}', [StoreInwardVendorsController::class, 'edit'])->name('storeinwardvendors.edit');
		Route::post('/storeinwardvendors/update/{id}', [StoreInwardVendorsController::class, 'update'])->name('storeinwardvendors.update');
		Route::delete('/storeinwardvendors/delete', [StoreInwardVendorsController::class, 'destroy']);

		Route::get('/storeoutwardvendors', [StoreOutwardVendorsController::class, 'index'])->name('storeoutwardvendors.index');
		Route::get('/storeoutwardvendors/create', [StoreOutwardVendorsController::class, 'create'])->name('storeoutwardvendors.create');
		Route::post('/storeoutwardvendors/store', [StoreOutwardVendorsController::class, 'store'])->name('storeoutwardvendors.store');
		Route::get('/storeoutwardvendors/edit/{id}', [StoreOutwardVendorsController::class, 'edit'])->name('storeoutwardvendors.edit');
		Route::post('/storeoutwardvendors/update/{id}', [StoreOutwardVendorsController::class, 'update'])->name('storeoutwardvendors.update');
		Route::delete('/storeoutwardvendors/delete', [StoreOutwardVendorsController::class, 'destroy']);

		Route::get('/storeproductcategories', [StoreProductCategoriesController::class, 'index'])->name('storeproductcategories.index');
		Route::get('/storeproductcategories/create', [StoreProductCategoriesController::class, 'create'])->name('storeproductcategories.create');
		Route::post('/storeproductcategories/store', [StoreProductCategoriesController::class, 'store'])->name('storeproductcategories.store');
		Route::get('/storeproductcategories/edit/{id}', [StoreProductCategoriesController::class, 'edit'])->name('storeproductcategories.edit');
		Route::post('/storeproductcategories/update/{id}', [StoreProductCategoriesController::class, 'update'])->name('storeproductcategories.update');
		Route::delete('/storeproductcategories/delete', [StoreProductCategoriesController::class, 'destroy']);

		Route::get('/storeproducts', [StoreProductsController::class, 'index'])->name('storeproducts.index');
		Route::get('/storeproducts/create', [StoreProductsController::class, 'create'])->name('storeproducts.create');
		Route::post('/storeproducts/store', [StoreProductsController::class, 'store'])->name('storeproducts.store');
		Route::get('/storeproducts/edit/{id}', [StoreProductsController::class, 'edit'])->name('storeproducts.edit');
		Route::post('/storeproducts/update/{id}', [StoreProductsController::class, 'update'])->name('storeproducts.update');
		Route::delete('/storeproducts/delete', [StoreProductsController::class, 'destroy']);

		Route::get('/storeinwardproducts', [StoreInwardProductsController::class, 'index'])->name('storeinwardproducts.index');
		Route::get('/storeinwardproducts/create', [StoreInwardProductsController::class, 'create'])->name('storeinwardproducts.create');
		Route::post('/storeinwardproducts/store', [StoreInwardProductsController::class, 'store'])->name('storeinwardproducts.store');
		Route::get('/storeinwardproducts/edit/{id}', [StoreInwardProductsController::class, 'edit'])->name('storeinwardproducts.edit');
		Route::post('/storeinwardproducts/update/{id}', [StoreInwardProductsController::class, 'update'])->name('storeinwardproducts.update');
		Route::delete('/storeinwardproducts/delete', [StoreInwardProductsController::class, 'destroy']);

		Route::get('/storeoutwardproducts', [StoreOutwardProductsController::class, 'index'])->name('storeoutwardproducts.index');
		Route::get('/storeoutwardproducts/create', [StoreOutwardProductsController::class, 'create'])->name('storeoutwardproducts.create');
		Route::post('/storeoutwardproducts/store', [StoreOutwardProductsController::class, 'store'])->name('storeoutwardproducts.store');
		Route::get('/storeoutwardproducts/edit/{id}', [StoreOutwardProductsController::class, 'edit'])->name('storeoutwardproducts.edit');
		Route::post('/storeoutwardproducts/update/{id}', [StoreOutwardProductsController::class, 'update'])->name('storeoutwardproducts.update');
		Route::delete('/storeoutwardproducts/delete', [StoreOutwardProductsController::class, 'destroy']);

		Route::get('/storeoutwardproductreversals', [StoreOutwardProductReversalsController::class, 'index'])->name('storeoutwardproductreversals.index');
		Route::get('/storeoutwardproductreversals/create', [StoreOutwardProductReversalsController::class, 'create'])->name('storeoutwardproductreversals.create');
		Route::post('/storeoutwardproductreversals/store', [StoreOutwardProductReversalsController::class, 'store'])->name('storeoutwardproductreversals.store');
		Route::get('/storeoutwardproductreversals/edit/{id}', [StoreOutwardProductReversalsController::class, 'edit'])->name('storeoutwardproductreversals.edit');
		Route::post('/storeoutwardproductreversals/update/{id}', [StoreOutwardProductReversalsController::class, 'update'])->name('storeoutwardproductreversals.update');
		Route::delete('/storeoutwardproductreversals/delete', [StoreOutwardProductReversalsController::class, 'destroy']);
	});

	Route::get('logout', [LoginController::class, 'logOut'])->name('logout');
	
	Route::get('/stores', [StoresController::class, 'index'])->name('stores.index');
	Route::get('/stores/create', [StoresController::class, 'create'])->name('stores.create');
	Route::post('/stores/store', [StoresController::class, 'store'])->name('stores.store');
	Route::get('/stores/edit/{id}', [StoresController::class, 'edit'])->name('stores.edit');
	Route::post('/stores/update/{id}', [StoresController::class, 'update'])->name('stores.update');
	Route::post('/stores/statuschange', [StoresController::class,'storeStatusChange'])->name('stores.storeStatusChange');
	Route::post('/stores/selectstore', [DashboardController::class,'selectStore'])->name('stores.selectStore');
	Route::delete('/stores/delete', [StoresController::class, 'destroy'])->name('stores.delete');
 });