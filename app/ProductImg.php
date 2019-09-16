<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImg extends Model
{
    //
    protected $table = "product_images"; protected $PrimaryKey = 'id';
    protected $fillable = ['product_id','product_img','status','created_at','media_type','is_default_img'];
}
