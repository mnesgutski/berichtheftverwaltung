<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class report_books extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */  
   protected $fillable = [
   		'owner','apprenticeship_name','begin_date','end_date'
   	];
}