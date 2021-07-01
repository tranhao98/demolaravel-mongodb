<div class="container">
    <header class="row">
        <div class="col-6 pl-0">
            <div class="shopping-mall">
                <h1>Online shopping mall</h1>
                <h5>The center point of the professional programming</h5>
            </div>
        </div>
        <div class="col-6 pr-0 d-flex justify-content-end">
            <img src="images/header-object.png" alt="">
        </div>
    </header>

    <nav class="row rounded navbar navbar-expand-lg bg-secondary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse d-flex justify-content-start" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home">Home</a>
                    </li>
                    @foreach ($nsx as $menu)
                    <li class="nav-item">
                        <a class="nav-link" href="{{$menu{"_id"} }}.html">{{$menu{"tenNSX"} }}</a>
                    </li>
                    @endforeach
                </ul>

            </div>
            <div class="right d-flex justify-content-end">
                <a style="margin-right: 10px;" class="menu-right" href="">English</a>
                <a class="menu-right" href="English">Tiếng Việt</a>
            </div>
        </div>
    </nav>
</div>