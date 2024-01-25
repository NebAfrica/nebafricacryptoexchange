<?php

namespace App\Models;

use App\Support\Database\CacheQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;
    use CacheQueryBuilder;
    protected $fillable = [
        'amount',
        'wallet_type',
        'info',
        'fee',
        'total',
        'wallet_name',
        'status',
        'txn_id'
    ];
}
