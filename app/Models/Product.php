<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\Type;
use App\Models\User;
use App\Models\Store;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Distribution;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'qteEmballage',
        'typeEmballage',
        'origine',
        'weight',
        'type_id',
        'category_id',
        'unit',
        'pivot'
    ];

    public function stores(){
        return $this->belongsToMany(Store::class)->withPivot('code')
                                                    ->withTimestamps();;
    }
    public function sales(){
        return $this->belongsToMany(Sale::class)->withPivot('qte');
    }
    public function type(){
        return $this->belongsTo(Type::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function distributions(){
        return $this->belongsToMany(Distribution::class)->withPivot(['id','priceUnit','priceUnitPublic','priceHTVA']);
    }
}
