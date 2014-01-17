@extends("layout")
@section("content")
    <div class="col-md-4">
    	<fieldset>
    		<legend>Availabiltiy Settings</legend>
			@if (Session::get('success'))
				<div class="row">
					<div class="alert alert-success text-center">
						Changes have been saved!
					</div>
				</div>
			@endif

    		{{ Form::open(["url" => "admin/availability", "role" => "form"]) }}

				{{ Form::label("availability_locked","Availability Changes Locked:") }}
				{{ Form::select("availability_locked", 
						array(
							false =>"Off",
							true =>"On"
						),
						$availability['locked'],
						array("data-width" => "auto")
					) 
				}}

				<div>
					<label for="hours">Hours range:</label>
					<span id="hours">
						{{ $availability['start_time'] }} - {{ $availability['end_time'] }}
					</span>
					{{ Form::hidden("availability_start_hour", $availability['start_time']) }}
					{{ Form::hidden("availability_end_hour", $availability['end_time']) }}
				</div>

				<div id="slider-range"></div>	
			
				{{ HTML::script('js/time-conversion.js') }}
				{{ HTML::script('js/availability-settings.js') }}

				<br>

				{{ Form::submit("Save Changes", array("class"=>"btn btn-primary btn-block"))}}
			{{ Form::close() }}
    	</fieldset>
    	<br><br>
		<fieldset>
			<legend>Export Availability</legend>
			<div>
    			{{ Form::open(["url" => "admin/availability/download", "role" => "form"]) }}
					<div>
						{{ Form::label("day","Select:") }}
						{{ Form::select("day", 
								array(
									"All" => "All",
									"Monday" => "Monday",
									"Tuesday" => "Tuesday",
									"Wednesday" => "Wednesday",
									"Thursday" => "Thursday",
									"Friday" => "Friday",
									"Saturday" => "Saturday",
									"Sunday" => "Sunday",
								),
								null,
								array("data-width" => "auto")
							)
						}}
					</div>
					<br>
					{{ Form::button("<span class='glyphicon glyphicon-download'></span> Download",
							array("class" => "btn btn-primary btn-block","type" => "submit")
						)
					}}
    			{{ Form::close() }}
    		</div>
		</fieldset>
    	<br><br>
    	<fieldset>
    		<legend>Import Availability</legend>
    		{{ Form::open(['url' => 'admin/availability/import']) }}
	    		<div>
	    			
		    		{{ Form::label("day","Select:") }}
					{{ Form::select("day",
							array(
								"Monday" => "Monday",
								"Tuesday" => "Tuesday",
								"Wednesday" => "Wednesday",
								"Thursday" => "Thursday",
								"Friday" => "Friday",
								"Saturday" => "Saturday",
								"Sunday" => "Sunday",
							),
							null,
							array("data-width" => "auto")
						)
					}}
	    		</div>
	    		<br>
	    		<div class="input-group">
					<span class="input-group-btn">
						<span class="btn btn-success btn-file">
							Browse… <input type="file" id="picture" class="browse-file" accept="image/*" name="picture">
						</span>
					</span>
					<input type="text" class="form-control file-text" readonly="">
				</div>
				<br>
				{{ Form::submit("Import", array("class" => 'btn btn-primary btn-block')) }}	

			{{ Form::close() }}

    	</fieldset>
    </div>
    <div class="col-md-8">
    	<fieldset>
    		<legend>Teaching Assistants Availability</legend>
    		@if (Session::get('remind_success'))
    			<div class="row">
					<div class="alert alert-success text-center">
						{{ Session::get('remind_success') }}
					</div>
				</div>
    		@endif
    		<table class="table table-striped">
    			<thead>
    				<tr>
    					<th class="text-center">Name</th>
    					<th class="text-center">Last Updated</th>
    					<th class="text-center">Action</th>
    				</tr>
    			</thead>
    			<tbody>
    				<tr>
    					<td></td>
    					<td></td>
    					<td>
    						{{ Form::open(["url" => "admin/availability/remind", "role" => "form"]) }}
								{{ Form::button("<span class='glyphicon glyphicon-envelope'></span> Remind All",
									array("class" => "btn btn-info btn-block","type"=>"submit")) 
								}}
							{{ Form::close() }}
    					</td>
    				</tr>
    				@foreach ($tas as $ta)
    					<tr>
    						<td class="text-center">{{ $ta->name }}</td>
		    				<td class="text-center">
		    				@if ($ta->availability_updated_at)
		    					{{ date("F dS, Y",strtotime($ta->availability_updated_at)) }}
		    				@else
		    					<span class='text-danger glyphicon glyphicon-lg glyphicon-minus-sign'></span>
		    				@endif
		    				</td>
		    				<td class="text-center">
		    					{{ Form::open(["url" => "admin/availability/remind", "role" => "form"]) }}
		    						{{ Form::hidden('ta_id',$ta->id) }}
		    						{{ Form::button("<span class='glyphicon glyphicon-envelope'></span> Remind",
		    							array("class" => "btn btn-warning btn-block","type"=>"submit")) 
		    						}}
    							{{ Form::close() }}
		    				</td>
		    			</tr>
		    		@endforeach
    			</tbody>
    		</table>
    	</fieldset>
    </div>
@stop