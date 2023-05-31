<?php

namespace App\Http\Controllers\Admin\Country;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CreateController extends Controller
{
    public function __invoke(): View
    {
        $maxOrder = Country::max('order') + 1;

        return view('admin.country.create', compact('maxOrder'));
    }
}
