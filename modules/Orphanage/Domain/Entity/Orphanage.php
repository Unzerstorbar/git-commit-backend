<?php

namespace Orphanage\Domain\Entity;

use Address\Domain\Entity\City;
use Contact\Domain\Entity\Contact;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Orphanage extends Model
{
    protected $fillable = [
        'name',
        'description',
        'address',
        'city_id',
        'index',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'city_id',
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'pupils',
        'contacts',
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

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function getContactsAttribute(): Collection
    {
        return $this->contacts()->get();
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
