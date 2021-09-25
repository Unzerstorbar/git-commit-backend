<?php

namespace Orphanage\Presentation\Controller;

use App\Http\Controllers\Controller;
use Orphanage\Domain\Entity\Orphanage;

class OrphanageController extends Controller
{
    public function registry()
    {
        return response()->json(Orphanage::all());
    }

    public function get(Orphanage $orphanage)
    {
        return response()->json($orphanage);
    }
}
