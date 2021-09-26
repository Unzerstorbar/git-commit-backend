<?php

namespace Event\Presentation\Controller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Event\Domain\Entity\Event;
use Event\Domain\Entity\EventUser;
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

            if (count($request->tags) > 0) {
                foreach ($request->tags as $tag) {
                    $tagsId [] = $tag['id'];
                }
                $event->tags()->sync($tagsId);
            }

            $event->users()->sync($request->users[0]['id']);

            return response()->json([
                'message' => 'Мероприятие успешно создано!',
            ], 201);

        } else {
            return response()->json([
                'error' => 'Предоставьте правильную информацию',
            ], 422);
        }
    }

    public function update(Request $request, Event $event)
    {
        $event->name = $request->name;
        $event->city_id = $request->city['id'];
        $event->venue_id =  $request->venue_id ? $request->venue_id['id'] : null;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->date = $request->date;

        if ($event->update()) {

            if (count($request->tags) > 0) {
                foreach ($request->tags as $tag) {
                    $tagsId [] = $tag['id'];
                }
                $event->tags()->sync($tagsId);
            }

            return response()->json([
                'message' => 'Мероприяте успешно обновлёно!',
            ]);
        } else {
            return response()->json([
                'error' => 'Предоставьте правильную информацию',
            ], 422);
        }
    }

    public function statusChange(Event $event)
    {
        $event->event_status_id = 5;

        if ($event->update()) {
            return response()->json([
                'message' => 'Статус успешно изменен!',
            ]);
        } else {
            return response()->json([
                'error' => 'Статус не изменен',
            ], 422);
        }
    }

    public function addUser(Event $event, User $user)
    {
        $eventUserDataSave = [
            'event_id' => $event->id,
            'user_id' => $user->id,
            ];
        if ($user->getRoleAttribute()->code === 'pupil') {
            $eventUserDataSave += ['confirmed' => 0];
        }

        $eventUser = new EventUser($eventUserDataSave);

        if ($eventUser->save()) {
            return response()->json([
                'message' => 'Вы добавлены на мероприяте',
            ]);
        } else {
            return response()->json([
                'error' => 'никогда такого не было и вот опять',
            ], 422);
        }
    }

}
