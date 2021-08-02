<div class="card shadow">
    <div class="card-header d-flex align-items-center">
            <h3 class="card-title w-100">Posts</h3>
       
        <a href="/admin/add-edit-post" style="width: 150px" class="btn btn-success pl-4 pr-4"> Add
            Post</a>
    </div>
    <div class="card-body">
        <table id="posts" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Slug</th>
                    <th class="text-nowrap">Created on</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td style="width: 20%" class="align-middle"> <img style="width: 100%;"
                                src="../images/{{ $post['image_path'] }}" alt=""></td>
                        <td class="align-middle">{{ $post['title'] }}</td>
                        <td class="align-middle">
                            {{ $post->users['name'] }}
                        </td>
                        <td class="align-middle"> {{ $post['slugblog'] }}</td>
                        <td class="align-middle"> {{ date('d/m/Y', strtotime($post['created_at'])) }}</td>
                        <td class="align-middle post_data"> <a href="/admin/add-edit-post/{{ $post['_id'] }}"><i
                                    class="fa fa-edit" style="font-size:18px"></i></a>&nbsp;&nbsp;
                            <a class="delete-post" href="#"><i class="fa fa-trash"
                                    style="font-size:18px"></i></a>&nbsp;&nbsp;

                            <input type="hidden" value="{{ $post['_id'] }}" class="idPost">
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
