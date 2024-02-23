<?php

namespace App\Models;

class User extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'balance'
    ];

    /**
     * The attributes that should be hidden for serialization.
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * Indicates if the model should be timestamped.
     * @var bool
     */
    public $timestamps = true;
}
