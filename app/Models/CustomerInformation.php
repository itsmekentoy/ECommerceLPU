<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerInformation extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'address', 'password', 'status', 'remarks', 'hash_token', 'profile_path'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function carts()
    {
        return $this->hasMany(CustomerAddtoCart::class, 'customer_id');
    }

    
}
