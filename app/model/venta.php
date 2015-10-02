<?php 

namespace App\model;
use Illuminate\Database\Eloquent\Model;

class venta extends model{
	protected $table="venta";
	public $timestamps=false;
	protected $fillable=array('cantidad','fecha','users_id','laminas_id');
}


 ?>