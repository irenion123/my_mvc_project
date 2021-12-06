<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cycle;

class CyclesController extends Controller
{
    public function addCycle(Request $request)
    {
        $title = $request->input('title');
        if ($title === null) {
            return json_encode( ['result' => false] );
        }

        $cycle = new Cycle();
        $cycle->title = $title;
        $cycle->save();

        return json_encode([ 'result' => true, 'id' => $cycle->cycle_id ]);
    }
}
