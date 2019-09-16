<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = "template"; protected $PrimaryKey = 'id';
    protected $fillable = ['product_cat_id','heading','subheading','title_area','description_area','seo_title','seo_meta_keyword','seo_meta_description','is_default','version'];

    public function products()
    {
        return $this->belongsTo('App\Product','product_cat_id');
    }
}
