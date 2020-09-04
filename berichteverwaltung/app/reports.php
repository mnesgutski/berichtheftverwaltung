<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reports extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */  
   protected $fillable = [
   		'report_book_id','type','begin_date', 'end_date','company','department','hours_targeted'
   ];

   public function report(){
   	return $this->belongsTo('App\report_books', 'report_book_id');
   }

   public function entries(){
   	return $this->hasMany('App\entries');
   }
}
