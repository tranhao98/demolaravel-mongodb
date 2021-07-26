<title>Blog Detail</title>

@extends('templates.tpl_default')
@section('blog-detail')
    <div class="banner py-3 mb-4 shadow-sm bg-warning">
        <div class="container">
            <h6 class="m-0 font-weight-bold"><a class="text-dark" href="/home">Home</a> / <a class="text-dark" href="/blog">Blog</a> / {{ $post['title'] }}</h6>
        </div>
    </div>
    <div class="container">
        <section class='tabs-content'>
            <article>
                <h4>{{ $post['title'] }}</h4>

                <p><i class="pe-7s-user"></i> <span class="font-italic font-weight-bold">
                        {{ $post->users['name'] }}</span> &nbsp;|&nbsp; <i class="pe-7s-date"></i>
                    {{ date('jS M Y', strtotime($post['updated_at'])) }}</p>

                <div><img width="100%" src="../images/{{ $post['image_path'] }}" alt=""></div>

                <br>
                <p>{{ $post['description'] }}</p>

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
