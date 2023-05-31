<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Resources\Book\ShowResource;
use App\Http\Resources\Rating\RatingCommentResource;
use App\Models\Book;
use App\Models\Country;

class ShowController extends Controller
{
    public function __invoke(Country $country, Book $book)
    {



        $book->load('country');
        $book->load('user');

        $bookData = ShowResource::make($book)->resolve();


        $ratingData = $book->aggregateRating->first() ?? ['count' => 0, 'avg' => 0];

        $ratings = RatingCommentResource::collection($book->ratings)->resolve();



        return inertia('Book/Show', compact('country', 'bookData', 'ratingData','ratings'));
    }
}
