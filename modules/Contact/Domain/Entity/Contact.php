<?php

namespace Contact\Domain\Entity;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'role',
        'type',
        'contact',
    ];
}
