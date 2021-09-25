<?php

namespace Tag\Presentation\Controller;

use App\Http\Controllers\Controller;
use Tag\Domain\Entity\Tag;

class TagController extends Controller
{
    public function registry()
    {
        return response()->json(Tag::all());
    }
}
