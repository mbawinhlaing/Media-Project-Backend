<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Get Category
    public function getAllCategory(){
        $category =Category::select('id','title','description')->get();

        return response()->json([
            'category'=>$category
        ]);
    }

    // Search Category
    public function categorySearch(Request $request){
        $category = Category::select('posts.*')
                    ->join('posts', 'categories.id','posts.category_id')
                    ->where('categories.title','LIKE','%'.$request->key.'%')
                    ->get();
        return response()->json([
            'resul'=> $category
        ]);
    }

}
