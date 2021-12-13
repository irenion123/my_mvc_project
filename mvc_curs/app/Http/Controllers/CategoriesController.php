<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'title_eng' => 'required'
        ]);

        $validation->setAttributeNames([
            'title' => '"Название категории"',
            'title_eng' => '"Название категории на английском"'
        ]);

        if ($validation->fails()) {
            return $this->jsonError($validation->errors());
        }

        $validated = $validation->validated();

        $category = new Category();
        $category->title = $validated['title'];
        $category->title_eng = $validated['title_eng'];
        $category->save();

        return $this->jsonSuccess([ 'id' => $category->category_id ]);
    }
    public function index()
    {
        return Category::all();
    }

    public function show(Category $category)
    {
        return $category;
    }
}
