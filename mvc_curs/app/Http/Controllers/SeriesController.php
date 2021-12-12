<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Seria;

class SeriesController extends Controller
{

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required|min:3|unique:series'
        ]);

        $validation->setAttributeNames([
            'title' => '"Название серии"'
        ]);

        if ($validation->fails()) {
            return $this->jsonError($validation->errors());
        }

        $validated = $validation->validated();

        $seria = new Seria();
        $seria->title = $validated['title'];
        $seria->save();

        return $this->jsonSuccess([ 'id' => $seria->seria_id ]);
    }

    public function index()
    {
        return Seria::all();
    }

    public function show(Seria $seria)
    {
        return $seria;
    }

}
