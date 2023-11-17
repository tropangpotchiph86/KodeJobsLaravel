<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    //Show all Listings
    public function index() {
        // dd(request());
        // dd(request()->tag);
        // dd(request('tag'));
        return view('listings.index', [
            'heading' => 'Latest Listings',
            'listings' =>  Listing::latest()->filter(request(['tag', 'search']))->get()
        ]);
    }

    //Show single listing
    public function show(Listing $listing) {
        return view('listings.show' , [
            'listing' => $listing
        ]);
    }

}
