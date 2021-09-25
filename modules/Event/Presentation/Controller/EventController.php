<?php

namespace Event\Presentation\Controller;

use App\Http\Controllers\Controller;
use Event\Domain\Entity\Event;

class EventController extends Controller
{
    public function registry()
    {
        return response()->json(Event::all());
    }
}
