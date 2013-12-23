@extends("layout")
@section("content")
    <div class="col-md-12">
    	<fieldset id="schedule">
    		{{ Form::open(['url' => 'admin/schedule/day', 'role' => 'form']) }}
        	<legend class="row"><a class="btn btn-lg btn-link" href="{{ url('admin/schedule') }}">
        		<span class="glyphicon glyphicon-circle-arrow-left"></span></a> {{ $day }}'s Schedule
        	</legend>
        	{{ form::hidden('day', $day) }}
			<div class="row">
	        	<table class="table table-striped table-bordered table-condensed">
		        	<thead>
		        		<tr>
		        			<th class="text-center">Time</th>
		        			@foreach ($tas as $ta)
								<th class="text-center">
									{{ $ta->name }} <span id="{{ $ta->id }}-current-hours">{{ $ta->current_hours }}</span>/<span id="{{ $ta->id }}-wanted-hours">{{ $ta->wanted_hours }}</span>
								</th>
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

			        			@foreach ($tas as $ta)
									<td id="{{ $ta->id }}-{{ str_pad($i, 4, '0', STR_PAD_LEFT) }}"
										@if ( isset($available[$ta->id][$i]) )
											class="
											@if ($available[$ta->id][$i])
												success
											@else
												warning
											@endif
											@if (isset($assigned[$ta->id][$i]))
												info
											@endif
											"
										@endif
									>
									@if ( isset($available[$ta->id][$i]) )
										{{ Form::hidden("ta-{$ta->id}[$i]", 
											isset($assigned[$ta->id][$i])?1:0) }}
									@endif
									</td>
								@endforeach

							</tr>	
			        	@endfor
		        	</tbody>
		        </table>
	        </div>
	        <div class="row">
	        	{{ Form::submit("Save $day's Schedule", array('class' => 'btn btn-lg btn-primary center-block') ) }}
	        </div>
	        {{ Form::close() }}
		</fieldset>
		<!-- Special for this page only -->
		{{ HTML::script('js/admin-schedule.js') }}
    </div>
@stop