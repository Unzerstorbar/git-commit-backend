<?php

namespace User\Presentation\Controller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use User\Domain\Entity\UserDocument;

class UserDocumentController extends Controller
{
    public function create(Request $request, User $user = null)
    {
        $userDocument = new UserDocument([
            'user_id' => !empty($user)                     ? $user->id : ($request->user ? $request->user['id'] : null),
            'type' => $request->type                       ?: ($request->document_type ?: 'passport'),
            'series' => $request->series                   ?: $request->document_series,
            'number' => $request->number                   ?: $request->document_number,
            'issued' => $request->issued                   ?: $request->document_issued,
            'issued_date' => $request->issued_date         ?: $request->document_issued_date,
            'department_code' => $request->department_code ?: $request->document_department_code,
        ]);

        if ($userDocument->save()) {
            return response()->json([
                'message' => 'Документ пользователя успешно создан!',
            ], 201);
        } else {
            return response()->json([
                'error' => 'Предоставьте правильную информацию для создания документа пользователя',
            ], 422);
        }
    }
}
