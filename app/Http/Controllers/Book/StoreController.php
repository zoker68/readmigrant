<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Country;
use Intervention\Image\Facades\Image;

class StoreController extends Controller
{
    public function __invoke(Country $country, StoreRequest $request)
    {

        $data = $request->validated();
        $genre = $data['genre'];
        unset($data['genre']);

        if (isset($data['image_main']))
        {
            $data['image_main']->store('public/books/fullsize/');
            $filename = $data['image_main']->store('public/books/smallsize/');
            $thumbnail = Image::make( storage_path("app/".$filename) )->orientate();

            $thumbnail->fit(300, 300);
            $thumbnail->save();

            $filename = explode('/',$filename);
            $data['image_main'] = end($filename);
        }

        $data['user_id'] = auth()->user()->id;
        $book = Book::create($data);


        $book->genres()->attach($genre);

        return redirect()->route('book.index',$country->id);
    }
}
