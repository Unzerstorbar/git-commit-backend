<?php

namespace Orphanage\Presentation\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
}
