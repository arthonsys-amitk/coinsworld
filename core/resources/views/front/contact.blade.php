@extends('front.layouts.master')
@section('content')

<div class="about_banner cntct_banner">
    <div class="container">
        <h1>Get in touch with Coinsworld</h1>
        <div class="col-md-7 m_auto">
            <p>We pride ourselves on our excellent customer service. This includes access to a personal account manager, either over the phone, via email or in person.</p>
        </div>
    </div>
</div>

<div class="map_info_sec">
    <div class="col-md-6 col-sm-7 no_pddng">
        <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d14737.048664610167!2d88.45385760198975!3d22.569295986904915!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1520586946069" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
    <div class="col-md-6 col-sm-5 cntct_info">
        <h1>Contact Info.</h1>
        <div class="col-lg-8 col-md-10">
            <ul>
                <li>
                    <h5>Address</h5>
                    <h6>International House, 24, Holborn Viaduct London EC1A 2BN, United Kingdom.</h6>
                </li>
                <li>
                    <h5>Email</h5>
                    <h6>contact@cryptogo.com</h6>
                </li>
                <li>
                    <h5>Phone</h5>
                    <h6>+44 (0) 203 950 0950</h6>
                </li>
            </ul>
        </div>
    </div>
    <div class="container"></div>
</div>

<div class="wayfinding_wrp our_mission_sec">
    <div class="container">
        <h1>Talk to our experts</h1>                
        <div class="col-md-5 col-sm-6 m_auto">
            <h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</h6>
        </div>
        <div class="experts_wrp">
            <div class="col-md-3 col-sm-3">
                <div class="team_mem">
                    <div class="team_pic">
                        <img src="{{ asset('assets/coinsworld/images/vivian_kim.jpg') }}"/>
                    </div>
                    <div class="team_mem_dtl">
                        <h4>Vivian Kim</h4>
                        <h6>Operations</h6>
                    </div>
                    <div class="social_icos">
                        <a href="#"><img src="{{ asset('assets/coinsworld/images/fb_ico.png') }}"/></a>
                        <a href="#"><img src="{{ asset('assets/coinsworld/images/tw_ico.png') }}"/></a>
                        <a href="#"><img src="{{ asset('assets/coinsworld/images/linked_ico.png') }}"/></a>
                    </div>
                    <div class="join_us_btn"><a href="#">Get in touch</a></div>
                </div>
            </div>

            <div class="col-md-3 col-sm-3">
                <div class="team_mem">
                    <div class="team_pic">
                        <img src="{{ asset('assets/coinsworld/images/dan_kinon.jpg') }}"/>
                    </div>
                    <div class="team_mem_dtl">
                        <h4>Dan Kinon</h4>
                        <h6>Dev Ops</h6>
                    </div>
                    <div class="social_icos">
                        <a href="#"><img src="{{ asset('assets/coinsworld/images/fb_ico.png') }}"/></a>
                        <a href="#"><img src="{{ asset('assets/coinsworld/images/tw_ico.png') }}"/></a>
                        <a href="#"><img src="{{ asset('assets/coinsworld/images/linked_ico.png') }}"/></a>
                    </div>
                    <div class="join_us_btn"><a href="#">Get in touch</a></div>
                </div>
            </div>

            <div class="col-md-3 col-sm-3">
                <div class="team_mem">
                    <div class="team_pic">
                        <img src="{{ asset('assets/coinsworld/images/megan_meyer.jpg') }}"/>
                    </div>
                    <div class="team_mem_dtl">
                        <h4>Megan Meyer</h4>
                        <h6>Product</h6>
                    </div>
                    <div class="social_icos">
                        <a href="#"><img src="{{ asset('assets/coinsworld/images/fb_ico.png') }}"/></a>
                        <a href="#"><img src="{{ asset('assets/coinsworld/images/tw_ico.png') }}"/></a>
                        <a href="#"><img src="{{ asset('assets/coinsworld/images/linked_ico.png') }}"/></a>
                    </div>
                    <div class="join_us_btn"><a href="#">Get in touch</a></div>
                </div>
            </div>

            <div class="col-md-3 col-sm-3">
                <div class="team_mem">
                    <div class="team_pic">
                        <img src="{{ asset('assets/coinsworld/images/brad.jpg') }}"/>
                    </div>
                    <div class="team_mem_dtl">
                        <h4>Brad Landthorn</h4>
                        <h6>Marketing</h6>
                    </div>
                    <div class="social_icos">
                        <a href="#"><img src="{{ asset('assets/coinsworld/images/fb_ico.png') }}"/></a>
                        <a href="#"><img src="{{ asset('assets/coinsworld/images/tw_ico.png') }}"/></a>
                        <a href="#"><img src="{{ asset('assets/coinsworld/images/linked_ico.png') }}"/></a>
                    </div>
                    <div class="join_us_btn"><a href="#">Get in touch</a></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="boost_income">
    <div class="container">
        <div class="col-md-6 col-sm-4">
            <h5>Ready to boost your income?</h5>
            <p>Lorem ipsum dolor sit amet, con labore et dolore magna aliqua.sectetur adipisicing elit.</p>
            <div class="clearfix"></div>
        </div>

        <div class="col-md-4 col-sm-5 pdng_lft">
            <div class="call_us">
                <h3>Call us: (333) 052 39876</h3>
            </div>
            <h4 class="or_txt">Or</h4>
            <div class="clearfix"></div>
        </div>

        <div class="col-md-2 col-sm-3 col-xs-8">
            <div class="contact_btn"><a href="#">Contact us</a></div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
        
@endsection