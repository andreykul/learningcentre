@extends("layout")
@section("content")
    <div class="col-md-12">

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
								<td class="text-center">
									{{ str_pad(intval($i/100), 2, "0", STR_PAD_LEFT) }}:{{ str_pad($i%100/100*60, 2, "0", STR_PAD_LEFT) }}
									 - 
									{{ str_pad(intval(($i+50)/100), 2, "0", STR_PAD_LEFT) }}:{{ str_pad(($i+50)%100/100*60, 2, "0", STR_PAD_LEFT) }}
								</td>

			        			@foreach ($days as $day)
									<td id="{{ $day }}-{{ str_pad($i, 4, '0', STR_PAD_LEFT) }}"
									@if (isset($week[$day][$i]))
										@if (($week[$day][$i] / $max) > (2 / 3))
											class="success"
										@elseif (($week[$day][$i] / $max) > (1 / 3))
											class="warning"
										@else
											class="danger"
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
		<script>
			$('td').click(function(){
				day = $(this).attr('id').split('-')[0];
				window.location.href = 'schedule/day/'+day;
			});
		</script>
    </div>
@stop