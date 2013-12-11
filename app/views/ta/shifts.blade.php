@extends("layout")
@section("content")
    <div class="col-md-12">
		<div class="modal fade" aria-hidden="true">
			{{ Form::open(array('url'=>'ta/shifts/', 'role'=>"form", 'method'=>'put','id'=>'shift-bid-form')) }}
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Shift Bid</h4>
					</div>
					<div class="modal-body">
						<div class="my-bid">
							<fieldset>
								<legend>Add Bid</legend>
								{{ Form::hidden('shift_id') }}
								{{ Form::hidden('ta_id', Auth::user()->TA()->id ) }}
								<div>
									<label>Full Shift Time: </label>
									<span id="full-shift"></span>
									<button type="button" id="take-shift" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-sm glyphicon-plus"></span> Take</button>	
								</div>
								{{ Form::label('time', 'Time Bid:') }}
								<span id="times"></span>
								{{ Form::hidden('start', null, array("class" => "form-control")) }}
								{{ Form::hidden('end', null, array("class" => "form-control")) }}

								<div id="slider-range"></div>
							</fieldset>
						</div>
						<br>
						<div class="other-bids">
							<fieldset>
								<legend>Other Bids</legend>
								<table class="table table-striped table-condensed">
								<thead>
									<tr>
										<th class='text-center'>Start</th>
										<th class='text-center'>End</th>
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
			{{ Form::close() }}
		</div><!-- /.modal -->
        <fieldset>
        	<legend class="row">Shifts ({{ date("M jS, Y",strtotime($week_start)) }}
        		 - 
        		 {{ date("M jS, Y",strtotime($week_start)+ 6 * 24 * 60 * 60) }})</legend>

			<div class="row">
				<a 	href="?week_start={{ date('Y-m-d',strtotime($week_start) - 7 * 24 * 60 * 60) }}" 
					class="pull-left btn btn-lg">
						<span class="glyphicon glyphicon-circle-arrow-left"></span> Previous Week
				</a>
				<a 	href="?week_start={{ date('Y-m-d',strtotime($week_start) + 7 * 24 * 60 * 60) }}" 
					class="pull-right btn btn-lg">
					Next Week <span class="glyphicon glyphicon-circle-arrow-right"></span>
				</a>
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
			        				@if ( ! isset($week[$day][$i]['skip']) )
										<td id="{{ $day }}-{{ str_pad($i, 4, '0', STR_PAD_LEFT) }}"
											@if ( isset($week[$day][$i]) )
												@if ($week[$day][$i]['mine'] && $week[$day][$i]['old'] )
													class="text-center success"
												@elseif ( $week[$day][$i]['mine'] )
													class="text-center success shift-own"
												@elseif ( $week[$day][$i]['bid'] )
													class="text-center info shift-bid"
												@else
													class="text-center warning shift-free"
												@endif
												rowspan="{{ $week[$day][$i]['length'] }}"
											@endif>
											@if ( isset($week[$day][$i]['mine']) )
												@if ($week[$day][$i]['mine'])
													<span hidden=hidden>Drop</span>
													{{ Form::open(array('url'=>'ta/shifts', 'role'=>"form", 'method'=>'delete')) }}
														{{ Form::hidden('shift_id',$week[$day][$i]['id']) }}
													{{ Form::close() }}
												@else
													<span hidden=hidden>Bid</span>
													{{ Form::hidden('shift_id',$week[$day][$i]['id']) }}
												@endif
											@endif
										</td>
									@endif
								@endforeach

							</tr>	
			        	@endfor
		        		
		        	</tbody>
		        </table>
	        </div>
        </fieldset>

		{{ HTML::script('js/time-conversion.js') }}
        {{ HTML::script('js/ta-shifts.js') }}
    </div>
@stop