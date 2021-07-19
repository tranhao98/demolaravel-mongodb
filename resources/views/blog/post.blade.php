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
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Blog</title>
</head>

<body>
    @extends('templates.tpl_default')
    @section('blog')
        <div style="margin-top: 87px" class="py-3 mb-4 shadow-sm bg-warning border-top">
            <div class="container">
                <h6 class="m-0 font-weight-bold">Home / Blog</h6>
            </div>
        </div>
        <div class="container">
            <section class='tabs-content'>
                @foreach ($posts as $post)
                    <article>
                        <img src="../images/{{$post['image_path']}}" alt="">
                        <h4>{{ $post['title'] }}</h4>

                        <p><i class="pe-7s-user"></i> <span class="font-italic font-weight-bold">
                                {{ $post->users['name'] }}</span> &nbsp;|&nbsp; <i class="pe-7s-date"></i>
                            {{ date('jS M Y', strtotime($post['updated_at'])) }}</p>

                        <p>{{ _substr($post['description'], 250) }}</p>
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

</body>

</html>
