<?php

namespace App\Http\Controllers\Contact;

use App\Events\Contact\BookRequest;
use App\Events\Contact\NewMessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\StoreRequest;
use App\Models\Book;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Message;

class UpdateController extends Controller
{
    public function __invoke(Country $country, Contact $contact, StoreRequest $request)
    {

        $this->authorize('mainCheck', $contact);

        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;
        $data['contact_id'] = $contact->id;

        Message::create($data);

        $book = Book::find($contact->id);

        event(new NewMessageEvent($book, $contact));

        return redirect()->route('book.contact.show', [$country->id, $contact->id]);
    }
}
