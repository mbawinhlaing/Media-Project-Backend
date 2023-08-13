@extends('admin.layouts.app')
@section('mycontent')
    <div class="col-8 offset-3 mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">Change Password</legend>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            @if (Session::has('fail'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong> {{Session::get('fail')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            <form class="form-horizontal" method="post" action="{{route('admin#changePassword')}}">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Old Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputName" placeholder="Name.." name="oldPassword" value="">
                                        @error('oldPassword')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputEmail" placeholder="New Password"  name="newPassword" value="">
                                        @error('newPassword')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Confrin Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputEmail" placeholder="confrin Password" name="confirmPassword" value="">
                                            @error('confirmPassword')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                    </div>

                                </div>


                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn bg-dark text-white">Change Password</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
