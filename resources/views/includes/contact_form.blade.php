<div class="single-footer footer-message">
    <form id="contact_form" method="POST" action="javascript:void(0);">
        <h2>Quick contact</h2>
        <div class="footer-message-box">
            <input type="text" id="email_contact" placeholder="your email address" />
            <textarea id="message" class="message" placeholder="your message"></textarea>
            <button type="submit" class="d-flex align-items-center justify-content-center"
                id="btn_contact_form">Submit</button>
        </div>
    </form>
</div>
@if (Session::has('mess'))
    <p style="color: #f6416c; font-size: 13px; font-style: italic" class="m-0">
        {{ Session::get('mess') }}
    </p>
@endif
