<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Inertia\Response;

class IndexController extends Controller
{
    public function __invoke(): Response
    {
        $countries = Country::orderBy('order')->get();

        return inertia('SelectCountry',compact('countries'));
    }
}
