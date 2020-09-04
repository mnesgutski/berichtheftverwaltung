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
   		'report_book_id','type','begin_date', 'end_date','company','department','hours_targeted', 'position'
   ];

   public function report(){
   	return $this->belongsTo('App\report_books');
   }

   public function entries(){
   	return $this->hasMany('App\entries', 'report_id');
   }
}
