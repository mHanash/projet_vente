<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['name','address','contact','pivot'];

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('code')
                                                    ->withTimestamps();
    }
}
