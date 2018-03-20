@extends('admin.layouts.master')

@section('content')
<div class="row">
		<div class="col-md-12">
			<h2>Block IO Settings</h2>
			<hr/>
		</div>
</div>

	<div class="row">
		<div class="col-md-12">
			<div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-settings font-blue-sharp"></i>
                                        <span class="caption-subject font-blue-sharp bold uppercase">Block  IO Settings</span>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <form role="form" method="POST" action="{{url('admin/gsettings/blockio')}}/{{$gsettings->id}}" enctype="multipart/form-data">
                                    	{{ csrf_field() }}
										{{method_field('put')}}
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label>BlockIO BitCoin API Key</label>
                                                <input type="text" id="block_btc_api_key" name="block_btc_api_key" class="form-control input-lg" value="{{$gsettings->block_btc_api_key}}">
                                            </div>
                                            <div class="form-group">
                                                <label>BlockIO Secret Pin</label>
                                                <input type="text" id="block_secret_pin" name="block_secret_pin" class="form-control input-lg" value="{{$gsettings->block_secret_pin}}">
                                            </div>
											<div class="form-group">
                                                <label>Admin BitCoin Address</label>
                                                <input type="text" id="block_secret_pin" name="block_admin_rcvg_address" class="form-control input-lg" value="{{$gsettings->block_admin_rcvg_address}}">
                                            </div>
											<div class="form-group">
                                                <label>Convertion Charge</label>
                                                <input type="text" id="convertion_charge" name="convertion_charge" class="form-control input-lg" value="{{$gsettings->convertion_charge}}">
                                            </div>											
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn green btn-lg">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
		</div>
	</div>
	
	@endsection