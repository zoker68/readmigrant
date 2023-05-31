<?php

namespace App\Http\Controllers\Admin\Genre;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\RedirectResponse;

class DeleteController extends Controller
{
    public function __invoke(Genre $genre): RedirectResponse
    {

        $genre->delete();

        return redirect()->route('admin.genre.index');
    }
}
