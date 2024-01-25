<?php

namespace App\Models;

use App\Support\Database\CacheQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;
    use CacheQueryBuilder;
    protected $fillable = [
        'user_id',
        'amount',
        'converted_amount',
        'currency',
        'charge',
        'method',
        'status',
        'payment_screenshot',
        'additional_info',
        'txn_id'
        
        
    ];
}
