<?php

namespace App\Http\Controllers\api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    // Get All Post
    public function getAllPost(){
        $post = Post::get();

        return response()->json([
            'status'=>"success",
            'post'=> $post
        ]);
    }

    //Get All Post

    public function postGet($id){
        $postId = Post::where('category_id',$id)->get();
        return response()->json([
            'status'=>'success',
            'allPost'=> $postId
        ]);
    }

    //GetSinglePost
    public function getSinglePost($id){
        $singlePost = Post::where('id',$id)->first();
        return response()->json($singlePost);
    }


     //Post Search
    public function postSearch(Request $request){
            $post = Post::where('title','Like','%'.$request->key .'%')->get();
            return response()->json([
                'searchData'=>$post
            ]);
    }

    //Post Detail
    public function postDetails(Request $request){
        $id = $request->postId;
           $post = Post::where('id',$id)->first();
           return response()->json([
            'post' => $post
           ]);
    }
}
