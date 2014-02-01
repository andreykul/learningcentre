@extends("layout")
@section("content")
    <div class="col-md-12">
    	@if (Session::get('success'))
			<div>
				<div class="alert alert-success text-center">
					{{ Session::get('success') }}
				</div>
			</div>
		@endif
    	<div>
    		<h3 class="text-center">
    			<a class="pull-left btn-link" href="{{ url('ta/hours?semester='.$semester['previous'].'&year='.$year['previous']) }}">
        		<span class="glyphicon glyphicon-circle-arrow-left"></span></a>
    			{{ $semester['now'] }} <span id="year">{{ $year['now'] }}</span>
    			@if (isset($semester['next']))
	    			<a class="pull-right btn-link" href="{{ url('ta/hours?semester='.$semester['next'].'&year='.$year['next']) }}">
	        		<span class="glyphicon glyphicon-circle-arrow-right"></span></a>
        		@endif
    		</h3>
    	</div>
    	<div>
    		<div class="col-md-6">
    			<fieldset>
    				<legend class="text-center">Hours Break Down</legend>
    			</fieldset>
    			
    			<div class="accordion">
    				@for ($i = $current_week; $i > 0 ; $i--)
						<h3 class="week">
	    					Week {{ $i }}
	    					 : 
	    					{{ date('M jS',strtotime($week_start) - (($current_week - $i) * 7 * 86400) ) }}
	    					 - 
	    					{{ date('M jS',strtotime($week_end) - (($current_week - $i) * 7 * 86400)) }}
	    					 : 
	    					{{ isset($shifts_per_week[$i]['submitted']) ? $shifts_total[$i] + $shifts_per_week[$i]['additional'] : $shifts_total[$i] }} hours
	    					@if ( isset($shifts_per_week[$i]['submitted']) )
		    					@if (  isset($shifts_per_week[$i]['approved']))
									@if ($shifts_per_week[$i]['approved'])
										<span class="pull-right label label-success">Approved</span>
									@else 
										<span class="pull-right label label-danger">Disapproved</span>
									@endif
								@else
									<span class="pull-right label label-info">Submitted</span>
								@endif
							@elseif ( (time() - strtotime($week_start)) / 86400 >= 2 )
								<span class="pull-right label label-warning">Late</span>
							@endif
	    				</h3>
						<div>
							@if ( ! isset($shifts_per_week[$i]['submitted']) )
								{{ Form::open(['url'=>'ta/timesheet','class'=>'form']) }}
								<input type="hidden" name="week" value="{{ date('Y-m-d',strtotime($week_end) - (($current_week - $i) * 7 * 86400)) }}">
							@endif

							<div>
								<div class="col-md-12">
									<label>Shifts:</label>
									<ul>
										@if ( $shifts_total[$i] > 0)
											@foreach ($shifts_per_week[$i]['shifts'] as $shift)
												<li>
													{{ date("l, M jS",strtotime($shift->date)) }} : {{ Number::toTime($shift->start) }} - {{ Number::toTime($shift->end) }} : {{ ($shift->end - $shift->start) / 100 }} hours
													<input type="hidden" name="{{ strtolower(date('l',strtotime($shift->date))) }}[]" value="{{ ($shift->end - $shift->start) / 100 }}">
												</li>
											@endforeach
										@else
											<li>No Shifts</li>
										@endif
									</ul>
								</div>
							</div>

							<div>
								<div class="form-group col-md-5">
									<label for="week-{{ $i }}-additional" class="control-label">Additional Hours: </label>
									@if ( ! isset($shifts_per_week[$i]['submitted']) )
										<input type="input" class="additional form-control" name="additional" id="week-{{ $i }}-additional">
									@else
										<p>{{ $shifts_per_week[$i]['additional'] }}</p>
									@endif
								</div>	
							</div>

							<div>
								<div class="form-group col-md-12">
									<label for="week-{{ $i }}-memo">Memo: </label>
									@if ( ! isset($shifts_per_week[$i]['submitted']) )
										<input type="text" class="form-control" name="memo" id="week-{{ $i }}-memo">	
									@else
										<p>{{ $shifts_per_week[$i]['memo'] }}</p>
									@endif
								</div>
							</div>
							
							<div>
								<div class="col-md-12">
									@if ( isset($shifts_per_week[$i]['submitted']) )
										<p><label>Total:</label> <span id="week-{{ $i }}-hours" class="hours">{{ $shifts_total[$i] + $shifts_per_week[$i]['additional'] }}</span> hours</p>
										<span hidden=hidden id="week-{{ $i }}-hours-original">{{ $shifts_total[$i] + $shifts_per_week[$i]['additional'] }}</span>
									@else
										<p><label>Total:</label> <span id="week-{{ $i }}-hours" class="hours">{{ $shifts_total[$i] }}</span> hours</p>
										<span hidden=hidden id="week-{{ $i }}-hours-original">{{ $shifts_total[$i] }}</span>
										<input type="hidden" name="total" id="week-{{ $i }}-hours-total" value="{{ $shifts_total[$i] }}">
										<button type="submit" class="btn btn-primary">Submit Timesheet</button>
									@endif
								</div>	
							</div>
							<br>
							
							@if ( ! isset($shifts_per_week[$i]['submitted']) )
								{{ Form::close() }}
							@endif
						</div>
					@endfor
    			</div>
    		</div>
    		<div class="col-md-6">
    			<fieldset>
    				<legend class="text-center">Hours Summary</legend>
    			</fieldset>
    			<div class="col-md-6">
    				<table class="table">
	    				<thead>
	    					<tr>
	    						<th>Hours</th><th class="text-center">Amount</th>
	    					</tr>
	    				</thead>
	    				<tbody>
	    					<tr>
	    						<td>Worked:</td><td class="text-center">{{ $hours['worked'] }}</td>
	    					</tr>
	    					<tr>
	    						<td>Additional:</td><td class="text-center">{{ $hours['additional'] }}</td>
	    					</tr>
	    					<tr>
	    						<td>Total:</td><td class="text-center">{{ $hours['total'] }}</td>
	    					</tr>
	    				</tbody>
	    			</table>
    			</div>
    			<div class="col-md-6">
    				<table class="table">
	    				<thead>
	    					<tr>
	    						<th>Hours</th><th>Amount</th>
	    					</tr>
	    				</thead>
	    				<tbody>
	    					<tr>
	    						<td>Submitted:</td><td class="text-center">{{ $hours['submitted'] }}</td>
	    					</tr>
	    					<tr>
	    						<td>Approved:</td><td class="text-center">{{ $hours['approved'] }}</td>
	    					</tr>
	    				</tbody>
	    			</table>
    			</div>
    		</div>
    	</div>
    </div>

	{{ HTML::script('js/time-conversion.js') }}
    {{ HTML::script('js/ta-hours.js') }}
@stop