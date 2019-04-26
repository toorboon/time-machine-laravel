<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }

    // Maybe not a good idea to use that accessor method, stick to ISO dates in the backend and forget about it!
    // public function getStartTimeAttribute($date){
    // 	$date = new \Carbon\Carbon($date);
    // 	$date = $date->format('d.m.Y H:i');
    // 	return $date;
    // }

    // protected $guarded = ['id'];
}
