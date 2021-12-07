<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seria;

class SeriesController extends Controller
{
    public function addSeria(Request $request)
    {
        $title = $request->input('title');
        if ($title === null) {
            return json_encode( ['result' => false] );
        }

        $seria = new Seria();
        $seria->title = $title;
        $seria->save();

        return json_encode([ 'result' => true, 'id' => $seria->seria_id ]);
    }
}
