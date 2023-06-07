<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Resources\Contact\ContactsResource;
use App\Models\Book;
use App\Models\Contact;
use App\Models\Country;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Inertia\Response;

class IndexController extends Controller
{
    public function __invoke(Country $country): Response
    {

        $contacts = Contact::with('user_from')->with('user_to')->with('book')->orderByDesc('created_at')
            ->where(
               'from_user_id', auth()->user()->id
            )->orWhere(
                'to_user_id', auth()->user()->id
            )->get();

        $contacts = ContactsResource::collection($contacts)->resolve();

        return inertia('Book/Contact/Index', compact('country', 'contacts'));
    }
}
