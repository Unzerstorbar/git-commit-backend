<?php

namespace Profile\Domain\Entity;

use Illuminate\Database\Eloquent\Model;

class Type extends Model implements \JsonSerializable
{
    protected $table = 'user_types';

    protected $fillable = [
        'name',
        'code',
    ];
}
