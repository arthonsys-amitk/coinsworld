@extends('front.layouts.master')
@section('content')

<div class="about_banner">
    <div class="container">
        <h1>About Coinsworld</h1>
        <div class="col-md-9 m_auto">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
    </div>
</div>

<div class="our_mission_sec">
    <div class="container">
        <img src="{{ asset('assets/coinsworld/images/b_icon.png') }}"/>
        <div class="small">Lorem Ipsum</div>
        <h1>Our Mission</h1>                
        <div class="col-md-9 m_auto">
            <h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate. velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</h6>
            <h6> Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni.</h6>
        </div>
    </div>
</div>

<div class="suspendis_sec">
    <div class="container">
        <div class="col-md-6 col-sm-6">
            <img src="{{ asset('assets/coinsworld/images/b_coin_bg.jpg') }}"/>
        </div>
        <div class="col-md-6 col-sm-6 suspendis_contnt">
            <h1>Suspendisse arcu purus</h1>
            <div class="suspendis_txt">
                <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</h5>
                <h5>Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
                    in voluptate.</h5>
            </div>

            <div class="join_us_btn"><a href="#">Join Us Now</a></div>
        </div>
    </div>
</div>

<div class="wayfinding_wrp our_mission_sec">
    <div class="container">
        <h1>Our Benifits</h1>                
        <div class="col-md-5 col-sm-6 m_auto">
            <h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</h6>
        </div>
        <div class="wayfinding_bottom_sec">
            <div class="col-md-4 col-sm-6">
                <div class="wayfinding_bottom_feature">
                    <img src="{{ asset('assets/coinsworld/images/safe_secure.png') }}" style="width: 40px"/>
                    <div class="feature_wrp">
                        <h4>Safe & Secure</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adip isicing elit, sed do eiusmod tempor inci didunt.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="wayfinding_bottom_feature">
                    <img src="{{ asset('assets/coinsworld/images/mobile_app.png') }}" style="width: 40px"/>
                    <div class="feature_wrp">
                        <h4>Mobile App</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adip isicing elit, sed do eiusmod tempor inci didunt.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="wayfinding_bottom_feature">
                    <img src="{{ asset('assets/coinsworld/images/secure_wallet.png') }}" style="width: 40px"/>
                    <div class="feature_wrp">
                        <h4>Secure Wallet</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adip isicing elit, sed do eiusmod tempor inci didunt.</p>
                    </div>
                </div>
            </div>


            <div class="col-md-4 col-sm-6">
                <div class="wayfinding_bottom_feature">
                    <img src="{{ asset('assets/coinsworld/images/insurence.png') }}" style="width: 40px"/>
                    <div class="feature_wrp">
                        <h4>Covered by Insurance</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adip isicing elit, sed do eiusmod tempor inci didunt.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="wayfinding_bottom_feature">
                    <img src="{{ asset('assets/coinsworld/images/recurring.png') }}" style="width: 40px"/>
                    <div class="feature_wrp">
                        <h4>Recurring Buying</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adip isicing elit, sed do eiusmod tempor inci didunt.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="wayfinding_bottom_feature">
                    <img src="{{ asset('assets/coinsworld/images/exchange.png') }}" style="width: 40px"/>
                    <div class="feature_wrp">
                        <h4>Instant Exchange</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adip isicing elit, sed do eiusmod tempor inci didunt.</p>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="about_bitcoin another_abt_bitcoin">
    <div class="col-md-6 col-sm-6 pdng_lft mob_pad">
        <img src="{{ asset('assets/coinsworld/images/gold_b_coin.jpg') }}"/>
    </div>
    <div class="col-md-5 col-sm-5 about_bitcoin_txt">
        <div class="about_hd">
            <p>About Bitcoin</p>
            <h1>The standard chunk of <br/>Lorem Ipsum used</h1>
        </div>
        <h6>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </h6>
        <ul>
            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </li>
            <li>eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut </li>
            <li>enim ad minim veniam, Quis nostrud exercitation ullamco laboris </li>
            <li>nisi ut aliquip ex ea commodo consequat.</li>
            <li>Duis aute irure dolor in reprehenderit in voluptate.</li>
        </ul>
    </div>
    <div class="clearfix"></div>
</div>

<div class="call_back_sec">
    <div class="container">
        <div class="col-md-7 col-sm-6">
            <h1>Request a call back</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>

            <form class="req_call_frm" method="post">
                <div class="req_call_wrp">
                    <div class="col-sm-6 pdng_lft mob_pad">
                        <input type="text" class="col-xs-12" placeholder="Name"/>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-sm-6 pdng_rht mob_pad">
                        <input type="text" class="col-xs-12" placeholder="Email"/>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="req_call_wrp">
                    <div class="col-sm-6 pdng_lft mob_pad">
                        <input type="text" class="col-xs-12" placeholder="Phone"/>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-sm-6 pdng_rht mob_pad">
                        <input type="text" class="col-xs-12" placeholder="Subject"/>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="req_call_wrp">
                    <textarea placeholder="Messages" class="col-xs-12" rows="5"></textarea>
                    <div class="clearfix"></div>
                    <div class="clearfix"></div>
                </div>

                <div class="req_call_wrp">
                    <input type="submit" class="col-xs-12" value="Submit info"/>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>                
    </div>
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