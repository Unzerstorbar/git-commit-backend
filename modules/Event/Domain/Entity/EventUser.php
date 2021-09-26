<?php

namespace Event\Domain\Entity;

use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    protected $table = 'event_user';

    protected $fillable = [
        'id',
        'event_id',
        'user_id',
        'confirmed',
    ];

    protected $hidden = [
        'id',
        'event_id',
        'user_id',
    ];

    public $timestamps = false;
}
