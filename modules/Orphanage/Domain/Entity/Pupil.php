<?php

namespace Orphanage\Domain\Entity;

use Illuminate\Database\Eloquent\Model;

class Pupil extends Model
{
    protected $fillable = [
        'name',
        'birthday',
        'orphanage_id',
    ];

    protected $hidden = [
        'orphanage_id',
    ];

    protected $casts = [
        'birthday' => 'datetime:d.m.Y',
    ];
}
