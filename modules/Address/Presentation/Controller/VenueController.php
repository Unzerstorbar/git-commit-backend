<?php

namespace Address\Presentation\Controller;

use Address\Domain\Entity\Venue;
use App\Http\Controllers\Controller;

class VenueController extends Controller
{
    public function registry()
    {
        return response()->json(Venue::all());
    }
}
