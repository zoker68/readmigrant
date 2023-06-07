<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Resources\Book\ShowResource;
use App\Http\Resources\Message\MessageResource;
use App\Models\Book;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Message;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ShowController extends Controller
{
    public function __invoke(Country $country, Contact $contact)
    {
        $this->authorize('mainCheck', $contact);

        $messages = Message::where('contact_id', $contact->id)->with('user')->orderByDesc('created_at')->get();

        $messages = MessageResource::collection($messages)->resolve();

        $book = Book::find($contact->book_id);
        $bookData = ShowResource::make($book)->resolve();


        return inertia('Book/Contact/Show', compact('country', 'bookData', 'messages', 'contact'));
    }
}
