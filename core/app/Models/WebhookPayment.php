<?php

namespace App\Models;

use App\Support\Database\CacheQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebhookPayment extends Model
{
    use HasFactory;
    use CacheQueryBuilder;
    protected $fillable = [
        'type',
        'data',
        'txn_id'
    ];
}
