<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesAPIController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $reponse = [];
        foreach ($categories as $category) {
            array_push($reponse, [
                'id' => $category->id,
                'category_name' => $category->category_name,
                'category_image' => asset('images/categories/'.$category->category_image),
                'category_color' => $category->category_color,
            ]);
        }
        return response(json_encode($reponse),200);
    }
}
