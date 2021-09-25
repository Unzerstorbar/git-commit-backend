<?php

namespace Address\Domain\Entity;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = [
        'id',
        'region_id',
        'name',
    ];

    protected $hidden = [
        'region_id',
    ];
}
