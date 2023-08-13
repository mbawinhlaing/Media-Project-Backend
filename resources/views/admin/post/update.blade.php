@extends('admin.layouts.app')
@section('mycontent')
<div class="col-4">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin#updatePost',$postDetails['id'])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Post Create page</label>
                    <input type="text" class="form-control" value="{{ $postDetails['title']}}" name="postTitle" placeholder="Enter Category">
                    @error('postTitle')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea id=""  cols="30"class="form-control"  name="postDescription" rows="10">{{old("postDescription",$postDetails['description'])}}</textarea>
                    @error('postDescription')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <img  width="100% rounded shadow"
                    @if ($postDetails['image'] == null)
                        src="{{ asset('defaultImage/default.jpg')}}"
                    @else
                        src="{{ asset('postImage/'. $postDetails['image'])}}"
                    @endif
                    >

                    <input type="file" name="postImage" class="form-control" id="">
                    @error('postImage')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Category Name</label>
                    <select name="postCategory" id="" class="form-control">
                        <option value="">Choose Category..</option>

                        @foreach ($category as $item )
                            <option value="{{$item['id']}}" @if ($item['id']==$postDetails['category_id']) selected

                            @endif>{{$item['title']}}</option>
                        @endforeach

                    </select>
                    @error('postCategory')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <button class="submit" class="btn btn-info">Update Post</button>
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
              <th>Post ID</th>
              <th>Title</th>
              <th>image</th>
              <th></th>
            </tr>
          </thead>
          <tbody>

            @foreach ( $post as $item)
            <tr>
                <td>{{ $item['id']}}</td>
                <td>{{$item[ 'title']}}</td>
                <td class="col-2"><img class="rounded shadow-sm" width="100px"
                    @if ($item['image'] == null)
                    src="{{ asset('defaultImage/default.jpg')}}"
                    @else
                    src="{{ asset('postImage/'. $item['image'])}}"
                    @endif
                    alt=""></td>
                <td>
                    <a href="{{route('admin#updatePage',$item['id'])}}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>

                    <a href="{{route('admin#deletePost',$item['id'])}}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
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
