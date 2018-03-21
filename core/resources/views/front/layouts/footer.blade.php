<div class="footer">
    <div class="container">

        <div class="footer_upper">
            <div class="col-md-4 col-sm-4">
                <div class="logo_white"><img src="{{ asset('assets/coinsworld/images/logo-white.png') }}"/></div>
                <div class="social_icon">
                    <a href="#"><img src="{{ asset('assets/coinsworld/images/fb_ico_white.png') }}"/></a>
                    <a href="#"><img src="{{ asset('assets/coinsworld/images/twitter_ico_white.png') }}"/></a>
                    <a href="#"><img src="{{ asset('assets/coinsworld/images/linked_ico_white.png') }}"/></a>
                    <a href="#"><img src="{{ asset('assets/coinsworld/images/y_ico_white.png') }}"/></a>
                </div>
            </div>

            <div class="col-md-2 col-sm-2">
                <h5>Menu</h5>
                <ul>                        
                    <li><a href="#">Benefits</a></li>
                    <li><a href="#">Our Research</a></li>
                    <li><a href="#">Technologies</a></li>
                    <li><a href="#">Investors</a></li>
                    <li><a href="{{url('/about')}}">About</a></li>
                </ul>
            </div>

            <div class="col-md-2 col-sm-2">
                <h5>Carrers</h5>
                <ul>                        
                    <li><a href="#">Job</a></li>
                    <li><a href="#">Developer</a></li>
                    <li><a href="#">Staff</a></li>
                    <li><a href="#">More..</a></li>
                </ul>
            </div>

            <div class="col-md-4 col-sm-4">
                <h5>Contacts</h5>
                <ul>                        
                    <li class="location">{!!$contact->location!!}</li>
                    <li class="mail">{!!$contact->email!!}</li>
                    <li class="phone">{!!$contact->mobile!!}</li>
                </ul>
            </div>    
            <div class="clearfix"></div>
        </div>                
    </div>

    <div class="footer_lower">
        <div class="container">
            <p class="copyrht">Copyright © 2018. All Rights Reserved</p>
            <ul>
                <li><a href="#">Sitemap</a></li>
                <li><a href="#">Legal</a></li>
            </ul>
        </div>
    </div>
</div>