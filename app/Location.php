<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = "locations"; protected $PrimaryKey = 'id';
    protected $fillable = ['name','slug','status','is_default','created_at','another_name'];
}
