@extends("layout")
@section("content")
    <div class="col-md-12">
        <fieldset>
        	<legend class="text-center">Availability Entry</legend>
			@if ($locked)
				<div>
					<div class="alert alert-danger">
						Availability Changes have been Disabled!
					</div>
				</div>
			@else
				@if (Session::get('success'))
					<div>
						<div class="alert alert-success text-center">
							{{ Session::get('success') }}
						</div>
					</div>
				@endif
				<div>
					<p>Please select availability:</p>
				</div>

				<div>
					<div class="col-md-4">
						<button id="unavailable" class="availability btn btn-block btn-lg btn-default" value="" >
							<span class="glyphicon glyphicon-remove-sign"></span> Unavailable
						</button>
					</div>
					<div class="col-md-4">
						<button id="available" class="availability btn btn-block btn-lg btn-warning" value="warning">
							<span class="glyphicon glyphicon-ok-sign"></span> Available
						</button>
					</div>
					<div class="col-md-4">
						<button id="prefered" class="availability btn btn-block btn-lg btn-success" value="success">
							<span class="glyphicon glyphicon-plus-sign"></span> Prefered
						</button>
					</div>
				</div>

				<br>

				<div>
					Apply availability to schedule:
				</div>
			@endif
			<br>

			<div>
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
										class="selectable
										@if ( isset($week[$day][$i]) )
											@if ($week[$day][$i])
												success
											@else
												warning
											@endif
										@endif
										"
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

					<div class="col-md-4 col-md-offset-4">
						<button type="submit" class='btn btn-primary btn-lg btn-block'>
							<span class="glyphicon glyphicon-floppy-disk"></span> Save Changes
						</button>
					</div>
		        {{ Form::close() }}
	        @endif
        </fieldset>
        
        @if (! $locked)
        	{{ HTML::script('js/ta-availability.js') }}
        @endif
    </div>
@stop