<?php

namespace App\Models;

use App\Support\Database\CacheQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    use CacheQueryBuilder;
    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'balance_after_transaction',
        'remark',
        'method',
        'txn_id',
    ];
}
