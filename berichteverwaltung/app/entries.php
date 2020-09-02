<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class entries extends Model
{
 	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */  
   protected $fillable = [
   		'report_id','position','duration','header','description','type'
   ];

   public function report(){
   	$this->belongsTo('App\reports');
   }
}
