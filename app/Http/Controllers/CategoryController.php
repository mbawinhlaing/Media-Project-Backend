<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //Admin Dricter Category Page
    public function index(){
       $category = Category::get();
        return view('admin.category.index',compact('category'));
    }

    // Create Category Data
    public function categoryCreate(Request $request){
        $validator = $this->categoryValidationCheck($request);
        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        }
        $data = $this->categoryCreatePage($request);
        Category::create($data);
        return back();
    }

    // Delete Category
    public function deleteCategory($id){
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Category Delete!']);
    }

    //Category Search
    public function categorySearch(Request $request){
        $category = Category::where('title','LIKE','%'.$request->categorySearch.'%')->get();
        return view('admin.category.index',compact('category'));
    }

    //Update category
    public function categoryUpdate($id,Request $request){
        $validator = $this->categoryValidationCheck($request);
        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        }
        $updateData = $this->getUpdateData($request);
        Category::where('id',$id)->update($updateData);
        return redirect()->route('admin#category');

    }
    // Category edit page
    public function categoryedit($id){
        $category = Category::get();
        $updateData = Category::where('id',$id)->first();
         return view('admin.category.edit',compact('category','updateData'));
    }

    //  Category Validation Check
    private function categoryValidationCheck($request){
        $valicationRules = [
            'categoryName'=>'required',
            'categoryDescription'=>'required'
        ];
        return Validator::make($request->all(),$valicationRules);
    }

    // Get Update Data
    private function getUpdateData($request){
        return[
            'title'=>$request->categoryName,
            'description'=>$request->categoryDescription
        ];
    }


    private function categoryCreatePage($request){
        return [
            'title'=>$request->categoryName,
            'description'=>$request->categoryDescription
        ];
    }
}
