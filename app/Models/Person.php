<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $casted = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime'
    ];
}
