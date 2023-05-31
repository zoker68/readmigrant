<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Inertia\Response;

class IndexController extends Controller
{
    public function __invoke(Country $country): Response
    {

        return inertia('Index',compact('country'));
    }
}
