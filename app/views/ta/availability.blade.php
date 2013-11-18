@extends("layout")
@section("content")
    <div class="col-md-12">
        <fieldset>
        	<legend class="row">Availability Table</legend>

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
	        	<table class="table table-striped table-bordered table-condensed">
		        	<thead>
		        		<tr>
		        			<th class="col-md-2">Time</th>
		        			@foreach ($days as $day)
								<th>{{ $day }}</th>
		        			@endforeach
		        		</tr>
		        	</thead>
		        	<tbody id="selectable">
						@for ($i = $time['start']; $i < $time['end']; $i+=50)
							<tr>
								<td>
									{{ intval($i/100) }}:{{ str_pad($i%100/100*60, 2, "0", STR_PAD_LEFT) }}
									 - 
									{{ intval(($i+50)/100) }}:{{ str_pad(($i+50)%100/100*60, 2, "0", STR_PAD_LEFT) }}
								</td>

			        			@foreach ($days as $day)
									<td
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
        </fieldset>
        
        {{ HTML::script('js/ta-availability.js') }}
    </div>
@stop