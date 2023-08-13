@extends('admin.layouts.app')
@section('mycontent')
<div class="col-4">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin#categoryCreate')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Category Name</label>
                    <input type="text" class="form-control" name="categoryName" placeholder="Enter Category">
                    @error('categoryName')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea id="" cols="30"class="form-control" name="categoryDescription" rows="10"></textarea>
                    @error('categoryDescription')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <button class="submit" class="btn btn-info">Create</button>
            </form>
        </div>
    </div>
</div>
<div class="col-7">

    @if (Session::has('deleteSuccess'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong> {{Session::get('deleteSuccess')}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Category Table</h3>

        <form action="{{route('admin#categorySearch')}}" method="POST">
            @csrf
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="categorySearch" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
        </form>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>Category ID</th>
              <th>Category Name</th>
              <th>Description</th>
              <th></th>
            </tr>
          </thead>
          <tbody>

            @foreach ( $category as $item)
            <tr>
                <td>{{ $item['id']}}</td>
                <td>{{$item[ 'title']}}</td>
                <td>{{$item['description']}}</td>
                <td>
                    <a href="{{route('admin#categoryEditPage',$item['id'])}}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>

                    <a href="{{route('admin#deleteCategory',$item['id'])}}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
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
