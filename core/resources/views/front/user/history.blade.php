@extends('front.layouts.admaster')
@section('pageTitle', 'Browser Sessions')
@section('content')

        <div class="row">
          <div class="panel panel-inverse">
            <div class="panel-heading">
              <h4 class="panel-title">Browser Sessions</h4>
            </div>
            <div class="panel-body">
     <div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-body">
				<table class="table table-responsive table-striped">
					<thead>
						<tr>
						  <th>
							Date
						  </th>
						  <th>
							Platform
						  </th>
						  <th>
							IP Address
						  </th>
						  <th>
							Browser
						  </th>
						</tr>
				  </thead>
				  <tbody>
					@foreach($sess_recs as $sess)
					<tr>
						<td>{{convert_to_timezone( $sess->created_at, "Asia/Kolkata" )}}</td>
						<td>{{$sess->platform}}</td>
						<td>{{$sess->ip_address}}</td>
						<td>{{$sess->browser}}</td>
					</tr>
					@endforeach    
				  </tbody>
				</table>
            </div>
          </div>
        </div>

      </div>

</div>

</div>

@endsection

