<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //Show all Listings
    public function index() {
        // dd(request());
        // dd(request()->tag);
        // dd(request('tag'));
        // dd(Listing::latest()->filter(request(['tag','search']))->paginate(4));
        return view('listings.index', [
            'heading' => 'Latest Listings',
            'listings' =>  Listing::latest()->filter(request(['tag', 'search']))->paginate(4)
        ]);
    }

    //Show single listing
    public function show(Listing $listing) {
        return view('listings.show' , [
            'listing' => $listing
        ]);
    }

    //Show Create Form
    public function create() {
        return view('listings.create');
    }

    //Store Listing Data
    public function store(Request $request){
        // dd($request->all());
        // dd($request->file('logo'));
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($formFields);

        return redirect('/')->with('message', 'Job Posting created successfully!');

    }

    //Show Edit Form
    public function edit(Listing $listing) {
        // dd($listing);
        return view('listings.edit', ['listing' => $listing]);
    }

    //Update Listing Data
    public function update(Request $request, Listing $listing){        
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing-> update(($formFields));

        return back()->with('message', 'Job Listing updated successfully!');
    }

    //Delete Listing
    public function destroy(Listing $listing) {
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }
}
