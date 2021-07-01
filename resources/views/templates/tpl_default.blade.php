<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tiêu đề trang</title>
    <link rel="stylesheet" href="css/style.css" media="all">
</head>

<body>
    @include('includes.header')
    <div class="container">
        <div class="row">
            <article class="col-sm-9 pl-0 mt-2">
                @yield('articlecat')
                @yield('product-detail')
                @yield('article')
            </article>
            <aside class="col-sm-3 pr-0 mt-1">
                <div class="cart">
                    <div class="card">
                        <div class="card-body row">
                            <img class="col-sm-5" src="images/shoppingcart.gif" alt="">
                            <ul class="col-sm-7">
                                <li>
                                    100 items
                                </li>
                                <li>
                                    $ 56.8
                                </li>
                                <li>
                                    <a href="">View cart</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <form action="" method="post">
                                <input type="text" name="" id="" class="form-control" placeholder="Keywords">
                            </form>
                        </div>
                    </div>
                    <ul class="list-group mt-3">
                        <li class="list-group-item bg-secondary active"> <strong>Nhà sản xuất</strong></li>
                        @foreach($nsx as $row)
                        <li class="list-group-item"><a href="{{$row{"_id"} }}.html">{{$row{"tenNSX"} }}</a></li>
                        @endforeach

                    </ul>
                </div>
            </aside>
        </div>
    </div>


    @include('includes.footer')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</body>

</html>