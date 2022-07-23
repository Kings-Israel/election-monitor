<?php

namespace App;

use App\County;
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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['geometry'];

    /**
     * Get the county that owns the Constituency
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function county()
    {
        return $this->belongsTo(County::class, 'county_id');
    }
}
