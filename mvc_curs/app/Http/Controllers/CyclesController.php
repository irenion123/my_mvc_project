<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cycle;

class CyclesController extends Controller
{
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required|min:3|unique:cycles'
        ]);

        $validation->setAttributeNames([
            'title' => '"Название цикла"'
        ]);

        if ($validation->fails()) {
            return $this->jsonError($validation->errors());
        }

        $validated = $validation->validated();

        $cycle = new Cycle();
        $cycle->title = $validated['title'];
        $cycle->save();

        // return json_encode([ 'result' => true, 'id' => $cycle->cycle_id ]);
        return $this->jsonSuccess([ 'id' => $cycle->cycle_id ]);
    }

    public function index()
    {
        return Cycle::all();
    }

    public function show(Cycle $cycle)
    {
        return $cycle;
    }
}
