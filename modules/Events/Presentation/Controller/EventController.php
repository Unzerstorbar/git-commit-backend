<?php

namespace Events\Presentation\Controller;

use App\Http\Controllers\Controller;
use Events\Domain\Entity\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function getRegistry(Request $request)
    {
        return response()->json(Event::all());
    }
}
