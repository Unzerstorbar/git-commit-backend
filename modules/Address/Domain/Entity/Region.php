<?php

namespace Address\Domain\Entity;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'region';

    protected $fillable = [
        'id',
        'name',
        'district_id',
    ];

    protected $hidden = [
        'district_id'
    ];

    protected $appends = [
        'Citys',
    ];

    public function citys()
    {
        return $this->hasMany(City::class);
    }

    public function getCitysAttribute()
    {
        return $this->citys()->get();
    }
}
