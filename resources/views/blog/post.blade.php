<?php
function _substr($str, $length, $minword = 3)
{
    $sub = '';
    $len = 0;
    foreach (explode(' ', $str) as $word) {
        $part = ($sub != '' ? ' ' : '') . $word;
        $sub .= $part;
        $len += strlen($part);
        if (strlen($word) > $minword && strlen($sub) >= $length) {
            break;
        }
    }
    return $sub . ($len < strlen($str) ? '...' : '');
}
?>

<title>Blog</title>

@extends('templates.tpl_default')
@section('blog')
    <div class="banner py-3 mb-4 shadow-sm bg-warning">
        <div class="container">
            <h6 class="m-0 font-weight-bold"><a class="text-dark" href="/home">Home</a> / Blog</h6>
        </div>
    </div>
    <div class="container">
        <section class='tabs-content m-0'>
            @foreach ($posts as $post)
                <article>
                    <img style="width:100%;" src="../images/{{ $post['image_path'] }}" alt="">
                    <h4>{{ $post['title'] }}</h4>

                    <p><i class="pe-7s-user"></i> <span class="font-italic font-weight-bold">
                            {{ $post->users['name'] }}</span> &nbsp;|&nbsp; <i class="pe-7s-date"></i>
                        {{ date('jS M Y', strtotime($post['updated_at'])) }}</p>

                    <p class="text-justify">{{ _substr($post['description'], 250) }}</p>
                    <div class="main-button">
                        <a href="/blog/{{ $post['slugblog'] }}">Continue Reading</a>
                    </div>
                </article>
                <br>
                <br>
            @endforeach
        </section>
    </div>
@endsection
