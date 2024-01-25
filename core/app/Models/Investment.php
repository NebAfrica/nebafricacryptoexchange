<?php

namespace App\Models;

use App\Support\Database\CacheQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;
    use CacheQueryBuilder;
    protected $fillable = [
        'user_id',
        'plan_name',
        'amount',
        'expires',
        'interval',
        'next_profit_time',
        'last_profit_time',
        'profit_per_interval',
        'total_intervals',
        'total_intervals_given',
        'total_profit_earned',
        'status',
    ];
}
