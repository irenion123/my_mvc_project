<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function addCategory(Request $request)
    {
        $title = $request->input('title');
        $titleEng = $request->input('title_eng');
        if ($title === null) {
            return json_encode( ['result' => false] );
        }
        if ($titleEng === null) {
            return json_encode( ['result' => false] );
        }

        $category = new Category();
        $category->title = $title;
        $category->title_eng = $titleEng;
        $category->save();

        return json_encode([ 'result' => true, 'id' => $category->category_id ]);
    }
}
