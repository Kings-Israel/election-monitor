<?php

namespace App;

use App\Ward;
use App\Constituency;
use Illuminate\Database\Eloquent\Model;

class Polling extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'polling';

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
     * Get the ward that owns the Polling
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id');
    }

    /**
     * Get the constituency that owns the Polling
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function constituency()
    {
        return $this->belongsTo(Constituency::class, 'constituency_id');
    }
}
