<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Translator;


class TranslatorsPageController extends Controller
{
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'fullname' => 'required'
        ]);

        $validation->setAttributeNames([
            'fullname' => '"Фамилия Имя Отчество"'
        ]);

        if ($validation->fails()) {
            return $this->jsonError($validation->errors());
        }

        $validated = $validation->validated();

        $translator = new Translator();
        $translator->fullname = $validated['fullname'];
        $translator->save();

        return $this->jsonSuccess([ 'id' => $translator->translator_id ]);
    }
    public function index()
    {
        return Translator::all();
    }

    public function show(Translator $translator)
    {
        return $translator;
    }

}
