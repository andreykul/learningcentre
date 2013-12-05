@extends("layout")
@section("content")
    <div class="col-md-12">
        <fieldset>
        	<legend class="row">Shifts ({{ date("M jS, Y",strtotime($week_start)) }} - {{ date("M jS, Y",strtotime($week_start)+ 6 * 24 * 60 * 60) }})</legend>

			<div class="row">
				<a href="?week_start={{ date('Y-m-d',strtotime($week_start) - 7 * 24 * 60 * 60) }}" class="pull-left btn"><span class="glyphicon glyphicon-circle-arrow-left"></span> Previous Week</a>
				<a href="?week_start={{ date('Y-m-d',strtotime($week_start) + 7 * 24 * 60 * 60) }}" class="pull-right btn">Next Week <span class="glyphicon glyphicon-circle-arrow-right"></span></a>
			</div>

			<div class="row">
	        	<table class="table table-striped table-bordered table-condensed">
		        	<thead>
		        		<tr>
		        			<th class="text-center">Time</th>
								<th class="text-center">Sunday</th>
								<th class="text-center">Monday</th>
								<th class="text-center">Tuesday</th>
								<th class="text-center">Wednesday</th>
								<th class="text-center">Thursday</th>
								<th class="text-center">Friday</th>
								<th class="text-center">Saturday</th>
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
										@if ( isset($week[$day][$i]) )
											@if ($week[$day][$i])
												class="success"
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
    </div>
@stop