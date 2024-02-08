<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $guarded = ['id_product'];


    public function category_product(){
        return $this->hasOne(Category_product::class, 'id_category', 'category_id');
    }
}
