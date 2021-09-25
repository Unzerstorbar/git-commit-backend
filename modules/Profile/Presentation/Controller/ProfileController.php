<?php

namespace Profile\Presentation\Controller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function registry()
    {
        return response()->json(User::all());
    }

    public function get(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        $fields = [
            'first_name',
            'second_name',
            'last_name',
            'about',
            'birthday',
            'phone',
        ];

        foreach ($fields as $field) {
            if (!empty($request->$field)) {
                $user->$field = $request->$field;
            }
        }

        if ($user->update()) {
            return response()->json([
                'message' => 'Пользователь успешно обновлён!',
            ]);
        } else {
            return response()->json([
                'error' => 'Предоставьте правильную информацию',
            ], 422);
        }
    }

    public function destroy(User $user)
    {
        if ($user->delete()) {
            return response()->json([
                'message' => 'Пользователь успешно удалён!',
            ]);
        } else {
            return response()->json([
                'error' => 'Ошибка при удалении детского дома',
            ], 422);
        }
    }

    public function changePassword(Request $request, User $user)
    {
        $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string',
            'c_password' => 'required|same:password',
        ]);

        $user->password = bcrypt($request->password);

        if ($user->update()) {
            return response()->json([
                'message' => 'Пароль пользователя успешно изменён!',
            ]);
        } else {
            return response()->json([
                'error' => 'Проверьте правильность заполненных данных',
            ], 422);
        }
    }

    public function events(User $user)
    {
        return response()->json([
            'forthcoming' => [],
            'completed' => [],
        ]);
    }

    public function documents(User $user)
    {
        return response()->json([]);
    }
}
