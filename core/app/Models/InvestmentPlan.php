<?php

namespace App\Models;

use App\Support\Database\CacheQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentPlan extends Model
{
    use HasFactory;
    use CacheQueryBuilder;
    protected $fillable = [
        'name',
        'amount_type',
        'min_amount',
        'max_amount',
        'return_type',
        'return',
        'duration',
        'duration_type',
        'return_interval',
        'status',
        'label',
    ];
}
