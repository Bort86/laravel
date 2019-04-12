<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description'
        ];
    
    //protected $table = "categories";
    
    //protected $primary_key = "category_id";
    
    public function listProducts(){
        return $this->hasMany(Product::class);
    }
}
