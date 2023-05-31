<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;

class BookPolicy
{
    /**
     * Create a new policy instance.
     */

    public function update(User $user, Book $book):bool
    {
        return $user->id === $book->user_id;
    }
    public function __construct()
    {
        //
    }
}
