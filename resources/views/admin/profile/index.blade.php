@extends('admin.layouts.app')
@section('mycontent')
    <div class="col-8 offset-3 mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">User Profile</legend>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            @if (Session::has('updateSuccess'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong> {{Session::get('updateSuccess')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            <form class="form-horizontal" method="post" action="{{route('admin#update')}}">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName" placeholder="Name.." name="adminName" value="{{old('adminName',$user->name)}}">
                                        @error('adminName')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail" placeholder="Email"  name="adminEmail" value="{{old('adminEmail',$user->email)}}">
                                        @error('adminEmail')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputEmail" placeholder="Phone" name="adminPhone" value="{{$user->phone}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="adminAddress" id="" cols="30" rows="10" placeholder="Inter your Address">{{$user->address}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                       <select name="adminGender" id="" class="form-control">
                                            @if ($user->gender == 'male')
                                                <option value="empty">Choose your Option</option>
                                                <option value="male" selected>Male</option>
                                                <option value="female">Female</option>
                                            @elseif($user->gender == 'female')
                                                <option value="empty">Choose your Option</option>
                                                <option value="male">Male</option>
                                                <option value="female" selected>Female</option>
                                            @else
                                                <option value="empty" selected>Choose your Option</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            @endif
                                       </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn bg-dark text-white">Update</button>
                                    </div>
                                </div>
                            </form>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <a href="{{route('admin#ChangePasswordPage')}}">Change Password</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
