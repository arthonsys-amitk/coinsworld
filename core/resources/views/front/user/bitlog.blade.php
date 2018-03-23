@extends('front.layouts.admaster')
@section('pageTitle', 'BitCoin Transactions - Sent')
@section('content')

        <div class="row">
          <div class="panel panel-inverse">
            <div class="panel-heading">
              <h4 class="panel-title">BitCoin Transaction Log - Sent</h4>
            </div>
            <div class="panel-body">
     <div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-body">
              <table class="table table-responsive table-striped">
              <thead>
              <tr>
              <th>
                Operation
              </th>
              <th>
                From / To
              </th>
              <th>
                Processed at 
              </th>
              <th>
                BTC Amount
              </th>
       </tr>
              </thead>
              <tbody>
   @foreach($trans as $tran)
<tr>
<td>
{{ $tran->status == "1" ? 'Received' : 'Sent' }}
</td>
<td>
{{$tran->toacc }}
</td>
<td>
<?php 
	$oldtmz = date_default_timezone_get();
	$date = new DateTime($tran->created_at, new DateTimeZone($oldtmz));
	$date->setTimezone(new DateTimeZone('Asia/Calcutta'));
	$local_time= $date->format('Y-m-d H:i:s');
?>
{{$local_time}}
</td>
<td>
  <b class="btn {{ $tran->status == "1" ? 'btn-success' : 'btn-danger' }}  btn-md">{{number_format(floatval($tran->amount), 8, '.', '')}}</b> 
</td>
</tr>
@endforeach    
              </tbody>
          </table>
          <?php echo $trans->render(); ?>
             
            </div>
          </div>
        </div>

      </div>

</div>

</div>

@endsection


      