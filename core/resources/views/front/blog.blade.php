@extends('front.layouts.master')
@section('content')

<div class="about_banner blog_banner">
    <div class="container">
        <h1>Our latest blog</h1>
        <div class="col-md-7 m_auto">
            <p>We pride ourselves on our excellent customer service. This includes access to a personal account manager, either over the phone, via email or in person.</p>
        </div>
    </div>
</div>

<div class="blg_cat_sidbar_area">
    <div class="container">
        <div class="col-md-10 col-sm-10">
            <h1>Blog Category</h1>

            <div class="blog_cat_area">
                <div class="blog_cat_all_btn">
                    <div class="blog_cat_btn"><h6>Case Studies</h6></div>
                    <div class="blog_cat_btn"><h6>News</h6></div>
                    <div class="blog_cat_btn"><h6>Press</h6></div>                            
                    <div class="blog_cat_btn"><h6>Product Features</h6></div>
                    <div class="blog_cat_btn"><h6>Uncategorized</h6></div>
                    <div class="clearfix"></div>
                </div>

                <div class="blog_cat_pic">
                    <div class="col-md-8 col-sm-8 pdng_lft mob_pad">
                        <div class="blog_cat_post">
                            <img src="{{ asset('assets/coinsworld/images/blog_cat_1.jpg') }}"/>
                            <div class="blog_cat_post_cap">
                                <div class="date"><h6>25-26 Jan</h6></div>
                                <h3>Contrary to popular belief, Lorem Ipsum is not </h3>
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 pdng_lft mob_pad">
                        <div class="blog_cat_post">
                            <img src="{{ asset('assets/coinsworld/images/blog_cat_3.jpg') }}"/>
                            <div class="blog_cat_post_cap">
                                <div class="date"><h6>28 Jan</h6></div>
                                <h3>Etiam eget velit non est facilisis efficitur...</h3>
                            </div>
                        </div>
                        <div class="blog_cat_post">
                            <img src="{{ asset('assets/coinsworld/images/blog_cat_2.jpg') }}"/>
                            <div class="blog_cat_post_cap">
                                <div class="date"><h6>28 Jan</h6></div>
                                <h3>Etiam eget velit non est facilisis efficitur...</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2 col-sm-2 sidebar">
            <div class="ad_sec"><p>Space for ad</p><div class="clearfix"></div></div>
        </div>
    </div>
</div>

<div class="post_area">
    <div class="container">
        <div class="col-md-8 col-sm-8">
            <div class="feature_post">
                <h1>Featured Posts</h1>
                <div class="feature_post_wrp">

                    <div class="col-md-6 col-sm-6 pdng_lft">
                        <a href="#" data-toggle="modal" data-target="#comment_pop">
                            <div class="feature_post_box">
                                <div class="top_sec">
                                    <img src="{{ asset('assets/coinsworld/images/blue_print_logo.png') }}"/>
                                    <div class="date"><h6>25-26 Jan</h6></div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="feature_post_pic">
                                    <img src="{{ asset('assets/coinsworld/images/post1.jpg') }}"/>
                                </div>

                                <div class="feature_post_cntnt">
                                    <h3>There are many variations of passages of Lorem Ipsum</h3>
                                    <p>I imperdiet ligula faucibus eu. Quisque in eleifend tellus. Nam placerat rhoncus tincidunt. Morbi sit amet eleifend libero.</p>

                                    <ul>
                                        <li class="chat_ico">20</li>
                                        <li class="love_ico">15</li>
                                    </ul>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-sm-6 pdng_lft">
                        <div class="feature_post_box">
                            <div class="top_sec">
                                <img src="{{ asset('assets/coinsworld/images/blue_print_logo.png') }}"/>
                                <div class="date"><h6>26 Jan</h6></div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="feature_post_pic">
                                <img src="{{ asset('assets/coinsworld/images/post2.jpg') }}"/>
                            </div>

                            <div class="feature_post_cntnt">
                                <h3>There are many variations of passages of Lorem Ipsum</h3>
                                <p>I imperdiet ligula faucibus eu. Quisque in eleifend tellus. Nam placerat rhoncus tincidunt. Morbi sit amet eleifend libero.</p>

                                <ul>
                                    <li class="chat_ico">20</li>
                                    <li class="love_ico">15</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 pdng_lft">
                        <div class="feature_post_box">
                            <div class="top_sec">
                                <img src="{{ asset('assets/coinsworld/images/blue_print_logo.png') }}"/>
                                <div class="date"><h6>26 Jan</h6></div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="feature_post_pic">
                                <img src="{{ asset('assets/coinsworld/images/post3.jpg') }}"/>
                            </div>

                            <div class="feature_post_cntnt">
                                <h3>There are many variations of passages of Lorem Ipsum</h3>
                                <p>I imperdiet ligula faucibus eu. Quisque in eleifend tellus. Nam placerat rhoncus tincidunt. Morbi sit amet eleifend libero.</p>

                                <ul>
                                    <li class="chat_ico">20</li>
                                    <li class="love_ico">15</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 pdng_lft">
                        <div class="feature_post_box">
                            <div class="top_sec">
                                <img src="{{ asset('assets/coinsworld/images/blue_print_logo.png') }}"/>
                                <div class="date"><h6>25-26 Jan</h6></div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="feature_post_pic">
                                <img src="{{ asset('assets/coinsworld/images/post4.jpg') }}"/>
                            </div>

                            <div class="feature_post_cntnt">
                                <h3>There are many variations of passages of Lorem Ipsum</h3>
                                <p>I imperdiet ligula faucibus eu. Quisque in eleifend tellus. Nam placerat rhoncus tincidunt. Morbi sit amet eleifend libero.</p>

                                <ul>
                                    <li class="chat_ico">20</li>
                                    <li class="love_ico">15</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 pdng_lft">
                        <div class="feature_post_box">
                            <div class="top_sec">
                                <img src="{{ asset('assets/coinsworld/images/blue_print_logo.png') }}"/>
                                <div class="date"><h6>26 Jan</h6></div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="feature_post_pic">
                                <img src="{{ asset('assets/coinsworld/images/post5.jpg') }}"/>
                            </div>

                            <div class="feature_post_cntnt">
                                <h3>There are many variations of passages of Lorem Ipsum</h3>
                                <p>I imperdiet ligula faucibus eu. Quisque in eleifend tellus. Nam placerat rhoncus tincidunt. Morbi sit amet eleifend libero.</p>

                                <ul>
                                    <li class="chat_ico">20</li>
                                    <li class="love_ico">15</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 pdng_lft">
                        <div class="feature_post_box">
                            <div class="top_sec">
                                <img src="{{ asset('assets/coinsworld/images/blue_print_logo.png') }}"/>
                                <div class="date"><h6>25-26 Jan</h6></div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="feature_post_pic">
                                <img src="{{ asset('assets/coinsworld/images/post6.jpg') }}"/>
                            </div>

                            <div class="feature_post_cntnt">
                                <h3>There are many variations of passages of Lorem Ipsum</h3>
                                <p>I imperdiet ligula faucibus eu. Quisque in eleifend tellus. Nam placerat rhoncus tincidunt. Morbi sit amet eleifend libero.</p>

                                <ul>
                                    <li class="chat_ico">20</li>
                                    <li class="love_ico">15</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>


        <!-- Sign Up Modal -->
        <div id="comment_pop" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">

                <!-- Modal content-->
                <div class="modal-content signin_pop comment_pop">
                    <div class="modal-body">
                        <div class="feature_post_box">
                            <div class="feature_post_pic">
                                <img src="{{ asset('assets/coinsworld/images/post1.jpg') }}">
                            </div>

                            <div class="feature_post_cntnt">
                                <h3>There are many variations of passages of Lorem Ipsum</h3>
                                <p>I imperdiet ligula faucibus eu. Quisque in eleifend tellus. Nam placerat rhoncus tincidunt. Morbi sit amet eleifend libero.</p>
                            </div>

                            <div class="col-xs-11 m_auto">
                                <form class="req_call_frm" method="post">
                                    <div class="req_call_wrp">
                                        <textarea class="col-xs-12" placeholder="Comment" cols="5"></textarea>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="req_call_wrp">
                                        <input value="Post Comment" type="submit">
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                                <div class="clearfix"></div>
                            </div>

                            <div class="rep_comnt">
                                <h6>I imperdiet ligula faucibus eu. Quisque in eleifend tellus. Nam placerat rhoncus tincidunt. Morbi sit amet eleifend libero.</h6>
                            </div>

                            <div class="rep_comnt">
                                <h6>I imperdiet ligula faucibus eu. Quisque in eleifend tellus. Nam placerat rhoncus tincidunt. Morbi sit amet eleifend libero.</h6>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-4 col-sm-4">
            <div class="recent_pst_box feature_post_box">
                <h1>Recent Posts</h1>

                <div class="recent_pst_wrp">
                    <img src="{{ asset('assets/coinsworld/images/r_post1.jpg') }}"/>
                    <p>Gaming App Customer Support Survey: Companies using chat are 4X more likely to respond to the customert.</p>
                    <div class="clearfix"></div>
                </div>

                <div class="recent_pst_wrp">
                    <img src="{{ asset('assets/coinsworld/images/r_post2.jpg') }}"/>
                    <p>Entrepreneur – Research Finds the IRS Gives Better Customer Service Than Most Apps.</p>
                    <div class="clearfix"></div>
                </div>

                <div class="recent_pst_wrp">
                    <img src="{{ asset('assets/coinsworld/images/r_post3.jpg') }}"/>
                    <p>What types of customer questions can AI really answer?</p>
                    <div class="clearfix"></div>
                </div>

                <div class="recent_pst_wrp">
                    <img src="{{ asset('assets/coinsworld/images/r_post4.jpg') }}"/>
                    <p>These 5 Experts Share Their Predictions For Chatbots In 2018</p>
                    <div class="clearfix"></div>
                </div>

                <div class="recent_pst_wrp">
                    <img src="{{ asset('assets/coinsworld/images/r_post5.jpg') }}"/>
                    <p>Innogy New Ventures invests in Agent.ai</p>
                    <div class="clearfix"></div>
                </div>

            </div>

            <div class="recent_pst_box feature_post_box">
                <h1>Popular Posts</h1>

                <div class="recent_pst_wrp">
                    <img src="{{ asset('assets/coinsworld/images/p_post1.jpg') }}"/>
                    <p>Gaming App Customer Support Survey: Companies using chat are 4X more likely to respond to the customert.</p>
                    <div class="clearfix"></div>
                </div>

                <div class="recent_pst_wrp">
                    <img src="{{ asset('assets/coinsworld/images/p_post2.jpg') }}"/>
                    <p>Entrepreneur – Research Finds the IRS Gives Better Customer Service Than Most Apps.</p>
                    <div class="clearfix"></div>
                </div>

                <div class="recent_pst_wrp">
                    <img src="{{ asset('assets/coinsworld/images/p_post3.jpg') }}"/>
                    <p>What types of customer questions can AI really answer?</p>
                    <div class="clearfix"></div>
                </div>

                <div class="recent_pst_wrp">
                    <img src="{{ asset('assets/coinsworld/images/r_post4.jpg') }}"/>
                    <p>These 5 Experts Share Their Predictions For Chatbots In 2018</p>
                    <div class="clearfix"></div>
                </div>

                <div class="recent_pst_wrp">
                    <img src="{{ asset('assets/coinsworld/images/r_post5.jpg') }}"/>
                    <p>Innogy New Ventures invests in Agent.ai</p>
                    <div class="clearfix"></div>
                </div>

            </div>

            <div class="ad_sec"><p>Space for ad</p><div class="clearfix"></div></div>
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