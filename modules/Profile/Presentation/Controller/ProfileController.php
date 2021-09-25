<?php

namespace Profile\Presentation\Controller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function get(Request $request, User $user)
    {
        return response()->json($user);
    }
}
