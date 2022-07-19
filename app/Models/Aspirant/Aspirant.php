<?php

namespace App\Models\Aspirant;

use Eloquent;

class Aspirant extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'aspirants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'political_party','user_id', 'electoral_area', 'electoral_position','results',
    ];

    /**
     * @var string
     */
    protected $primaryKey = 'id';
}
