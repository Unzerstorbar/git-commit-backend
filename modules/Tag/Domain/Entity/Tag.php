<?php

namespace Tag\Domain\Entity;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'id',
        'name',
        'parent_id',
    ];

    protected $hidden = [
        'pivot',
        'parent_id',
    ];
}
