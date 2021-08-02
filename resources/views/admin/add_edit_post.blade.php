@extends('templates.layout_admin')
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
                        <input type="text" name="title" @if(isset($post['title'])) value="{{$post['title']}}" @else value="{{ old('title')}}" @endif placeholder="Title..." style="height: 80px; font-size: 40px;"
                           required class="form-control border-0">
                        <hr>
                        <textarea name="description" placeholder="Description..." style="font-size: 20px;"
                            class="form-control border-0" id="" cols="5" rows="8">@if(isset($post['description'])) {{$post['description']}} @endif</textarea>
                        <hr>
                        <div class="form-group file-upload pt-0 pl-0 pr-0 m-0 w-100">
                            <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Select a file</button>
                            <div class="image-upload-wrap">
                                <input class="file-upload-input" type='file' name="image_path" onchange="readURL(this);" />
                                <div class="drag-text">
                                    <h3>Drag and drop images here</h3>
                                </div>
                            </div>
                            <div class="file-upload-content">
                                <img class="file-upload-image" src="#" alt="your image" />
                                <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">Delete <span class="image-title">Uploaded Image</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </div>
@endsection
