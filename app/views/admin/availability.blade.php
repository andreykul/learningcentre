@extends("layout")
@section("content")
    <div class="col-md-4">
    	<fieldset>
    		<legend>Availabiltiy Settings</legend>
			@if (Session::get('success'))
				<div class="row">
					<div class="alert alert-info text-center">
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
			

				{{ HTML::script('js/availability-settings.js') }}

				<br>

				{{ Form::submit("Save Changes", array("class"=>"btn btn-primary"))}}
			{{ Form::close() }}
    	</fieldset>
    </div>
    <div class="col md-8">
    	<fieldset>
    		<legend>Teaching Assistants Availability</legend>
    		<div>
    			{{ Form::open(["url" => "admin/availability/download", "role" => "form"]) }}
					{{ Form::label("day","Select:") }}
					{{ Form::select("day", 
							array(
								"Monday" =>"Monday",
								"Tuesday" => "Tuesday",
								"Wednesday" => "Wednesday",
								"Thursday" => "Thursday",
								"Friday" => "Friday"
							),
							null,
							array("data-width" => "auto")
						)
					}}
					{{ Form::submit("Download", array("class" => "btn btn-primary")) }}
    			{{ Form::close() }}
    		</div>
    		<table class="table table-striped">
    			<thead>
    				<tr>
    					<th class="text-center">Name</th>
    					<th class="text-center">Last Updated</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach ($tas as $ta)
    					<tr>
    						<td class="text-center">{{ $ta->name }}</td>
		    				<td class="text-center">
		    				@if ($ta->availability_updated_at)
		    					{{ date("F dS, Y",strtotime($ta->availability_updated_at)) }}
		    				@else
		    					-
		    				@endif
		    				</td>
		    			</tr>
		    		@endforeach
    			</tbody>
    		</table>
    	</fieldset>
    </div>
@stop