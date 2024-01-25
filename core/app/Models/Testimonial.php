<?php

namespace App\Models;

use App\Support\Database\CacheQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    use CacheQueryBuilder;
    protected $fillable = [
        'name',
        'comment',
        'star_rating',
        'photo'
    ];
}
