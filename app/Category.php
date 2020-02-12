<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    protected $fillable=[
        'cate_name','slug'
    ];
    //
    public function subcategory(){
        return $this->hasMany(SubCategory::class);

    }
}
