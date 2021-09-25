<?php

namespace Topic\Domain\Entity;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
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
