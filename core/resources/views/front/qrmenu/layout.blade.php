<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$bs->website_title}}</title>

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{asset('assets/front/img/'.$bs->favicon)}}" type="image/png">
    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/front/css/qr-plugins.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/qr-menu.css')}}">
    @if ($defaultLang->rtl == 1)
    <link rel="stylesheet" href="{{asset('assets/front/css/qr-rtl.css')}}">
    @endif
    <link rel="stylesheet" href="{{ asset('assets/front/css/qr-styles.php?color='.str_replace('#','',$bs->base_color)) }}">
    <!--====== jquery js ======-->
    <script src="{{asset('assets/front/js/vendor/jquery.3.2.1.min.js')}}"></script>
</head>
<body class="qr-menu">
    <div class="header">
        <div class="container">
            <div class="row align-items-center">
                @auth
                <div class="col-6">
                @endauth
                @guest
                <div class="col-12 text-center">
                @endguest
                    <div class="logo-wrapper">
                        <a href="{{route('front.qrmenu')}}"><img src="{{asset('assets/front/img/'.$bs->logo)}}" alt="Logo"></a>
                    </div>
                </div>
                @auth
                <div class="col-6">
                    <a href="{{route('front.qrmenu.logout')}}" class="btn btn-primary float-right base-btn">{{__('Logout')}}</a>
                </div>
                @endauth
            </div>
        </div>
    </div>

    <div class="qr-breadcrumb lazy" data-bg="{{asset('assets/front/img/'.$bs->breadcrumb)}}">
        <div class="container">
            <div class="qr-breadcrumb-details">
                <h2>{{$bs->website_title}}</h2>
                <small>{{__('Working Hours')}}: {{$bs->office_time}}</small>
            </div>
            <h4 class="qr-page-heading">
                @yield('page-heading')
            </h4>
        </div>
    </div>


    @yield('content')

    {{-- Loader --}}
    <div class="request-loader">
        <img src="{{asset('assets/admin/img/loader.gif')}}" alt="">
    </div>
    {{-- Loader --}}

    {{-- START: Cart Icon --}}
    <div class="cart-icon">
        <div id="cartQuantity">
            <img src="{{asset('assets/front/img/static/cart-icon.png')}}" alt="Cart Icon">
            <span class="cart-count">{{$itemsCount}}</span>
        </div>
    </div>
    {{-- END: Cart Icon --}}


    {{-- START: Cart Sidebar --}}
    @includeIf('front.qrmenu.partials.qr-cart-sidebar')
    {{-- END: Cart Sidebar --}}

    <!--====== Bootstrap js ======-->
    <script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/front/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/front/js/qr-plugins.js')}}"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $( "input.datepicker" ).datepicker();
            $('input.timepicker').timepicker();
        })

        "use strict";
        var mainurl = "{{url('/')}}";
        var position = "{{$be->base_currency_symbol_position}}";
        var symbol = "{{$be->base_currency_symbol}}";
        var textPosition = "{{$be->base_currency_text_position}}";
        var currText = "{{$be->base_currency_text}}";

        $(document).on('click', '.qty-add', function() {
            $(".cart-sidebar-loader-container").addClass('show');

            let $this = $(this);
            let key = $(this).data('key');
            let $input = $this.prev('input');
            $input.val(parseInt($input.val()) + 1);
            let qty = $input.val();

            changeQty(key, qty);
        });

        $(document).on('click', '.qty-sub', function() {
            $(".cart-sidebar-loader-container").addClass('show');

            let $this = $(this);
            let key = $(this).data('key');
            let $input = $this.next('input');
            if ($input.val() <= 1) {
                toastr["error"]("Quantity must be minimum 1");
                $(".cart-sidebar-loader-container").removeClass('show');
                return;
            }
            $input.val(parseInt($input.val()) - 1);
            let qty = $input.val();

            changeQty(key, qty);
        });

        function changeQty(key, qty) {
            let fd = new FormData();
            fd.append('qty', qty);
            fd.append('key', key);
            $.ajax({
                url: "{{route('front.qr.qtyChange')}}",
                type: 'POST',
                data: fd,
                contentType: false,
                processData: false,
                success: function(data) {
                    toastr['success']('Quantity updated');
                    $("#cartQuantity").load(location.href + " #cartQuantity");
                    $("#refreshDiv").load(location.href + " #refreshDiv", function() {
                        setTimeout(function() {
                            $(".cart-sidebar-loader-container").removeClass('show');
                        }, 100);
                    });
                }
            })
        }


        $(document).on('click', '.cart-item .close', function() {
            $(".cart-sidebar-loader-container").addClass('show');
            let $this = $(this);
            let key = $this.data('key');
            let fd = new FormData();
            fd.append('key', key);

            $.ajax({
                url: "{{route('front.qr.remove')}}",
                type: 'POST',
                data: fd,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    toastr['success']('Item removed');
                    $("#cartQuantity").load(location.href + " #cartQuantity");
                    $("#refreshDiv").load(location.href + " #refreshDiv", function() {
                        setTimeout(function() {
                            $(".cart-sidebar-loader-container").removeClass('show');
                        }, 100);
                    })
                }
            })
        })
    </script>
    <script src="{{asset('assets/front/js/qr-cart.js')}}"></script>

    @if (session()->has('success'))
    <script>
       "use strict";
       toastr["success"]("{{__(session('success'))}}");
    </script>
    @endif

    @if (session()->has('warning'))
    <script>
       "use strict";
       toastr["warning"]("{{__(session('warning'))}}");
    </script>
    @endif

    @if (session()->has('error'))
    <script>
       "use strict";
       toastr["error"]("{{__(session('error'))}}");
    </script>
    @endif

    @yield('script')
</body>
</html>
