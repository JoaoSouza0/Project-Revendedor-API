<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function transactionSeller(){
        return $this->hasMany(Transaction::class, 'seller_id', 'id');
    }
    public function transactionBuyer(){
        return $this->hasMany(Transaction::class, 'buyer_id', 'id');
    }
    public function address(){
        return $this->hasMany(Address::class, 'user_id', 'id');
    }
    public function product(){
        return $this->hasMany(Product::class, 'user_id', 'id');
    }
   
}
