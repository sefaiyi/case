<?php

namespace App\Models;

class Transaction extends Model
{
    protected $fillable = [
        'source_user_id', 'target_user_id', 'amount', 'transaction_date'
    ];

    protected $hidden = [
      'created_at', 'updated_at'
    ];
}
