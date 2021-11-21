<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
     public $timestamps = false;

     protected $fillable = ['buyer_id', 'seller_id', 'product_id'];

     public function products(){
          return $this->hasOne(Product::class, 'id', 'product_id');
     }
}
