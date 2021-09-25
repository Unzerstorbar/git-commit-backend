<?php

namespace Event\Domain\Entity;

use Address\Domain\Entity\City;
use Address\Domain\Entity\Venue;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'id',
        'name',
        'photo_id',
        'city_id',
        'venue_id',
        'description',
        'date',
    ];

    protected $hidden = [
        'city_id',
        'venue_id',
    ];

    protected $appends = [
        'city',
        'venue',
    ];

    protected $casts = [
        'date' => 'datetime:d.m.Y',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function getCityAttribute()
    {
        return $this->city()->get()->first();
    }

    public function getVenueAttribute()
    {
        return $this->venue()->get()->first();
    }
}
