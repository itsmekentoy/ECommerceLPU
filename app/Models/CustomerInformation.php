<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerInformation extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'address', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    

}
