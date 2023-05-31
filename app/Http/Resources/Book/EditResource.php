<?php

namespace App\Http\Resources\Book;

use App\Http\Resources\Genres\BookEditListGenres;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'image_main' => $this->image_main,
            'description' => $this->description,
            'conditions' => $this->conditions,
            'city' => $this->city,
            'is_published' => $this->is_published,
            'mailed' => $this->mailed,
            'send_border' => $this->send_border,
            'genres' => BookEditListGenres::collection($this->genres_id)->resolve(),

            //страна книги
            'country_id' => $this->country_id
        ];
    }
}
