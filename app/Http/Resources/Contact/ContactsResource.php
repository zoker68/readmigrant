<?php

namespace App\Http\Resources\Contact;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $array = [

            //Информация о книге
            'title' => $this->book->title,
            'book_image' => $this->book->image_main,
            'book_id' => $this->book_id,

            'date' => $this->created_at->diffForHumans(),
            'id' => $this->id,
        ];

        if ($this->to_user_id == auth()->user()->id) {
            $array['firstname'] = $this->user_from->firstname;
            $array['lastname'] = $this->user_from->lastname;
            $array['avatar'] = $this->user_from->avatar;
        } else {
            $array['firstname'] = $this->user_to->firstname;
            $array['lastname'] = $this->user_to->lastname;
            $array['avatar'] = $this->user_to->avatar;
        }

        return $array;
    }
}
