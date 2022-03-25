<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_id',
        'pivot',
        'updated_at',
        'amount'
    ];

    public function products(){
        return $this->belongsToMany(Product::class)->withTimestamps()->withPivot('qte');
    }

    public function customers(){
        return $this->belongsToMany(Customer::class)->withTimestamps();
    }

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }


}
