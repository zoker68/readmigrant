<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\SearchRequest;
use App\Models\Book;
use App\Models\Country;

class MyBookController extends Controller
{
    public function __invoke(Country $country, SearchRequest $request)
    {
        $books = Book::where('user_id', auth()->user()->id)->get();


        return inertia('Book/ListMy', compact('country', 'books'));
    }
}
