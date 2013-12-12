@extends("layout")
@section("content")
    <div class="col-md-12">
        <fieldset>
        	<legend class="row">Availability Entry</legend>
			@if ($locked)
				<div class="row">
					<div class="alert alert-danger">
						Availability Changes have been Disabled!
					</div>
				</div>
			@else
				@if (Session::get('success'))
					<div class="row">
						<div class="alert alert-success text-center">
							Changes have been saved!
						</div>
					</div>
				@endif
				<div class="row">
					<p>Please select availability:</p>
				</div>

				<div class="row">
					<div class="col-md-4">
						<button id="unavailable" class="availability btn btn-block btn-lg btn-default" value="" >Unavailable</button>
					</div>
					<div class="col-md-4">
						<button id="available" class="availability btn btn-block btn-lg btn-warning" value="warning" >Available</button>
					</div>
					<div class="col-md-4">
						<button id="prefered" class="availability btn btn-block btn-lg btn-success" value="success" >Prefered</button>
					</div>
				</div>

				<br>

				<div class="row">
					Apply availability to schedule:
				</div>
			@endif
			<br>

			<div class="row">
	        	<table class="table table-striped table-bordered table-condensed">
		        	<thead>
		        		<tr>
		        			<th class="text-center">Time</th>
		        			@foreach ($days as $day)
								<th class="text-center">{{ $day }}</th>
		        			@endforeach
		        		</tr>
		        	</thead>
		        	<tbody id="selectable">
						@for ($i = $time['start']; $i < $time['end']; $i+=50)
							<tr>
								<td class="text-center">
									{{ str_pad(intval($i/100), 2, "0", STR_PAD_LEFT) }}:{{ str_pad($i%100/100*60, 2, "0", STR_PAD_LEFT) }}
									 - 
									{{ str_pad(intval(($i+50)/100), 2, "0", STR_PAD_LEFT) }}:{{ str_pad(($i+50)%100/100*60, 2, "0", STR_PAD_LEFT) }}
								</td>

			        			@foreach ($days as $day)
									<td id="{{ $day }}-{{ str_pad($i, 4, '0', STR_PAD_LEFT) }}"
										@if ( isset($week[$day][$i]) )
											@if ($week[$day][$i])
												class="success"
											@else
												class="warning"
											@endif
										@endif
									></td>
								@endforeach

							</tr>	
			        	@endfor
		        		
		        	</tbody>
		        </table>
	        </div>	

			@if (! $locked)
		        {{ Form::open(array('url' => 'ta/availability', 'role' =>"form")) }}
		        	@foreach ($days as $day)
						@for ($i = $time['start']; $i < $time['end']; $i+=50)
							@if (isset($week[$day][$i]))
								{{ Form::hidden($day.'['.$i.']', $week[$day][$i]) }}
							@endif
						@endfor
					@endforeach

					{{ Form::submit("Save Changes", array("class"=>"btn btn-primary btn-lg center-block")) }}
		        {{ Form::close() }}
	        @endif
        </fieldset>
        
        @if (! $locked)
        	{{ HTML::script('js/ta-availability.js') }}
        @endif
    </div>
@stop