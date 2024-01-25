<?php

namespace App\Models;

use App\Support\Database\CacheQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    use CacheQueryBuilder;
    protected $fillable = [
        'type',
        'author',
        'title',
        'snippet',
        'detail',
        'category',
        'slug',
        'img',
        'uuid'
    ];
}
