<?php

namespace App\Http\Resources\Message;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'firstname' => $this->user->firstname,
            'lastname' => $this->user->lastname,
            'avatar' => $this->user->avatar,
            'date' => $this->created_at->diffForHumans(),
            'message' => $this->message,
        ];
    }
}
