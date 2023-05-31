<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Resources\Book\EditResource;
use App\Models\Book;
use App\Models\Country;

class EditController extends Controller
{
    public function __invoke(Country $country, Book $book)
    {
        $countryList = Country::orderBy('order')->get();

        $book = EditResource::make($book)->resolve();

        return inertia('Book/Edit', compact('country', 'book','countryList'));
    }
}
