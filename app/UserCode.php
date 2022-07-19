<?php

namespace App;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCode extends Model
{
    // use HasFactory;

    public $table = "user_codes";
  
    protected $fillable = [
        'user_id',
        'code',
    ];
}