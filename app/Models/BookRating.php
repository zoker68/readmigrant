<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BookRating extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $table = 'book_ratings';

    public function user():HasOne
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
