<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Resources\Book\ShowResource;
use App\Http\Resources\Message\MessageResource;
use App\Models\Book;
use App\Models\Country;
use App\Models\Message;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ShowController extends Controller
{
    public function __invoke(Country $country, Book $book)
    {


        $contact = DB::table('contacts')->where('book_id', $book->id)->where(
            function (Builder $query) {
                $query->where('from_user_id', auth()->user()->id);
                $query->orWhere('to_user_id', auth()->user()->id);
            })->first();

        if (!$contact->id > 0) abort(404);

        $messages = Message::where('contact_id', $contact->id)->with('user')->orderByDesc('created_at')->get();

        $messages = MessageResource::collection($messages)->resolve();


        $bookData = ShowResource::make($book)->resolve();


        return inertia('Book/Contact/Show', compact('country', 'bookData', 'messages', 'contact'));
    }
}
