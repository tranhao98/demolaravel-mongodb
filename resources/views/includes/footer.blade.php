<footer class="footer-area">
    <div class="footer-top">
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <br>
                        <a class="navbar-brand" href="/home">
                            <h2>hphone <em>Website</em></h2>
                        </a>
                        <div class="single-footer footer-logo">
                            <br>
                            <br>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A quas quibusdam atque! Optio
                                aut illo consectetur reprehenderit atque, eius, impedit itaque nesciunt error animi
                                deleniti? Repellat impedit numquam consequatur iste.</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-12 width_quick_footer">
                        <div class="single-footer footer-contact">
                            <h2>contact us</h2>
                            <ul>
                                <li>
                                    <i class="sp-phone"></i>
                                    <span>
                                        <a class="text-white" href="tel:+84795462116">+84 (079) 5462116</a>
                                    </span>

                                </li>
                                <li>
                                    <i class="sp-email"></i>
                                    <span>
                                        <a class="text-white" href="mailto:hphone@domain.com">hphone@domain.com</a>
                                    </span>
                                    <span>
                                        <a class="text-white" href="mailto:hphone@email.info">hphone@email.info</a>
                                    </span>
                                </li>
                                <li>
                                    <i class="sp-map-marker"></i>
                                    <span>123/1 Lý Chính Thắng</span>
                                    <span>Quận 3, TP.HCM</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 footer_menu col-xs-12">
                        <div class="single-footer footer-menu">
                            <h2>company</h2>
                            <ul>
                                <li><a href="/my-profile">Account</a></li>
                                <li><a href="{{ route('login') }}">Log in</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                                <li><a href="/home">Shop</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="width_quick_footer col-md-3 col-sm-4 col-xs-12">
                        <div id="AppendContactForm">
                            @include('includes.contact_form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="copyright-brief">
                        <p>Copyright &copy; <a href="/home">Long Trấn Hào</a> All right reserved</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="footer-social text-right">
                        <a href="#"><i class="sp-facebook"></i></a>
                        <a href="#"><i class="sp-twitter"></i></a>
                        <a href="#"><i class="sp-linkedin"></i></a>
                        <a href="#"><i class="sp-google"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
