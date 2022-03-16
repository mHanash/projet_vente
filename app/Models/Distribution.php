<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Distribution extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'pivot'
    ];

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot(['id','priceUnit','priceUnitPublic','priceHTVA'])
                                                    ->withTimestamps();
    }

}
