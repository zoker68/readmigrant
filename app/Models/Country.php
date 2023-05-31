<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $table = "countries";
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
}
