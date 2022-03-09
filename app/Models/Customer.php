<?php

namespace App\Models;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable =[
        'firstname',
        'lastname',
        'phone'
    ];

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function salers(){
        return $this->belongsToMany(User::class);
    }
}
