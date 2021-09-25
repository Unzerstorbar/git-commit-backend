<?php

namespace Profile\Domain\Entity;

use Illuminate\Database\Eloquent\Model;

class Role extends Model implements \JsonSerializable
{
    protected $fillable = [
        'id',
        'name',
        'code',
        'for_user',
        'for_company',
    ];

    protected $hidden = [
        'for_user',
        'for_company',
    ];
}
