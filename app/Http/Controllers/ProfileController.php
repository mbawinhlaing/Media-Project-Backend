<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //Dricte Admin Profile
    public function index(){
        $id = Auth::user()->id;
        $user = User::select('id','name','email','address','phone','gender')->where('id',$id)->first();
        return view('admin.profile.index',compact('user'));
    }

    //Update Account
    public function adminUpdateAccount(Request $request){
        $userData = $this->getUserInfo($request);
        $validator = $this->userValidationCheck($request);

        if ($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        User::where('id',Auth::user()->id)->update($userData);
        return back()->with(['updateSuccess'=>'update Success']);
    }

//Dricet Password Page
    public function changePasswordPage(){
        return view('admin.profile.changePassowrd');
    }

    // Change Password
    public function changePassword(Request $request){
        $validator = $this->changePasswordValidation($request);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $dbData = User::where('id',Auth::user()->id)->first();
        $dbPassword = $dbData->password;

        $hashUserPassword = Hash::make($request->newPassword);
        // $old= Hash::make($request->oldPasswrod);

        $updateData = [
            'password'=>$hashUserPassword,
            'updated_at'=>Carbon::now()
        ];

        if(Hash::check($request->oldPassword, $dbPassword)){
            User::where('id', Auth::user()->id)->update($updateData);
            return redirect()->route('dashboard');
        }else{
            return back()->with(['fail'=>'old Password Do Not Match']);
        }
    }

    private function getUserInfo($request){
        return[
            'name'=>$request->adminName,
            'email'=>$request->adminEmail,
            'address'=>$request->adminAddress,
            'phone'=>$request->adminPhone,
            'gender'=>$request->adminGender,
            'updated_at'=>Carbon::now(),
        ];
    }

    //User Validation Check
    private function userValidationCheck($request){
        return Validator::make($request->all(),[
            'adminName'=>'required',
            'adminEmail'=>'required'
        ],[
            'adminName.required'=> 'Pls Write Your Update Name',
            'adminEmail.required'=>'Pls Write your Update Email'
        ]);
    }

    //Change password Validation
    private function changePasswordValidation($request){
        $validationRules = [
            'oldPassword'=>'required',
            'newPassword'=>'required|min:8|max:15',
            'confirmPassword'=>'required|same:newPassword|min:8|max:15'
        ];
        $validationMessage = [
            'confirmPassword.same'=> 'New Password & Confirm Password must be same'
        ];
        return Validator::make($request->all(),$validationRules,$validationMessage);
    }
}
