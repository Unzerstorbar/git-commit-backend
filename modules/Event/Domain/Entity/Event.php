<?php

namespace Event\Domain\Entity;

use Address\Domain\Entity\City;
use Address\Domain\Entity\Venue;
use Illuminate\Database\Eloquent\Model;
use Image\Domain\Entity\Image;
use Topic\Domain\Entity\EventTopic;
use Topic\Domain\Entity\Topic;

class Event extends Model
{
    protected $fillable = [
        'id',
        'name',
        'image_id',
        'city_id',
        'venue_id',
        'description',
        'date',
        'event_status_id'
    ];

    protected $hidden = [
        'image_id',
        'city_id',
        'venue_id',
        'event_status_id'
    ];

    protected $appends = [
        'image',
        'city',
        'venue',
        'event_status',
        'topic'
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

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function eventStatus()
    {
        return $this->belongsTo(EventStatus::class);
    }

    public function topic()
    {
        return $this->belongsToMany(Topic::class, 'event_topic');
    }

    public function getCityAttribute()
    {
        return $this->city()->get()->first();
    }

    public function getVenueAttribute()
    {
        return $this->venue()->get()->first();
    }

    public function getImageAttribute()
    {
        return $this->image()->get()->first();
    }

    public function getEventStatusAttribute()
    {
        return $this->eventStatus()->get()->first();
    }

    public function getTopicAttribute()
    {
        return $this->topic()->get();
    }
}
