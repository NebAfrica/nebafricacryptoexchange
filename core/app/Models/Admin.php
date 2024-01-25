<?php

namespace App\Models;

use App\Support\Database\CacheQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    use CacheQueryBuilder;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password'.
        'role',
        'profile_photo'
    ];
}
