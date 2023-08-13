<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //admin List
    public function index(){
        $userData = User::select('id','name','email','phone','address','gender')->get();
        return view('admin.list.index',compact('userData'));
    }

    // Delete account
    public function deleteAccount($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'User Account Deleted!']);
    }

    // Admin list search
    public function adminListSearch(Request $request){
        $userData = User::orwhere('name', 'LIKE', '%'.$request->adminSearch. '%')
                    ->orwhere('email', 'LIKE', '%'.$request->adminSearch. '%')
                    ->orwhere('phone', 'LIKE', '%'.$request->adminSearch. '%')
                    ->orwhere('address', 'LIKE', '%'.$request->adminSearch. '%')
                    ->orwhere('gender', 'LIKE', '%'.$request->adminSearch. '%')
                    ->get();
                    return view('admin.list.index',compact('userData'));
    }
}
