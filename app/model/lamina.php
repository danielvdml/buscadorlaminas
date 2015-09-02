<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class lamina extends Model
{
   protected $table="laminas";
   public $timestamps=false;
   protected $fillable=array('numero','titulo','editorial','descripcion','cantidad','users_id');
   protected $guarded=array('id');
}
