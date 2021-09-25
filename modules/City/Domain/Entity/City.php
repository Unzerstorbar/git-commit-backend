<?php

namespace City\Domain\Entity;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = [
        'id',
        'id_region',
        'name',
    ];
}
