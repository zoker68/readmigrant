<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';
    protected $guarded = false;

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class,'book_id','id');
    }
    public function user_from(): BelongsTo
    {
        return $this->belongsTo(User::class,'from_user_id','id');
    }
    public function user_to(): BelongsTo
    {
        return $this->belongsTo(User::class,'to_user_id','id');
    }
}
