<?php

namespace Event\Presentation\Controller;

use App\Http\Controllers\Controller;
use Event\Domain\Entity\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function registry()
    {
        return response()->json(Event::all());
    }

    public function get(Event $event)
    {
        return response()->json($event);
    }

    public function create(Request $request)
    {
        $event = new Event([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'city_id' => $request->city['id'],
            'event_status_id' => $request->event_status['id'],
        ]);

        if ($event->save()) {
            return response()->json([
                'message' => 'Мероприятие успешно создано!',
            ], 201);

        } else {
            return response()->json([
                'error' => 'Предоставьте правильную информацию',
            ], 422);
        }
    }
}
