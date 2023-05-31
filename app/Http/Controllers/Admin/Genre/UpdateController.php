<?php

namespace App\Http\Controllers\Admin\Genre;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Genre\UpdateRequest;
use App\Models\Genre;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Genre $genre): RedirectResponse
    {

        $data = $request->validated();

        $genre->update($data);

        return redirect()->route('admin.genre.index');
    }
}
