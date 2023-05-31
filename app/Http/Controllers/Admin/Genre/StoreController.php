<?php

namespace App\Http\Controllers\Admin\Genre;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Genre\StoreRequest;
use App\Models\Genre;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): RedirectResponse
    {

        $data = $request->validated();


        Genre::firstOrCreate(
            [
                'title' => $data['title']
            ],
            $data
        );



        return redirect()->route('admin.genre.index');
    }
}
