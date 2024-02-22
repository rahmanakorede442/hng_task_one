<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function notifiable()
    {
        return $this->morphTo();
    }

    // public function setDataAttribute($data) 
    // { 
    //     $this->attributes['data'] = json_encode($data); 
    // } 

}
