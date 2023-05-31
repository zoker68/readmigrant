<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Collection\Collection;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $guarded = false;

    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'book_genres', 'book_id', 'genre_id');
    }

    public function genres_id(): HasMany
    {
        return $this->hasMany(BookGenre::class, 'book_id', 'id');
    }

    public function ratings():HasMany
    {
        return $this->hasMany(BookRating::class, 'book_id', 'id')->with('user');

    }

    public function aggregateRating(): HasMany
    {
        return $this->ratings()
            ->selectRaw('avg(`rating`) as `avg`, count(*) as `count`, `book_id`')
            ->groupBy('book_id');
    }
}
