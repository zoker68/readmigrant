<?php

namespace App\Http\Controllers\Admin\Genre;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CreateController extends Controller
{
    public function __invoke(): View
    {

        return view('admin.genre.create');
    }
}
