<?php

namespace Orphanage\Presentation\Controller;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'type_id' => 1
        ]);
        if ($user->save()) {
            $pupil = new Pupil([
                'name' => $request->name,
                'birthday' => $request->birthday,
                'orphanage_id' => $orphanage->id,
                'user_id' => $user->id,
            ]);

            if ($pupil->save()) {
                return response()->json([
                    'message' => 'Воспитанник успешно создан!',
                ], 201);
            } else {
                return response()->json([
                    'error' => 'Предоставьте правильную информацию',
                ], 422);
            }
        } else {
            return response()->json([
                'error' => 'Предоставьте правильную информацию пользователя',
            ], 422);
        }
    }

    public function destroy(Pupil $pupil)
    {
        if (!empty($pupil->user_id)) {
            $user = User::all()->where('id', '=', $pupil->user_id)->get();
            if (!empty($user)) {
                $user->delete();
            }
        }

        if ($pupil->delete()) {
            return response()->json([
                'message' => 'Воспитанник успешно удалён!',
            ]);
        } else {
            return response()->json([
                'error' => 'Ошибка при удалении воспитанника',
            ], 422);
        }
    }
}
