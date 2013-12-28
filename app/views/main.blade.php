@extends("layout")
@section("content")
    <div class="col-md-12">
        <fieldset>
        	<legend class="row">Schedule</legend>
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
		        	<tbody>
						@for ($i = $time['start']; $i < $time['end']; $i+=50)
							<tr>
								<td class="col-md-2 text-center">
									{{ str_pad(intval($i/100), 2, "0", STR_PAD_LEFT) }}:{{ str_pad($i%100/100*60, 2, "0", STR_PAD_LEFT) }}
									 - 
									{{ str_pad(intval(($i+50)/100), 2, "0", STR_PAD_LEFT) }}:{{ str_pad(($i+50)%100/100*60, 2, "0", STR_PAD_LEFT) }}
								</td>

			        			@foreach ($days as $day)
			        				
									<td id="{{ $day }}-{{ str_pad($i, 4, '0', STR_PAD_LEFT) }}"
										class="text-center">
										@if (isset($assigned[$day][$i]))
											{{ link_to('ta/public/profile?ta='.$assigned[$day][$i][0], $assigned[$day][$i][0]) }}
				        					@for ($j=1; $j < count($assigned[$day][$i]); $j++)
												{{ '&amp '.link_to('ta/public/profile?ta='.$assigned[$day][$i][$j], $assigned[$day][$i][$j]) }}
											@endfor
			        					@endif
									</td>
								@endforeach

							</tr>	
			        	@endfor
		        	</tbody>
		        </table>
	        </div>
		</fieldset>
    </div>
@stop