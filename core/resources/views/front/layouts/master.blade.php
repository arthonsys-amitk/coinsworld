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
							<input type="hidden" id="hdajaxurl" name="hdajaxurl" value="{{ route('ajax.login') }}" />
							
                            <form id="frmSignin" class="req_call_frm" method="post" action="{{ route('postLogin') }}">
                                {{ csrf_field() }}
                                <div class="req_call_wrp">
                                    <input class="col-xs-12" id="username" name="username" placeholder="Username" type="text">
                                    <div class="clearfix"></div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="req_call_wrp">
                                    <input class="col-xs-12" id="password" name="password" placeholder="Password" type="password">
                                    <div class="clearfix"></div>
                                </div>

                                <div class="req_call_wrp">
                                    <input value="Sign In" type="submit" id="btnSignin" name="btnSignin">
									<div id="errSignin" class="divdisabled" style="color: #ff0000; margin: 10px 0px;"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                        </div>
						<div class="frm_rel_txt">
                            <h6>Not a member? <a id="signup-linked" href="javascript:;">Sign up now</a></h6>
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
                <div class="modal-content signin_pop" style="padding-top: 5px;">
                    <div class="modal-body">
                        <img src="{{ asset('assets/images/logo/logo.png') }}"/>
                        <h1>Sign up now</h1>
                        <div class="col-md-12 col-sm-12 m_auto">
                            <form class="req_call_frm" method="post" action="{{ route('register') }}">
								{{ csrf_field() }}
                                <div class="req_call_wrp col-md-6 col-sm-6">
                                    <input class="col-xs-12" placeholder="First Name" type="text" value="{{ old('firstname') }}" name="firstname" id="firstname"  required>
									@if ($errors->has('firstname'))
									<span class="help-block">
									  <strong>{{ $errors->first('firstname') }}</strong>
									</span>
									@endif
                                    <div class="clearfix"></div>
                                </div>

                                <div class="req_call_wrp col-md-6 col-sm-6">
                                    <input class="col-xs-12" placeholder="Last Name" type="text" name="lastname" id="lastname" value="{{ old('lastname') }}"  required>
									@if ($errors->has('lastname'))
									<span class="help-block">
									  <strong>{{ $errors->first('lastname') }}</strong>
									</span>
									@endif
                                    <div class="clearfix"></div>
                                </div>

                                <div class="req_call_wrp col-md-6 col-sm-6">
                                    <input class="col-xs-12" placeholder="Username" type="text" value="{{ old('username') }}" name="username" id="username"  required>
									@if ($errors->has('username'))
									 <span class="help-block">
									  <strong>{{ $errors->first('username') }}</strong>
									</span>
									@endif
                                    <div class="clearfix"></div>
                                </div>

                                <div class="req_call_wrp col-md-6 col-sm-6">
                                    <input class="col-xs-12" placeholder="Email" type="email" name="email" id="email" value="{{ old('email') }}" required >
									@if ($errors->has('email'))
									  <span class="help-block">
										<strong>{{ $errors->first('email') }}</strong>
									  </span>
									@endif
                                    <div class="clearfix"></div>
                                </div>

                                <div class="req_call_wrp col-md-6 col-sm-6">
                                    <input class="col-xs-12" placeholder="Password" type="password" name="password" id="password" required >
									@if ($errors->has('password'))
									  <span class="help-block">
										<strong>{{ $errors->first('password') }}</strong>
									  </span>
									  @endif
                                    <div class="clearfix"></div>
                                </div>

                                <div class="req_call_wrp col-md-6 col-sm-6">
                                    <input class="col-xs-12" placeholder="Confirm Password" type="password"  id="password-confirm" name="password_confirmation" required>
									@if ($errors->has('password'))
									<span class="help-block">
									  <strong>{{ $errors->first('password') }}</strong>
									</span>
									@endif
                                    <div class="clearfix"></div>
                                </div>

                                <div class="req_call_wrp col-md-6 col-sm-6">
                                    <input class="col-xs-12" placeholder="Mobile" type="text" id="mobile" name="mobile">
                                    <div class="clearfix"></div>
                                </div>

								<div class="req_call_wrp col-md-6 col-sm-6">
                                    <input class="col-xs-12" placeholder="City" type="text" id="city" name="city">
                                    <div class="clearfix"></div>
                                </div>
								
								
                                <div class="req_call_wrp col-md-12 col-sm-12">
                                    <select name="country" id="country"  class="select_country" >
										  <option value="Afghanistan">Afghanistan</option>
										  <option value="Albania">Albania</option>
										  <option value="Algeria">Algeria</option>
										  <option value="American Samoa">American Samoa</option>
										  <option value="Andorra">Andorra</option>
										  <option value="Angola">Angola</option>
										  <option value="Anguilla">Anguilla</option>
										  <option value="Antartica">Antarctica</option>
										  <option value="Antigua and Barbuda">Antigua and Barbuda</option>
										  <option value="Argentina">Argentina</option>
										  <option value="Armenia">Armenia</option>
										  <option value="Aruba">Aruba</option>
										  <option value="Australia">Australia</option>
										  <option value="Austria">Austria</option>
										  <option value="Azerbaijan">Azerbaijan</option>
										  <option value="Bahamas">Bahamas</option>
										  <option value="Bahrain">Bahrain</option>
										  <option value="Bangladesh">Bangladesh</option>
										  <option value="Barbados">Barbados</option>
										  <option value="Belarus">Belarus</option>
										  <option value="Belgium">Belgium</option>
										  <option value="Belize">Belize</option>
										  <option value="Benin">Benin</option>
										  <option value="Bermuda">Bermuda</option>
										  <option value="Bhutan">Bhutan</option>
										  <option value="Bolivia">Bolivia</option>
										  <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
										  <option value="Botswana">Botswana</option>
										  <option value="Bouvet Island">Bouvet Island</option>
										  <option value="Brazil">Brazil</option>
										  <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
										  <option value="Brunei Darussalam">Brunei Darussalam</option>
										  <option value="Bulgaria">Bulgaria</option>
										  <option value="Burkina Faso">Burkina Faso</option>
										  <option value="Burundi">Burundi</option>
										  <option value="Cambodia">Cambodia</option>
										  <option value="Cameroon">Cameroon</option>
										  <option value="Canada">Canada</option>
										  <option value="Cape Verde">Cape Verde</option>
										  <option value="Cayman Islands">Cayman Islands</option>
										  <option value="Central African Republic">Central African Republic</option>
										  <option value="Chad">Chad</option>
										  <option value="Chile">Chile</option>
										  <option value="China">China</option>
										  <option value="Christmas Island">Christmas Island</option>
										  <option value="Cocos Islands">Cocos (Keeling) Islands</option>
										  <option value="Colombia">Colombia</option>
										  <option value="Comoros">Comoros</option>
										  <option value="Congo">Congo</option>
										  <option value="Congo">Congo, the Democratic Republic of the</option>
										  <option value="Cook Islands">Cook Islands</option>
										  <option value="Costa Rica">Costa Rica</option>
										  <option value="Cota D'Ivoire">Cote d'Ivoire</option>
										  <option value="Croatia">Croatia (Hrvatska)</option>
										  <option value="Cuba">Cuba</option>
										  <option value="Cyprus">Cyprus</option>
										  <option value="Czech Republic">Czech Republic</option>
										  <option value="Denmark">Denmark</option>
										  <option value="Djibouti">Djibouti</option>
										  <option value="Dominica">Dominica</option>
										  <option value="Dominican Republic">Dominican Republic</option>
										  <option value="East Timor">East Timor</option>
										  <option value="Ecuador">Ecuador</option>
										  <option value="Egypt">Egypt</option>
										  <option value="El Salvador">El Salvador</option>
										  <option value="Equatorial Guinea">Equatorial Guinea</option>
										  <option value="Eritrea">Eritrea</option>
										  <option value="Estonia">Estonia</option>
										  <option value="Ethiopia">Ethiopia</option>
										  <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
										  <option value="Faroe Islands">Faroe Islands</option>
										  <option value="Fiji">Fiji</option>
										  <option value="Finland">Finland</option>
										  <option value="France">France</option>
										  <option value="France Metropolitan">France, Metropolitan</option>
										  <option value="French Guiana">French Guiana</option>
										  <option value="French Polynesia">French Polynesia</option>
										  <option value="French Southern Territories">French Southern Territories</option>
										  <option value="Gabon">Gabon</option>
										  <option value="Gambia">Gambia</option>
										  <option value="Georgia">Georgia</option>
										  <option value="Germany">Germany</option>
										  <option value="Ghana">Ghana</option>
										  <option value="Gibraltar">Gibraltar</option>
										  <option value="Greece">Greece</option>
										  <option value="Greenland">Greenland</option>
										  <option value="Grenada">Grenada</option>
										  <option value="Guadeloupe">Guadeloupe</option>
										  <option value="Guam">Guam</option>
										  <option value="Guatemala">Guatemala</option>
										  <option value="Guinea">Guinea</option>
										  <option value="Guinea-Bissau">Guinea-Bissau</option>
										  <option value="Guyana">Guyana</option>
										  <option value="Haiti">Haiti</option>
										  <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
										  <option value="Holy See">Holy See (Vatican City State)</option>
										  <option value="Honduras">Honduras</option>
										  <option value="Hong Kong">Hong Kong</option>
										  <option value="Hungary">Hungary</option>
										  <option value="Iceland">Iceland</option>
										  <option value="India">India</option>
										  <option value="Indonesia">Indonesia</option>
										  <option value="Iran">Iran (Islamic Republic of)</option>
										  <option value="Iraq">Iraq</option>
										  <option value="Ireland">Ireland</option>
										  <option value="Israel">Israel</option>
										  <option value="Italy">Italy</option>
										  <option value="Jamaica">Jamaica</option>
										  <option value="Japan">Japan</option>
										  <option value="Jordan">Jordan</option>
										  <option value="Kazakhstan">Kazakhstan</option>
										  <option value="Kenya">Kenya</option>
										  <option value="Kiribati">Kiribati</option>
										  <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
										  <option value="Korea">Korea, Republic of</option>
										  <option value="Kuwait">Kuwait</option>
										  <option value="Kyrgyzstan">Kyrgyzstan</option>
										  <option value="Lao">Lao People's Democratic Republic</option>
										  <option value="Latvia">Latvia</option>
										  <option value="Lebanon" >Lebanon</option>
										  <option value="Lesotho">Lesotho</option>
										  <option value="Liberia">Liberia</option>
										  <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
										  <option value="Liechtenstein">Liechtenstein</option>
										  <option value="Lithuania">Lithuania</option>
										  <option value="Luxembourg">Luxembourg</option>
										  <option value="Macau">Macau</option>
										  <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
										  <option value="Madagascar">Madagascar</option>
										  <option value="Malawi">Malawi</option>
										  <option value="Malaysia">Malaysia</option>
										  <option value="Maldives">Maldives</option>
										  <option value="Mali">Mali</option>
										  <option value="Malta">Malta</option>
										  <option value="Marshall Islands">Marshall Islands</option>
										  <option value="Martinique">Martinique</option>
										  <option value="Mauritania">Mauritania</option>
										  <option value="Mauritius">Mauritius</option>
										  <option value="Mayotte">Mayotte</option>
										  <option value="Mexico">Mexico</option>
										  <option value="Micronesia">Micronesia, Federated States of</option>
										  <option value="Moldova">Moldova, Republic of</option>
										  <option value="Monaco">Monaco</option>
										  <option value="Mongolia">Mongolia</option>
										  <option value="Montserrat">Montserrat</option>
										  <option value="Morocco">Morocco</option>
										  <option value="Mozambique">Mozambique</option>
										  <option value="Myanmar">Myanmar</option>
										  <option value="Namibia">Namibia</option>
										  <option value="Nauru">Nauru</option>
										  <option value="Nepal">Nepal</option>
										  <option value="Netherlands">Netherlands</option>
										  <option value="Netherlands Antilles">Netherlands Antilles</option>
										  <option value="New Caledonia">New Caledonia</option>
										  <option value="New Zealand">New Zealand</option>
										  <option value="Nicaragua">Nicaragua</option>
										  <option value="Niger">Niger</option>
										  <option value="Nigeria">Nigeria</option>
										  <option value="Niue">Niue</option>
										  <option value="Norfolk Island">Norfolk Island</option>
										  <option value="Northern Mariana Islands">Northern Mariana Islands</option>
										  <option value="Norway">Norway</option>
										  <option value="Oman">Oman</option>
										  <option value="Pakistan">Pakistan</option>
										  <option value="Palau">Palau</option>
										  <option value="Panama">Panama</option>
										  <option value="Papua New Guinea">Papua New Guinea</option>
										  <option value="Paraguay">Paraguay</option>
										  <option value="Peru">Peru</option>
										  <option value="Philippines">Philippines</option>
										  <option value="Pitcairn">Pitcairn</option>
										  <option value="Poland">Poland</option>
										  <option value="Portugal">Portugal</option>
										  <option value="Puerto Rico">Puerto Rico</option>
										  <option value="Qatar">Qatar</option>
										  <option value="Reunion">Reunion</option>
										  <option value="Romania">Romania</option>
										  <option value="Russia">Russian Federation</option>
										  <option value="Rwanda">Rwanda</option>
										  <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
										  <option value="Saint LUCIA">Saint LUCIA</option>
										  <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
										  <option value="Samoa">Samoa</option>
										  <option value="San Marino">San Marino</option>
										  <option value="Sao Tome and Principe">Sao Tome and Principe</option>
										  <option value="Saudi Arabia">Saudi Arabia</option>
										  <option value="Senegal">Senegal</option>
										  <option value="Seychelles">Seychelles</option>
										  <option value="Sierra">Sierra Leone</option>
										  <option value="Singapore">Singapore</option>
										  <option value="Slovakia">Slovakia (Slovak Republic)</option>
										  <option value="Slovenia">Slovenia</option>
										  <option value="Solomon Islands">Solomon Islands</option>
										  <option value="Somalia">Somalia</option>
										  <option value="South Africa">South Africa</option>
										  <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
										  <option value="Span">Spain</option>
										  <option value="SriLanka">Sri Lanka</option>
										  <option value="St. Helena">St. Helena</option>
										  <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
										  <option value="Sudan">Sudan</option>
										  <option value="Suriname">Suriname</option>
										  <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
										  <option value="Swaziland">Swaziland</option>
										  <option value="Sweden">Sweden</option>
										  <option value="Switzerland">Switzerland</option>
										  <option value="Syria">Syrian Arab Republic</option>
										  <option value="Taiwan">Taiwan, Province of China</option>
										  <option value="Tajikistan">Tajikistan</option>
										  <option value="Tanzania">Tanzania, United Republic of</option>
										  <option value="Thailand">Thailand</option>
										  <option value="Togo">Togo</option>
										  <option value="Tokelau">Tokelau</option>
										  <option value="Tonga">Tonga</option>
										  <option value="Trinidad and Tobago">Trinidad and Tobago</option>
										  <option value="Tunisia">Tunisia</option>
										  <option value="Turkey">Turkey</option>
										  <option value="Turkmenistan">Turkmenistan</option>
										  <option value="Turks and Caicos">Turks and Caicos Islands</option>
										  <option value="Tuvalu">Tuvalu</option>
										  <option value="Uganda">Uganda</option>
										  <option value="Ukraine">Ukraine</option>
										  <option value="United Arab Emirates">United Arab Emirates</option>
										  <option value="United Kingdom">United Kingdom</option>
										  <option value="United States">United States</option>
										  <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
										  <option value="Uruguay">Uruguay</option>
										  <option value="Uzbekistan">Uzbekistan</option>
										  <option value="Vanuatu">Vanuatu</option>
										  <option value="Venezuela">Venezuela</option>
										  <option value="Vietnam">Viet Nam</option>
										  <option value="Virgin Islands (British)">Virgin Islands (British)</option>
										  <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
										  <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
										  <option value="Western Sahara">Western Sahara</option>
										  <option value="Yemen">Yemen</option>
										  <option value="Yugoslavia">Yugoslavia</option>
										  <option value="Zambia">Zambia</option>
										  <option value="Zimbabwe">Zimbabwe</option>
									</select>
									@if ($errors->has('country'))
									<span class="help-block">
									  <strong>{{ $errors->first('country') }}</strong>
									</span>
									@endif
                                    <div class="clearfix"></div>
                                </div>

                                <div class="req_call_wrp col-md-12 col-sm-12">
                                    <input value="Sign up" type="submit">
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                        </div>
						<div class="frm_rel_txt">
                            <h6>Already have an account? <a id="signin-linked" href="javascript:;">Sign in now</a></h6>
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
		<script type="text/javascript">
			jQuery(document).ready(function () {
				jQuery("#btnSignin").click(function(e) {
					e.preventDefault();
					jQuery(this).css('opacity',0.3);
					token = jQuery('input[name="_token"]').val();
					jQuery.ajax({
						type: "POST",
						url: jQuery("#hdajaxurl").val(),
						data: {username: jQuery("#username").val(), password: jQuery("#password").val(), '_token': '{!! csrf_token() !!}'},
						success: function(data) {
							jQuery("#btnSignin").css('opacity',1);
							if(data == 1) {
								msg = "Login successful";
								jQuery("#frmSignin").submit();
							} else {
								msg = "Incorrect Username or Password";
								jQuery("#errSignin").html(msg);
							}
						},
						error: function (jxhr, exception) {
							jQuery("#btnSignin").css('opacity',1);
						}
					});
				});
				
				jQuery("#signup-linked").click(function(){
					jQuery("#signin").modal('hide');
					jQuery("#signup").modal('show');
				});
				
				jQuery("#signin-linked").click(function(){
					jQuery("#signin").modal('show');
					jQuery("#signup").modal('hide');
				});
			});	
		</script>
		@if($errors->any())
			<script type="text/javascript">
			jQuery(document).ready(function () {
				jQuery("#signup").modal('show');
			});
			</script>
		@endif
    </body>
</html>
