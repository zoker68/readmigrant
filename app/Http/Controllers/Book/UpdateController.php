<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\UpdateRequest;
use App\Models\Book;
use App\Models\Country;
use App\Services\Book\BookServices;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UpdateController extends BookServices
{
    public function __invoke(Country $country, Book $book, UpdateRequest $request)
    {


        $data = $request->validated();

        $genre = $data['genre'];
        unset($data['genre']);

        if (isset($data['image_main']))
        {
            if ($book['image_main']) {
                Storage::delete('public/books/smallsize/' . $book['image_main']);
                Storage::delete('public/books/fullsize/' . $book['image_main']);
            }

            $data['image_main'] = $this->uploadBookImage($data['image_main']);
        }

        $book->update($data);


        $book->genres()->sync($genre);

        return redirect()->route('book.my',$country->id);
    }
}
