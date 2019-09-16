<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = "products"; protected $PrimaryKey = 'id';
    protected $fillable = ['name','slug','status','type','created_at','description','sku','parent_id','banner_img','is_feature'];

    public function productimg()
    {
        return $this
        ->hasMany('App\ProductImg','product_id');
    }

    public function template()
    {
        return $this
        ->hasMany('App\Template','product_cat_id');
    }
}
