<?php

namespace App\Models;

use App\Support\Database\CacheQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasFactory;
    use CacheQueryBuilder;
    protected $fillable = [
        
        'name',
        'subject',
        'body',
        'shortcodes_subject',
        'shortcodes_body',
        'status'
    ];
}
