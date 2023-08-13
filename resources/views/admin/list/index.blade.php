@extends('admin.layouts.app')
@section('mycontent')

<div class="col-12">
    <div class="card">

        @if (Session::has('deleteSuccess'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong> {{Session::get('deleteSuccess')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

      <div class="card-header">
        <h3 class="card-title">Admin Table</h3>

        <div class="card-tools">
          <form action="{{route('admin#list')}}" method="post">
            @csrf
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="adminSearch" value="{{old('adminSearch')}}" class="form-control float-right" placeholder="Search">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
          </form>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>User ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Gender</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($userData as $item)
            <tr>
                <td>{{$item['id']}}</td>
                <td>{{$item['name']}}</td>
                <td>{{$item['email']}}</td>
                <td>{{$item['phone']}}</td>
                <td>{{$item['address']}}</td>
                <td>{{$item['gender']}}</td>
                <td>
                  <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                 @if (Auth::user()->id != $item ['id'])

                    <a
                    @if (count($userData) == 1) href="#"
                        @else
                        href="{{ route('admin#accountDelete', $item['id']) }}"
                    @endif

                    ><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>

                 @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>

@endsection
