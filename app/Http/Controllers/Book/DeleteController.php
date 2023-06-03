<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;

class DeleteController extends Controller
{
    public function __invoke(Country $country, Book $book): RedirectResponse
    {


        $book->genres_id()->delete();
        $book->delete();

        return redirect()->route('book.my',$country->id);
    }

}
