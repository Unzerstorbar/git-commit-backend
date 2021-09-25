<?php

namespace Orphanage\Domain\Entity;

use Illuminate\Database\Eloquent\Model;

class Pupil extends Model
{
    protected $fillable = [
        'name',
        'birthday',
        'orphanage_id',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'orphanage_id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'birthday' => 'datetime:d.m.Y',
    ];
}
