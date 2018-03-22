<div id="sidebar" class="sidebar">
      <!-- begin sidebar scrollbar -->
      <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
          <li class="nav-profile">
            <div class="image">
                @if($avatar == null)
                  <a href="javascript:;"><img src="{{ asset('assets/images/avatar/avatar.png') }}" alt="" /></a>
                @else
                 <a href="javascript:;"><img src="{{ asset('assets/images/avatar') }}/{{Auth::id()}}.png" alt="" /></a>
                @endif
             
            </div>
            <div class="info">
              {{Auth::user()->firstname}}
              {{Auth::user()->lastname}}
              <small>{{Auth::user()->username}}</small>
            </div>
          </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
          <li {{{ (Request::is('home') ? 'class=active' : '') }}}><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
          
          <li class="has-sub {{{ ((Request::is('home/bitlog') || Request::is('home/bitlogrcvd'))? 'active' : '') }}}">
            <a href="javascript:;">
                <b class="caret pull-right"></b>
                <i class="fa fa-th"></i>
                <span>Transactions</span>
            </a>
            <ul class="sub-menu">
			  <!--
              <li>
                <a href="{{route('coinlog')}}"><img src="{{ asset('assets/images/logo/icon.png') }}"  style="width:15%; filter:invert(1) opacity(1);"> {{$gset->curCode}}</a>
              </li>
			  -->
              <li {{{ (Request::is('home/bitlog') ? 'class=active' : '') }}}><a href="{{route('bitlog')}}">
                    <img src="{{ asset('assets/images/coin/btc.png') }}"  style="width:15%; filter:invert(1) opacity(1);"> Sent</a>
              </li> 
			  <li {{{ (Request::is('home/bitlogrcvd') ? 'class=active' : '') }}}><a href="{{route('bitlogrcvd')}}">
                    <img src="{{ asset('assets/images/coin/btc.png') }}"  style="width:15%; filter:invert(1) opacity(1);"> Received</a>
              </li> 
            </ul>
          </li>

			<!--
             <li><a href="{{route('deposit')}}"><i class="fa fa-credit-card" aria-hidden="true"></i> <span>Buy {{$gset->curCode}}</span></a></li>
              <li><a href="{{route('sell.coin')}}"><i class="fa fa-money" aria-hidden="true"></i> <span>Sell {{$gset->curCode}}</span></a></li>
			
            <li><a href="{{route('convert')}}""><i class="fa fa-arrows" aria-hidden="true"></i> <span>Convert</span></a></li>
			-->
            <li>
            <li {{{ (Request::is('user/profile') ? 'class=active' : '') }}}><a href="{{route('user.profile')}}"><i class="fa fa-user" aria-hidden="true"></i> <span>Profile</span></a></li>
            <li {{{ (Request::is('change/password') ? 'class=active' : '') }}}>
                <a href="{{route('changepass')}}"><i class="fa fa-lock" aria-hidden="true"></i> <span>Password</span></a>
            </li>
			<!--
            <li ><a href="{{route('go2fa')}}"><i class="fa fa-shield" aria-hidden="true"></i> <span>Security</span></a></li>
        
            @if(Auth::user()->docv != '1')
            <li ><a href="{{route('document')}}"><i class="fa fa-file-text" aria-hidden="true"></i> <span>Verify Document</span></a></li>
            @endif

			-->
            <li>
              <a href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i>
              <span>SIGN OUT</span>
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
          </li>
                 
              <!-- begin sidebar minify button -->
          <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
              <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
      </div>
      <!-- end sidebar scrollbar -->
    </div>
    <div class="sidebar-bg"></div>
    <!-- end #sidebar -->