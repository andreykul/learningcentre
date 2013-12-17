@extends("layout")
@section("content")
    <div class="col-md-12">
    	{{ Form::hidden('schedule-start', $time['start']) }}
    	{{ Form::hidden('schedule-end', $time['end']) }}
		<div class="modal fade" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Schedule TA</h4>
					</div>
					<div class="modal-body">
						<div class="shift-info">
							<fieldset>
								<legend>Shift Information</legend>
								{{ Form::label('time', 'Shift Time:') }}
								<span id="times"></span>
								{{ Form::hidden('start') }}
								{{ Form::hidden('end') }}
								<div id="slider-range"></div>
							</fieldset>
						</div>
						<br>
						<div class="available-tas">
							<fieldset>
								<legend>Available TAs</legend>
								<table class="table table-striped table-condensed">
									<thead>
										<tr>
											<th class='text-center'>Name</th>
											<th class='text-center'>Prefered</th>
											<th class='text-center'>Hours</th>
										</tr>
									</thead>
								<tbody>
								</tbody>
							</table>
							</fieldset>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

        <fieldset id="schedule">
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
		{{ HTML::script('js/time-conversion.js') }}
		{{ HTML::script('js/admin-schedule.js') }}
    </div>
@stop