<?php

namespace Image\Domain\Entity;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'id',
        'name',
    ];
}
