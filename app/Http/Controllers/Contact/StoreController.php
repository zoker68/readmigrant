<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\StoreRequest;
use App\Models\Book;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Message;

class StoreController extends Controller
{
    public function __invoke(Country $country, Book $book, StoreRequest $request)
    {

        $contact = Contact::firstOrCreate(
            [
                'from_user_id' => auth()->user()->id,
                'to_user_id' => $book->user_id,
                'book_id' => $book->id,
            ]
        );

        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;
        $data['contact_id'] = $contact->id;

        Message::create($data);

        return redirect()->route('book.contact.show', [$country->id, $book->id]);
    }
}
