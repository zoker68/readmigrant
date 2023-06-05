<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\SearchRequest;
use App\Models\Book;
use App\Models\Country;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function __invoke(Country $country, SearchRequest $request)
    {
        $searchData = $request->validated();


        $books = DB::table('books')->select('books.id', 'books.title as title', 'author', 'image_main', 'city', 'countries.title AS countryTitle', 'country_id');

        $books->leftJoin('countries', 'countries.id', '=', 'books.country_id');
        if ($searchData) {
            if (isset($searchData['genre'])) {
                $books = $books->leftJoin('book_genres', 'books.id', '=', 'book_genres.book_id')
                    ->whereIn('book_genres.genre_id', $searchData['genre']);

            }

            if (isset($searchData['search'])) {
                $books = $books->where(function (Builder $query) use ($searchData) {
                    $query->where('title', 'like', '%' . $searchData['search'] . '%');
                    $query->orWhere('author', 'like', '%' . $searchData['search'] . '%');
                });
            }
        }

        $books->where('is_published', 1);
        $books->where(
            function (Builder $query) use ($country) {
                $query->where('country_id', $country['id']);
                $query->orWhere('send_border', 1);
            }
        );
        $books->groupBy('books.id');


        $books = $books->paginate(12)->appends(request()->query());


        return inertia('Book/Index', compact('country', 'books', 'searchData'));
    }
}
