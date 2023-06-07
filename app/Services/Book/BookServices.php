<?php

namespace App\Services\Book;

use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BookServices extends Controller
{
    public function uploadBookImage($image): string
    {
        $image->store('public/books/fullsize/');
        $filename = $image->store('public/books/smallsize/');
        $thumbnail = Image::make( storage_path("app/".$filename) )->orientate();

        $thumbnail->fit(300, 300);
        $thumbnail->save();

        $filename = explode('/',$filename);

        return end($filename);
    }
}
