<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use User\Presentation\Controller\UserDocumentController;

class RegisterController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'second_name' => 'required|string',
            'last_name' => 'required|string',
            'birthday' => 'required|date',
            'phone' => 'string',
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
            'c_password' => 'required|same:password',
        ]);

        $user = new User([
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'last_name' => $request->last_name,
            'birthday' => $request->birthday,
            'phone' => $request->phone,
            'role_id' => $request->role ? $request->role['id'] : null,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        if ($user->save()) {
            if (!empty($request->document_series) && !empty($user->id)) {
                (new UserDocumentController())->create($request, $user);
            }

            return response()->json([
                'message' => 'Пользователь успешно создан!',
            ], 201);
        } else {
            return response()->json([
                'error' => 'Предоставьте правильную информацию',
            ]);
        }
    }
}
