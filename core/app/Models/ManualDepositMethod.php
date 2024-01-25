<?php

namespace App\Models;

use App\Support\Database\CacheQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualDepositMethod extends Model
{
    use HasFactory;
    use CacheQueryBuilder;
    protected $fillable = [
        'name',
        'type',
        'class',
        'status',
        'min_amount',
        'max_amount',
        'wallet_address',
        'network_type',
        'qr_code',
        'payment_instruction',
        'bank_name',
        'account_name',
        'account_no',
        'sort_code',
        'bank_code',
        'logo',
    ];
}
