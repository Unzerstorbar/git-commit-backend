<?php

namespace Address\Presentation\Controller;

use Address\Domain\Entity\City;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    public function registry()
    {
        return response()->json(City::all());
    }
}
