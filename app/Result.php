<?php

namespace App;

use App\Models\Aspirant\Aspirant;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'results';

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
     * Get the aspirant that owns the Result
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function aspirant()
    {
        return $this->belongsTo(Aspirant::class, 'aspirant_uuid', 'uuid');
    }
}
