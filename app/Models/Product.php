<?php

namespace App\Models;

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
        'weight'
    ];

    public function type(){
        return $this->belongsTo(Type::class);
    }
}
