<?php

namespace Orphanage\Presentation\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Orphanage\Domain\Entity\Orphanage;
use Orphanage\Domain\Entity\Pupil;

class PupilController extends Controller
{
    public function registry()
    {
        return response()->json(Pupil::all());
    }

    public function get(Pupil $pupil)
    {
        return response()->json($pupil);
    }

    public function create(Request $request, Orphanage $orphanage)
    {
        $pupil = new Pupil([
            'name' => $request->name,
            'birthday' => $request->birthday,
            'orphanage_id' => $orphanage->id,
        ]);

        if ($pupil->save()) {
            return response()->json([
                'message' => 'Воспитанник успешно создан!',
            ], 201);
        } else {
            return response()->json([
                'error' => 'Предоставьте правильную информацию',
            ]);
        }
    }
}
