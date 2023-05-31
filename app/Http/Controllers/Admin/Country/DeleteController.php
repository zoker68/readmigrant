<?php

namespace App\Http\Controllers\Admin\Country;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Country\StoreRequest;
use App\Http\Requests\Admin\Country\UpdateRequest;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;

class DeleteController extends Controller
{
    public function __invoke(Country $country): RedirectResponse
    {

        $country->delete();

        return redirect()->route('admin.country.index');
    }
}
