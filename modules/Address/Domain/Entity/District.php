<?php

namespace Address\Domain\Entity;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'district';

    protected $fillable = [
        'id',
        'name',
    ];

    protected $hidden = [
        'country_id',
    ];

    protected $appends = [
        'regions',
    ];

    public function regions()
    {
        return $this->hasMany(Region::class);
    }

    public function getRegionsAttribute()
    {
        return $this->regions()->get();
    }
}
