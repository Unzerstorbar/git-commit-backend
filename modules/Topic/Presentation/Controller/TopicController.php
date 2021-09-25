<?php

namespace Topic\Presentation\Controller;

use App\Http\Controllers\Controller;
use Topic\Domain\Entity\Topic;

class TopicController extends Controller
{
    public function registry()
    {
        return response()->json(Topic::all());
    }
}
