<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountVerification extends Model
{
    //
    protected $fillable = [
        'email',
        'token',
        'expires_at',
    ];

    protected $cast = [
        'expires_at' => 'datetime',
    ];
}
