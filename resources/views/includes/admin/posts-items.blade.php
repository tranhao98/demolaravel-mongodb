<div class="card shadow" style="font-size: 13px">
    <div class="card-header">
        <h3 class="card-title">Posts</h3>
        <a href="/admin/add-edit-post" style="width: 150px" class="float-right btn btn-success pl-4 pr-4"> Add
            Post</a>
    </div>
    <div class="card-body ">
        <div class="row font-weight-bold">
            <div class="col-md-2 align-self-center">
                Image
            </div>
            <div class="col-md-2 align-self-center">
                Title
            </div>
            <div class="col-md-2 align-self-center">
                Author
            </div>
            <div class="col-md-2 align-self-center">
                Slug
            </div>
            <div class="col-md-2 align-self-center">
                Created on
            </div>
            <div class="col-md-2 align-self-center">
                Actions
            </div>
        </div>
        <hr>

        @foreach ($posts as $post)
            <div class="row post_data">
                <div class="col-md-2 align-self-center">
                    <img style="width: 80%;" src="../images/{{ $post['image_path'] }}" alt="">
                </div>
                <div class="col-md-2 align-self-center">
                    {{ $post['title'] }}
                </div>
                <div class="col-md-2 align-self-center">
                    {{ $post->users['name'] }}
                </div>
                <div class="col-md-2 align-self-center">
                    {{ $post['slugblog'] }}
                </div>

                <div class="col-md-2 align-self-center">
                    {{ date('d/m/Y', strtotime($post['created_at'])) }}
                </div>
                <div class="col-md-2 align-self-center">
                    <a href="/admin/add-edit-post/{{ $post['_id'] }}"><i class="fa fa-edit"
                            style="font-size:18px"></i></a>&nbsp;&nbsp;
                    <a class="delete-post" href="#"><i class="fa fa-trash"
                            style="font-size:18px"></i></a>&nbsp;&nbsp;

                    <input type="hidden" value="{{ $post['_id'] }}" class="idPost">
                </div>
            </div>
            <hr>
        @endforeach
    </div>
</div>