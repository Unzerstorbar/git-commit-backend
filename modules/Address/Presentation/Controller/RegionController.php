<?php

namespace Address\Presentation\Controller;

use Address\Domain\Entity\Region;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    public function registry()
    {
        return response()->json(Region::all());
    }
}
