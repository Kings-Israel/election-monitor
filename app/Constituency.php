<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Constituency extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'constituency';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
