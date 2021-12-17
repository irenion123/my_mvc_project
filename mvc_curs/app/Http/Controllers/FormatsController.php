<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Format;

class FormatsController extends Controller
{
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'width' => 'required|numeric|gte:1',
            'height' => 'required|numeric|gte:1'
        ]);

        $validation->setAttributeNames([
            'width' => '"Ширина"',
            'height' => '"Высота"'
        ]);

        if ($validation->fails()) {
            return $this->jsonError($validation->errors());
        }

        $validated = $validation->validated();

        $format = new Format();
        $format->width = $validated['width'];
        $format->height = $validated['height'];
        $format->save();

        return $this->jsonSuccess([ 'id' => $format->format_id ]);
    }
    public function index()
    {
        return Format::all();
    }

    public function show(Format $format)
    {
        return $format;
    }
}
