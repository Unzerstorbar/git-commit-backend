<?php

namespace Event\Domain\Entity;

use Illuminate\Database\Eloquent\Model;

class EventStatus extends Model
{
    protected $table = 'event_status';

    protected $fillable = [
        'id',
        'name'
    ];
}
