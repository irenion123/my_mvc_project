<?php

namespace App\Http\Controllers;

use App\Models\Translator;
use Illuminate\Http\Request;

class TranslatorsPageController extends Controller
{

    // Страницы переводчиков пока нет
    // public function index()
    // {
    // }

    public function addTranslator(Request $request)
    {
        $fullname = $request->input('fullname');
        if ($fullname === null) {
            return json_encode( ['result' => false] );
        }

        $translator = new Translator();
        $translator->fullname = $fullname;
        $translator->save();

        return json_encode(
            [ 'result' => true, 'id' => $translator->translator_id ]
        );
    }

}
