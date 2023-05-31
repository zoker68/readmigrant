<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Country;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __invoke(Country $country)
    {
        $countryList = Country::orderBy('order')->get();

        return inertia('Book/Create', compact('country','countryList'));
    }
}
