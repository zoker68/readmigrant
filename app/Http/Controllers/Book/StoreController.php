<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreRequest;
use App\Models\Book;
use App\Models\Country;
use App\Services\Book\BookServices;
use Intervention\Image\Facades\Image;

class StoreController extends BookServices
{
    public function __invoke(Country $country, StoreRequest $request)
    {

        $data = $request->validated();
        $genre = $data['genre'];
        unset($data['genre']);

        if (isset($data['image_main'])) {
            $data['image_main'] = $this->uploadBookImage($data['image_main']);
        }

        $data['user_id'] = auth()->user()->id;

        $book = Book::create($data);


        $book->genres()->attach($genre);

        return redirect()->route('book.index', $country->id);
    }
}
