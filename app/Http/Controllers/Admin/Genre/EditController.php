<?php

namespace App\Http\Controllers\Admin\Genre;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\View\View;

class EditController extends Controller
{
    public function __invoke(Genre $genre): View
    {
        return view('admin.genre.edit', compact('genre'));
    }
}
