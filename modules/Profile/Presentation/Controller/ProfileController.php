<?php

namespace Profile\Presentation\Controller;

use App\Http\Controllers\Controller;
use App\Models\User;

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
}
