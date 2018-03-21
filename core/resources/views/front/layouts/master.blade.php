<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Coinsworld</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('assets/coinsworld/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/coinsworld/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/coinsworld/css/media_query.css') }}">
        <link href="{{ asset('assets/coinsworld/css/skdslider.css') }}" rel="stylesheet">
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                <![endif]-->
    </head>

    <body>

        <div class="top_head">
            <div class="container">
                <div class="call_mail_wrp">
                    <ul>
                        <li><span>Call:</span> {!!$contact->mobile!!}</li>
                        <li><span>Mail:</span> {!!$contact->email!!}</li>
                    </ul>
                </div>

                <div class="log_signup_wrp">
                    <ul>
                        <li>
                            <div class="lan_sec">
                                <select id="language" name="language" required="required">
                                    <option value="1">English</option>
                                    <option value="0">Arabic</option>
                                </select>
                            </div>
                        </li>
                        <li><a href="#" data-toggle="modal" data-target="#signin">Login</a></li>
                        <li class="signup"><a href="#" data-toggle="modal" data-target="#signup">Sign Up</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- Sign In Modal -->
        <div id="signin" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">

                <!-- Modal content-->
                <div class="modal-content signin_pop">
                    <div class="modal-body">
                        <img src="{{ asset('assets/images/logo/logo.png') }}"/>
                        <h1>Sign in here</h1>
                        <div class="col-md-6 col-sm-6 m_auto">
                            <form class="req_call_frm" method="post" action="{{ route('postLogin') }}">
                                {{ csrf_field() }}
                                <div class="req_call_wrp">
                                    <input class="col-xs-12" name="username" placeholder="Username" type="text">
                                    <div class="clearfix"></div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="req_call_wrp">
                                    <input class="col-xs-12" name="password" placeholder="Password" type="password">
                                    <div class="clearfix"></div>
                                </div>

                                <div class="req_call_wrp">
                                    <input value="Sign In" type="submit">
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Sign Up Modal -->
        <!-- Sign Up Modal -->
        <div id="signup" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">

                <!-- Modal content-->
                <div class="modal-content signin_pop">
                    <div class="modal-body">
                        <img src="images/logo.png"/>
                        <h1>Sign up now</h1>
                        <div class="col-md-12 col-sm-12 m_auto">
                            <form class="req_call_frm" method="post">
                                <div class="req_call_wrp col-md-6 col-sm-6">
                                    <input class="col-xs-12" placeholder="First Name" type="text">
                                    <div class="clearfix"></div>
                                </div>

                                <div class="req_call_wrp col-md-6 col-sm-6">
                                    <input class="col-xs-12" placeholder="Last Name" type="text">
                                    <div class="clearfix"></div>
                                </div>

                                <div class="req_call_wrp col-md-6 col-sm-6">
                                    <input class="col-xs-12" placeholder="Username" type="text">
                                    <div class="clearfix"></div>
                                </div>

                                <div class="req_call_wrp col-md-6 col-sm-6">
                                    <input class="col-xs-12" placeholder="Email" type="email">
                                    <div class="clearfix"></div>
                                </div>

                                <div class="req_call_wrp col-md-6 col-sm-6">
                                    <input class="col-xs-12" placeholder="Password" type="password">
                                    <div class="clearfix"></div>
                                </div>

                                <div class="req_call_wrp col-md-6 col-sm-6">
                                    <input class="col-xs-12" placeholder="Confirm Password" type="password">
                                    <div class="clearfix"></div>
                                </div>

                                <div class="req_call_wrp col-md-6 col-sm-6">
                                    <input class="col-xs-12" placeholder="Phone" type="text">
                                    <div class="clearfix"></div>
                                </div>

                                <div class="req_call_wrp col-md-6 col-sm-6">
                                    <select class="col-xs-12 select_country">
                                        <option value="">-- Select Country --</option>
                                        <option value="1">India</option>
                                        <option value="2">USA</option>
                                        <option value="3">Afganistan</option>
                                    </select>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="req_call_wrp col-md-12 col-sm-12">
                                    <input value="Sign up" type="submit">
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <nav class="navbar navbar-default navbar-static-top mynavbar-default menu_logo">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('assets/images/logo/logo.png')}}" alt="logo" /></a>

                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{url('/about')}}">About</a></li>
                        <li><a href="{{url('/service')}}">Service</a></li>                        
                        <!--<li><a href="pages.html">Pages</a></li>-->
                        <li><a href="{{url('/blog')}}">Blog</a></li>
                        <li><a href="{{url('/contact')}}">Contact</a></li>
                        <!--<li class="get_quote"><a href="#">Get a Quote?</a></li>-->
                    </ul>
                </div>
                <!--/.nav-collapse --> 
            </div>
        </nav>
  <!--main menu section end-->
@include('front.layouts.message')
@yield('content')

<!-- Online Section End -->

<div class="clearfix"></div>
 

<div class="clearfix"></div>
@include('front.layouts.footer')

<style type="text/css">
  li.export-main {
    visibility: hidden;
}
</style>

        <!--jquery script load-->
        <script type="text/javascript" src="{{ asset('assets/coinsworld/js/jquery-1.10.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/coinsworld/js/bootstrap.js') }}"></script>
        <script src="{{ asset('assets/coinsworld/js/skdslider.min.js') }}"></script>
        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery('#demo1').skdslider({'delay': 5000, 'animationSpeed': 2000, 'showNextPrev': false, 'showPlayButton': false, 'autoSlide': true, 'animationType': 'fading'});
            });
        </script>
    </body>
</html>



















