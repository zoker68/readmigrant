<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Genre;

class CreateController extends Controller
{
    public function __invoke(Country $country)
    {
        $countryList = Country::orderBy('title')->get();
        $genreAll = Genre::all();

        return inertia('Book/Create', compact('country', 'countryList', 'genreAll'));
    }
}
