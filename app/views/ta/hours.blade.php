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
	    				</h3>
						<div>
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
						</div>
					@endfor
    			</div>
    		</div>
    		<div class="col-md-6 text-center">
    			<fieldset>
    				<legend>Hours Summary</legend>
    			</fieldset>
    			<div class="col-md-12">
    				Total Hours Worked: {{ $hours['total'] }}
    			</div>
    		</div>
    	</div>
    </div>

	{{ HTML::script('js/time-conversion.js') }}
    {{ HTML::script('js/ta-hours.js') }}
@stop