<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActionLog;

class ActionLogController extends Controller
{
 public function setActiionlog(Request $request){
 $data = [
    'user_id'=>$request->user_id,
    'post_id'=>$request->post_id
 ];
 ActionLog::create($data);
 $data = ActionLog::where('post_id', $request->post_id)->get();
    return response()->json([
        'post'=> $data
    ]);
 }
}
