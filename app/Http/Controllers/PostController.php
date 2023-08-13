<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    //Driect Post Page
    public function index(){
        $category = Category::get();
        $post = Post::get();
        return view('admin.post.index',compact('category','post'));
    }

    // Create Post
    public function createPost(Request $request){
        $validator = $this->checkPostVatidation($request);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        if(!empty($request->postImage)){
            $file = $request->file('postImage');
            $fileName = uniqid().'_'. $file->getClientOriginalName();
            $file->move(public_path().'/postImage', $fileName);

            $data = $this->getPostData ($request, $fileName);
        }else{
            $data = $this->getPostData ($request, NULL);
        }
        Post::create($data);
        return back();

    }

    // Delete Post
    public function deletePost($id){
        $postData = Post::where('id',$id)->first();
        $dbImage = $postData['image'];

        Post::where('id',$id)->delete();

        if(File::exists(public_path().'/postImage/' .$dbImage)){
            File::delete(public_path().'/postImage/' .$dbImage);

        }
        return back();
    }
// Update Post
public function updatePost($id, Request $request){
    $validator = $this->checkPostVatidation($request);

    if($validator->fails()){
        return back()->withErrors($validator)->withInput();
    }

    $data = $this->requestUpdatePost($request);

    if(isset($request->postImage)){
        $this->storeNewUpdateImage($id,$request,$data);
    }else{
        Post::where('id',$id)->update($data);
    }
    return back();
}
// Direct Update Post Page
    public function updatePostPage($id){
        $postDetails = Post::where('id',$id)->first();
        $category = Category::get();
        $post = Post::get();
        return view('admin.post.update',compact('postDetails', 'category','post'));
    }
    //Store New update image
    private function storeNewUpdateImage($id, $request,$data){
        // Get From client
        $file = $request->file('postImage');
        $fileName = uniqid().'_'. $file->getClientOriginalName();

        //Put New Image to data Array
        $data['image'] = $fileName;

        // Get image name from Database
        $postData = Post::where('id',$id)->first();
        $dbImage = $postData['image'];

        //delete image from public folder
        if(File::exists(public_path().'/postImage/' .$dbImage)){
            File::delete(public_path().'/postImage/' .$dbImage);
        }

        // update New image under public Folder
        $file->move(public_path().'/postImage', $fileName);

        // update new data with New image
        Post::where('id',$id)->update($data);

    }
    // Request Update Post
    private function requestUpdatePost($request){
        return[
            'title'=>$request->postTitle,
            'description'=> $request->postDescription,
            'category_id'=>$request->postCategory,
        ];
    }
    //file Validatation
    private function getPostData($request, $fileName){
        return[
            'title'=>$request->postTitle,
            'description'=>$request->postDescription,
            'image'=>$fileName,
            'category_id'=>$request->postCategory
        ];
    }

    // Post Validation Check
    private function checkPostVatidation($request){
        return Validator::make($request->all(),[
            'postTitle'=>'required',
            'postDescription'=> 'required',
            'postCategory'=>'required'
        ]);
    }
}
