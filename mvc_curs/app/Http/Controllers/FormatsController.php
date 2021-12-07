<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Format;

class FormatsController extends Controller
{
    public function addFormat(Request $request)
    {
        $width = $request->input('width');
        $height = $request->input('height');
        if ($width === null) {
            return json_encode( ['result' => false] );
        }
        if ($height === null) {
            return json_encode( ['result' => false] );
        }

        $format = new Format();
        $format->width = $width;
        $format->height = $height;
        $format->save();

        return json_encode([ 'result' => true, 'id' => $format->format_id ]);
    }
}
