<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $table = "versions_city"; protected $PrimaryKey = 'id';
    protected $fillable = ['version','city','status','created_at'];
}
