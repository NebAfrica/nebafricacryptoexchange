<?php

namespace App\Models;

use App\Support\Database\CacheQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalWallet extends Model
{
    use HasFactory;
    use CacheQueryBuilder;
    protected $fillable = [
        'user_id',
        'type',
        'info',
        'name'
        
    ];
}
