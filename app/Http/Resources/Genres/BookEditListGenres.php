<?php

namespace App\Http\Resources\Genres;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookEditListGenres extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): int
    {
        return
            $this->genre_id;
    }
}
