<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Blog Detail</title>
</head>

<body>
    @extends('templates.tpl_default')
    @section('blog-detail')
        <div style="margin-top: 87px" class="py-3 mb-4 shadow-sm bg-warning border-top">
            <div class="container">
                <h6 class="m-0 font-weight-bold">Home / Blog / {{ $post['title'] }}</h6>
            </div>
        </div>
        <div class="container">
            <section class='tabs-content'>
                <article>
                    <h4>{{$post['title']}}</h4>

                    <p><i class="pe-7s-user"></i> <span class="font-italic font-weight-bold">
                        {{ $post->users['name'] }}</span> &nbsp;|&nbsp; <i class="pe-7s-date"></i>
                    {{ date('jS M Y', strtotime($post['updated_at'])) }}</p>

                    <div><img src="../images/{{$post['image_path']}}" alt=""></div>

                    <br>
                    <p>{{$post['description']}}</p>

                    <ul class="social-icons">
                        <li>Share this:</li>
                        <li><a href="#"><i class="sp-facebook"></i></a></li>
                        <li><a href="#"><i class="sp-twitter"></i></a></li>
                        <li><a href="#"><i class="sp-linkedin"></i></a></li>
                    </ul>
                </article>
            </section>
        </div>

    @endsection
</body>

</html>
