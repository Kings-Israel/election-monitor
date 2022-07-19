<?php

namespace App;

use App\Question;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'survey_set';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
    /**
     * Get all of the questions for the Survey
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
