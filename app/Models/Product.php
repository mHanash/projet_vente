<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Store;
use App\Models\User;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'qteEmballage',
        'typeEmballage',
        'origine',
        'weight',
        'type_id',
        'category_id'
    ];

    public function stores(){
        return $this->belongsToMany(Store::class);
    }
    public function customers(){
        return $this->belongsToMany(Customer::class);
    }
    public function salers(){
        return $this->belongsToMany(User::class);
    }
    public function type(){
        return $this->belongsTo(Type::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
