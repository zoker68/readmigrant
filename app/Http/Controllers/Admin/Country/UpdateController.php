<?php

namespace App\Http\Controllers\Admin\Country;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Country\StoreRequest;
use App\Http\Requests\Admin\Country\UpdateRequest;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Country $country): RedirectResponse
    {

        $data = $request->validated();

        $data['id'] = strtolower($data['id']);

        $country->update($data);

        return redirect()->route('admin.country.index');
    }
}
