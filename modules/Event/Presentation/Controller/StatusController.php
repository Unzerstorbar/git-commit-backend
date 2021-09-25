<?php

namespace Event\Presentation\Controller;

use App\Http\Controllers\Controller;
use Event\Domain\Entity\Status;

class StatusController extends Controller
{
    public function registry()
    {
        return response()->json(Status::all());
    }
}
