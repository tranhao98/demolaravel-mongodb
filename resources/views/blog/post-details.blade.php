<title>Blog Detail</title>

@extends('templates.tpl_default')
@section('blog-detail')
    <div class="banner py-3 mb-4 shadow-sm bg-warning">
        <div class="container">
            <h6 class="m-0 font-weight-bold"><a class="text-dark" href="/home">Home</a> / <a class="text-dark"
                    href="/blog">Blog</a> / {{ $post['title'] }}</h6>
        </div>
    </div>
    <div class="container">
        <section class='tabs-content m-0'>
            <article>
                <h4>{{ $post['title'] }}</h4>

                <p><i class="pe-7s-user"></i> <span class="font-italic font-weight-bold">
                        {{ $post->users['name'] }}</span> &nbsp;|&nbsp; <i class="pe-7s-date"></i>
                    {{ date('jS M Y H:i A', strtotime($post['updated_at'])) }}</p>

                <div><img width="100%" src="../images/{{ $post['image_path'] }}" alt=""></div>

                <br>
                <p class="text-justify">{{ $post['description'] }}</p>

                <ul class="social-icons">
                    <li>Share this:</li>
                    <li><a href="#"><i class="sp-facebook"></i></a></li>
                    <li><a href="#"><i class="sp-twitter"></i></a></li>
                    <li><a href="#"><i class="sp-linkedin"></i></a></li>
                </ul>
            </article>
        </section>
        <br>
        <br>
        <br>
        <section class='tabs-content m-0 w-100'>
            <div class="row">
                <div class="col-md-8 width_post_comment">
                    <input type="hidden" name="idPost" id="idPost" value="{{ $post['_id'] }}">
                    <h4><span id="AppendNumberComment">{{ $count_comment }}</span> Comments</h4>
                    <ul class="features-items">
                        <div id="AppendPostComment" style="overflow: scroll; overflow-x:hidden; height: 350px">
                        </div>
                    </ul>
                </div>
                <div class="col-md-4 width_post_comment_form">
                    <h4>Leave a comment</h4>
                    <div class="contact-form">
                        <form id="saveComment" action="javascript:void(0);" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <fieldset>
                                        <input type="hidden" name="idPost" id="idPost" value="{{ $post['_id'] }}">
                                        <textarea name="message" rows="6" id="message" placeholder="Message"></textarea>
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <button type="submit" id="form-submit" class="main-button">Submit</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <br>
        <br>
        <br>
    </div>

@endsection
