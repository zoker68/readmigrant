<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\UpdateRequest;
use App\Models\Book;
use App\Models\Country;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UpdateController extends Controller
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

            $data['image_main']->store('public/books/fullsize/');
            $filename = $data['image_main']->store('public/books/smallsize/');
            $thumbnail = Image::make( storage_path("app/".$filename) );

            $thumbnail->fit(300, 300);
            $thumbnail->save();

            $filename = explode('/',$filename);
            $data['image_main'] = end($filename);
        }

        $book->update($data);


        $book->genres()->sync($genre);

        return redirect()->route('book.my',$country->id);
    }
}
