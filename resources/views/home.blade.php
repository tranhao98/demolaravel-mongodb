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
<title>Home</title>
@extends('templates.tpl_default')
@section('article')
    @include('includes.header')
    {{-- Products Start --}}
    <section class="bg-light">
        <div class="container all_product">
            <div class="card border-0 bg-light">
                <div class="card-header bg-light border-0 text-center">
                    <h4 class="m-0 pt-4 pb-4 text-uppercase font-weight-bold">All Product's</h4>
                    <img src="images/line-dec.png" alt="">
                </div>
                <div class="card-body">
                    <div class="card-columns product_list">
                        @foreach ($dt as $product)

                            <div class="card text-center">
                                <div class="card-header">
                                    <a href="/{{ $product['slug'] }}.html">{{ $product['tenDT'] }}</a>
                                </div>
                                <a href="/{{ $product['slug'] }}.html">
                                    <div class="card-body">
                                        <img style="height: 150px;" src="images/{{ $product['urlHinh'] }}" alt="">
                                    </div>
                                </a>
                                <div class="card-footer text-muted">
                                    <del>{{ number_format($product['gia'], 0, ',', '.') }} VNĐ</del> <br>
                                    <span>{{ number_format($product['giaKM'], 0, ',', '.') }} VNĐ</span>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
                <div class="card-footer bg-light border-0 pagination_prod">
                    <div class="col-lg-12 text-center"> {{ $dt->links('pagination') }}</div>
                </div>
            </div>
        </div>
    </section>
    {{-- Products End --}}

    {{-- Blog Start --}}
    <section>
        <div class="container our_blog">
            <div class="card border-0">
                <div class="card-header header-bg border-0 text-center">
                    <h4 class="m-0 pt-4 pb-4 text-uppercase font-weight-bold">Read our blog</h4>
                    <img src="images/line-dec.png" alt="">
                </div>
                <div class="card-body">
                    <div class="row" id="tabs">
                        <div class="col-lg-8">
                            <section class='tabs-content'>
                                <?php $dem = 1; ?>
                                @foreach ($posts as $post)
                                    <article id='tabs-{{ $dem++ }}'>
                                        <img src="images/{{ $post['image_path'] }}" height="350px"
                                            style="object-fit: cover" width="100%" alt="">
                                        <h4>{{ $post['title'] }}
                                        </h4>
                                        <p><i class="pe-7s-user"></i> <span class="font-italic font-weight-bold">
                                                {{ $post->users['name'] }}</span> &nbsp;|&nbsp; <i
                                                class="pe-7s-date"></i>
                                            {{ date('jS M Y', strtotime($post['updated_at'])) }}</p>
                                        <p class="blog_description text-justify">{{ _substr($post['description'], 250) }}
                                        </p>
                                        <div class="main-button">
                                            <a href="/blog/{{ $post['slugblog'] }}">Continue Reading</a>
                                        </div>
                                    </article>
                                @endforeach
                            </section>
                        </div>
                        <div class="col-lg-4">
                            <ul>
                                <?php $dem = 1; ?>
                                @foreach ($posts as $post)
                                    <li><a href='#tabs-{{ $dem++ }}'>{{ $post['title'] }}</a></li>
                                @endforeach
                                <div class="main-rounded-button"><a href="/blog">Read More</a></div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Blog End --}}

    {{-- Branch Start --}}
    <section class="bg-light">
        <div class="container">
            <div class="card border-0 bg-light">
                <div class="card-header bg-light border-0 text-center">
                    <h4 class="pt-4 pb-4 m-0 text-uppercase font-weight-bold">Our Branches</h4>
                    <img src="images/line-dec.png" alt="">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="owl-carousel branch-carousel owl-theme">
                            @foreach ($branch as $bra)
                                <div class="item">
                                    <div class="card">
                                        <a href="/{{ $bra['slug'] }}-branch/"><img
                                                src="images/{{ $bra['logo'] }}"></a>
                                        <div class="card-body">
                                            <a href="/{{ $bra['slug'] }}-branch/">
                                                <h5 class="card-title">{{ $bra['name'] }}</h5>
                                            </a>
                                            <p class="card-text" style="height: 50px"><i class="pe-7s-map-marker"></i>
                                                <small>{{ $bra['address'] }}</small> <br>
                                                <i class="pe-7s-culture"></i> <small>{{ $bra['city'] }}</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Branch End --}}
@endsection
