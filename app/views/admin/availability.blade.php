@extends("layout")
@section("content")
    <div class="col-md-4">
    	<fieldset>
    		<legend>Availabiltiy Settings</legend>
    		{{ Form::open(["url" => "admin/availability", "role" => "form"]) }}

				{{ Form::label("availability_locked","Availability Changes Locked:") }}
				{{ Form::select("availability_locked", array(false =>"Off",true =>"On"), $availability['locked']) }}

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
    	</fieldset>
    </div>
@stop