<div id="banner">
    @if (Session::has('notadmin'))
        <div class="alert alert-danger text-center font-weight-bold m-0" role="alert">
            <p class="m-0">{{ Session::get('notadmin') }}</p>
        </div>
    @endif
    @if (Session::has('notactive'))
        <div class="alert alert-danger text-center font-weight-bold m-0" role="alert">
            <p class="m-0">{{ Session::get('notactive') }}</p>
        </div>
    @endif
    @if (Session::has('notverify'))
        <div class="alert alert-danger text-center font-weight-bold m-0" role="alert">
            <p class="m-0">{{ Session::get('notverify') }}</p>
        </div>
    @endif
    @if (Session::has('status'))
        <div class="alert alert-info text-center font-weight-bold m-0" role="alert">
            <p class="m-0">{{ Session::get('status') }}</p>
        </div>
    @endif
</div>
<header class="background-image border-bottom">

</header>
