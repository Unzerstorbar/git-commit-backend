<?php

namespace Address\Presentation\Controller;

use Address\Domain\Entity\District;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    public function registry()
    {
        return response()->json(District::all());
    }
}
