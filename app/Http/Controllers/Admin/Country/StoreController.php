<?php

namespace App\Http\Controllers\Admin\Country;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Country\StoreRequest;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): RedirectResponse
    {

        $data = $request->validated();

        $data['id'] = strtolower($data['id']);

        Country::firstOrCreate($data);

        return redirect()->route('admin.country.index');
    }
}
