@extends('templates.layout_admin');
@section('add-edit-coupon')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Catalogues</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Posts</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <form action="/admin/add-edit-post/{{ $post['_id'] }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card shadow" style="font-size: 15px">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                        <div class="card-tools float-right">
                            <a href="/admin/posts"><button type="button" class="btn btn-tool">
                                    <i class="fas fa-minus"></i>
                                </button></a>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                            </button>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <input type="text" name="title" @if(isset($post['title'])) value="{{$post['title']}} @endif" placeholder="Title..." style="height: 80px; font-size: 40px;"
                            class="form-control border-0">
                        <hr>
                        <textarea name="description" placeholder="Description..." style="font-size: 20px;"
                            class="form-control border-0" id="" cols="5" rows="8">@if(isset($post['description'])) {{$post['description']}} @endif</textarea>
                        <hr>
                        @if(!isset($post['image_path']))
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image_path" id="customFile">
                            <label class="custom-file-label text-uppercase" for="customFile">Select a file</label>
                        </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </div>

@endsection
