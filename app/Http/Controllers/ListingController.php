<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show all Listing
    function index(){
//        dd(Listing::latest()->filter(request(['tag','search']))->paginate(2));
//        dd(request('tag'));
        return view('listings.index',[
            'Listings'
                    =>
            Listing::latest()
                    ->
            filter(request(['tag','search']))
                    ->
//            get()
//        simplepaginate(4)
        paginate(6)
        ]);
    }

    // Show single Listing
    function show(Listing $listing){
        return view('listings.show',
            [
                'listing' => $listing
            ]);
    }

    function create(){
        return view('listings.create');
    }

    // Store Listing Data
    function store(Request $request){
//        dd($request->all());
//        dd($request->file('logo'));
        $formFields = $request->validate([
            'title'         =>       'required',
            'company'       =>      ['required',Rule::unique('listings','company')],
            'location'      =>      'required',
            'website'       =>      'required',
            'email'         =>      ['required',Rule::unique('listings','email')],
            'tags'          =>      'required',
            'description'   =>      'required',
        ]);

        if ($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);
//        return redirect()->back()->with('message','Listing Created Successfully!');
        return redirect('/')->with('message','Listing Created Successfully!');
    }

    // edit Listing select * from listing
    function edit(Listing $listing){
//        return "edit this ".$listing;
        return view('listings.edit',['listing'=>$listing]);
    }

    // update Listing update from listing
    function update(Listing $listing,Request $request){


        // Make sure logged in user is owner
        if($listing->user_id != auth()->id()){
            abort(403,'Unauthorized Actions');
        }
        $formFields = $request->validate([
            'title'         =>       'required',
            'company'       =>      'required',
            'location'      =>      'required',
            'website'       =>      'required',
            'email'         =>      ['required','email'],
            'tags'          =>      'required',
            'description'   =>      'required',
        ]);
        if ($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

        $listing->update($formFields);
        return redirect('/')->with('message','Listing Updated SuccessFully');
//        return back()->with('message','Listing Updated SuccessFully');
    }


    // delete the listing where the id equial this id

    function delete(Listing $listing){
        // Make sure logged in user is owner
        if($listing->user_id != auth()->id()){
            abort(403,'Unauthorized Actions');
        }
        $listing->delete();
        return redirect('/')->with('message','Deleted SuccessFully Listing');
    }


    // manage Listing
    function manage(){
//        return view('listings.manage');
        return view('listings.manage',['listings' => auth()->user()->listings()->get()]);
    }
}
