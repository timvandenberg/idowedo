<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'participant_id',
        'status',
        'name',
        'description',
        'duration',
        'start_at',
        'finish_at',
    ];
}
