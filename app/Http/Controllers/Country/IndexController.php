<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use App\Http\Requests\Country\SearchRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Inertia\Response;

class IndexController extends Controller
{
    public function __invoke(SearchRequest $request): Response
    {

        $searchData = $request->validated();

        $searchData['search'] = $searchData['search'] ?? '';

        $countries = Country::where('title', 'like', '%' . $searchData['search'] . '%')->orderBy('order')->get();

        return inertia('SelectCountry', compact('countries', 'searchData'));
    }
}
