<?php

namespace Address\Domain\Entity;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $table = 'event_venues';

    protected $fillable = [
        'id',
        'city_id',
        'address',
        'phone',
        'index',
        'name',
    ];
}
