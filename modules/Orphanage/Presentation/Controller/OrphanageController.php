<?php

namespace Orphanage\Presentation\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Orphanage\Domain\Entity\Orphanage;

class OrphanageController extends Controller
{
    public function registry()
    {
        return response()->json(Orphanage::all());
    }

    public function get(Orphanage $orphanage)
    {
        return response()->json($orphanage);
    }

    public function create(Request $request)
    {
        $orphanage = new Orphanage([
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'city_id' => $request->city ? $request->city['id'] : null,
            'index' => $request->index,
        ]);

        if ($orphanage->save()) {
            return response()->json([
                'message' => 'Детский дом успешно создан!',
            ], 201);
        } else {
            return response()->json([
                'error' => 'Предоставьте правильную информацию',
            ], 422);
        }
    }

    public function update(Request $request, Orphanage $orphanage)
    {
        $orphanage->name = $request->name;
        $orphanage->description = $request->description;
        $orphanage->address = $request->address;
        $orphanage->city_id = $request->city ? $request->city['id'] : null;
        $orphanage->index = $request->index;

        if ($orphanage->update()) {
            return response()->json([
                'message' => 'Детский дом успешно обновлён!',
            ]);
        } else {
            return response()->json([
                'error' => 'Предоставьте правильную информацию',
            ], 422);
        }
    }

    public function destroy(Orphanage $orphanage)
    {
        if ($orphanage->delete()) {
            return response()->json([
                'message' => 'Детский дом успешно удалён!',
            ]);
        } else {
            return response()->json([
                'error' => 'Ошибка при удалении детского дома',
            ], 422);
        }
    }

    public function pupilOrphanageEvent(Orphanage $orphanage)
    {
        return DB::table('pupils')
            ->select(
                'pupils.name',
                'events.name as eventName',
                'events.date',
                'cities.name as city',
                'event_venues.address',
                'event_venues.name as venue',
                'events.id as eventId',
                'users.id as usersId',
            )
            ->join('orphanages', 'orphanages.id', '=', 'pupils.orphanage_id')
            ->join('users', 'users.id', '=', 'pupils.user_id')
            ->join('event_user', 'event_user.user_id', '=', 'users.id')
            ->join('events', 'events.id', '=', 'event_user.event_id')
            ->join('event_venues', 'events.venue_id', '=', 'event_venues.id')
            ->join('cities', 'events.city_id', '=', 'cities.id')
            ->where('orphanages.id','=',$orphanage->id)
            ->where('event_user.confirmed','=',0)
            ->get();
    }
}
