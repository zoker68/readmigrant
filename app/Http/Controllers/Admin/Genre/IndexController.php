<?php

namespace App\Http\Controllers\Admin\Genre;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        $genres = Genre::all();

        return view('admin.genre.index',compact('genres'));
    }
}
