<?php

namespace Venue\Domain\Entity;

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
