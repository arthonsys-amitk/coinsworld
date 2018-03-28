@extends('admin.layouts.master')

@section('content')
	<div class="row">
        <div class="col-md-12">
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-dark">
						<i class="icon-list "></i>
						<span class="caption-subject bold uppercase">Slider/Banner List</span>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover order-column">
						<thead>
							<tr>
								<th>Position</th><th>Image</th><th>Banner ID</th><th>Created</th><th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($sliders as $slider)
							<tr class="odd gradeX">
								<td>{{is_null($slider->position)? '': $slider->position}}</td>
								<td><img src="{{ asset('assets/images/slider') }}/{{$slider->image}}" alt="Image" width="100" height="50"/></td>
								<td>{{$slider->id}}</td>
								<td>{{convert_to_timezone($slider->created_at, 'Asia/Kolkata')}}</td>
								<td><a class="btn btn-outline btn-circle green" href="{{ asset('assets/images/slider') }}/{{$slider->image}}" target="_blank" title="Image"><i class="fa fa-check"></i>View</a>
									<a class="btn btn-circle  btn-danger"  href="{{ route('slider.delete', 'id=' . $slider->id)}}" data-toggle="confirmation"  data-title="Are You Sure?" data-content="Delete This Slide?">
                                        <i class="fa fa-trash"></i> Delete
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
            </div>
		</div>
	</div>
    <div class="row">
        <div class="col-md-12">
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-dark">
						<i class="icon-settings "></i>
						<span class="caption-subject bold uppercase">Add Slider/Banner</span>
					</div>
				</div>
				<div class="portlet-body">
					<form role="form" id="frmAddSlide" method="POST" action="{{route('slider.add')}}" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<span class="btn green fileinput-button">										
										<i class="fa fa-plus"></i>
										<span> Upload Image </span>
										<input id="image" type="file" name="image" class="form-control input-lg">
							</span>
							<span class="btn-danger">Standard Image Size: 1920 x 900 px</span>
						</div>
						<div class="form-group">
							<label for="position">Slide Position (e.g. 1)</label>
							<input class="form-control" id="position" name="position" />
						</div>
						<div class="form-group">
							<label for="link">URL</label>
							<input class="form-control" id="link" name="link" />
						</div>
						<div class="form-group">
							<label for="bold">Bold Text</label>
							<textarea class="form-control" id="bold" name="bold"></textarea>
						</div>
						<div class="form-group">
							<label for="small">Small Text</label>
							<textarea class="form-control" id="small" name="small"></textarea>
						</div>
						<div class="form-group">
							<button id="btnAddSlide" type="button" class="btn btn-lg btn-block btn-success" >Add Slide</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!--
	<div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-blue"></i>
                        <span class="caption-subject font-green bold uppercase">Slider/Banner Settings</span>
                    </div>
                </div>
                <div class="portlet-body">
                     <form role="form" method="POST" action="{{route('slider.update')}}" enctype="multipart/form-data">
                             {{ csrf_field() }}
                             <img src="{{ asset('assets/images/slider') }}/{{$slide->image}}" class="img-responsive" width="100%">
                                <div class="form-group">
                                    <span class="btn green fileinput-button">
                                                <i class="fa fa-plus"></i>
                                                <span> Change Background Image </span>
                                                <input type="file" name="image" class="form-control input-lg">
                                            </span>
                                            <span class="btn-danger">Standard Image Size: 1920 x 900 px</span>
                                </div>
                                <div class="form-group">
                                    <label for="bold">Bold Text</label>
                                    <textarea class="form-control" id="bold" name="bold">
                                      {!! $slide->bold !!}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="small">Small Text</label>
                                    <textarea class="form-control" id="small" name="small">
                                      {!! $slide->small !!}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-block btn-success" >Update</button>
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </div>
	-->
<script language="javascript">
	jQuery(document).ready(function(){
		jQuery("#btnAddSlide").click(function(){
			//pos = jQuery("#position").val();
			jQuery("#frmAddSlide").submit();
		});
	});
</script>
	
	
@endsection
