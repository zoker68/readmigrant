<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Resources\Book\ShowResource;
use App\Models\Author;
use App\Models\Book;
use App\Models\Country;

class CreateController extends Controller
{
    public function __invoke(Country $country, Book $book)
    {

        $bookData = ShowResource::make($book)->resolve();


        return inertia('Book/Contact/Create', compact('country','bookData'));
    }
}
