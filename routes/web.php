<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;

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


// All Listings
Route::get('/',[ListingController::class,'index']);


// Single Listing
/*Route::get('/listings/{id}',function ($id){
    $listing = Listing::find($id);
        if($listing)
        {
            return view('Listing',
            [
            'listing' => Listing::find($id)
            ]);
        }else{
            abort('404');
        }
});
*/



//Show Create Form
Route::get('/listings/create',[ListingController::class,'create'])->middleware('auth');

//Store Listing in the database
Route::post('/listings',[ListingController::class,'store'])->middleware('auth');

// Single Listing
Route::get('/listings/{listing}',[ListingController::class,'show'])->middleware('auth');


// Management Lisitngs
Route::get('/manage',[ListingController::class,'manage'])->middleware('auth');

// Show Edit Form
Route::get('/listings/{listing}/edit',[ListingController::class,'edit'])->middleware('auth');


// update Listing Form
Route::POST('/listings/{listing}/update',[ListingController::class,'update'])->middleware('auth');
//Route::post('/listings/{listing}/update',function (){
//   return 'updated sucessfully';
//});


// Delete Listing Form
Route::delete('/listings/{listing}',[ListingController::class,'delete'])->middleware('auth');;



// Register With admins panel

Route::get('/register', [UserController::class,'register'])->middleware('guest');



// Store all data register
Route::post('/users',[UserController::class,'store']);


// Logout this is logout users
Route::post('/logout',function (Request $request){
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/')->with('message','You Have Been logged out!!');
});

// Login any users
Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');


// Login after click button click
Route::post('/users/authenticate', [UserController::class,'authenticate']);
// Common Resource Routes:
// index - show all listings
// show - Show single  listing
// create - show form to create new listing
// store - Store new listing
// edit - show form to edit listing
// update - update listing
// destroy - Destroy Listing



Route::get('/pass',function (){
    return md5('mohammed');
});


Route::get('/hello',function (){
   return response('<h1 class="">Hello world</h1>',200)
   ->header('Content-Type', 'text/plain')
    ->header('foo','bar');
});

Route::get('/posts/{id}',function ($id){
   return response('Post'.$id);
})->where('id','[0-9]+');


Route::get('/search',function (Request $request){
//   dd($request);
    return($request->name.' '.$request->ages);
});
