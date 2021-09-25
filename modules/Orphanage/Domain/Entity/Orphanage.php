<?php

namespace Orphanage\Domain\Entity;

use Address\Domain\Entity\City;
use Illuminate\Database\Eloquent\Model;

class Orphanage extends Model
{
    protected $fillable = [
        'name',
        'description',
        'address',
        'city_id',
    ];

    protected $hidden = [
        'city_id',
    ];

    protected $appends = [
        'pupils',
        'city',
    ];

    public function pupils()
    {
        return $this->hasMany(Pupil::class);
    }

    public function getPupilsAttribute()
    {
        return $this->pupils()->get();
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getCityAttribute()
    {
        return $this->city()->get()->first();
    }
}
