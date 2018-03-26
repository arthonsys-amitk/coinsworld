@extends('admin.layouts.admin')
@section('content')
            <!-- BEGIN LOGIN FORM -->
                <form class="login-form" role="form" method="POST" action="{{ url('/admin/login') }}">
                        {{ csrf_field() }}
                <h3 class="form-title font-green">Admin Sign In</h3>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <input id="username" type="text" class="form-control form-control-solid placeholder-no-fix" placeholder="Username" name="username" value="{{ old('username') }}" autofocus>
                </div>
                 
        <div class="form-group" >
            <label class="control-label visible-ie8 visible-ie9">Password</label>
           <input id="password" type="password" class="form-control form-control-solid placeholder-no-fix" name="password" placeholder="Password">
         </div>
		
        <div class="form-actions">
            <button type="submit" class="btn green uppercase btn-block">Login</button>
        </div>
		@if($errors->has('username'))
            <span class="help-block" style="color: #ff0000; margin: 0px;">
              {{ $errors->first('username') }}
            </span>
        @endif
		@if ($errors->has('password'))
			<span class="help-block" style="color: #ff0000; margin: 0px;">
				{{ $errors->first('password') }}
			</span>
        @endif

    </form>
            <!-- END LOGIN FORM -->
@endsection
