<?php

namespace Orphanage\Presentation\Controller;

use App\Http\Controllers\Controller;
use Orphanage\Domain\Entity\Pupil;

class PupilController extends Controller
{
    public function registry()
    {
        return response()->json(Pupil::all());
    }

    public function get(Pupil $pupil)
    {
        return response()->json($pupil);
    }
}
