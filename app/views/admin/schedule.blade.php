@extends("layout")
@section("content")
    <div class="col-md-12">
    	@if (Session::get('success'))
			<div class="row">
				<div class="alert alert-success text-center">
					{{ Session::get('success') }}
				</div>
			</div>
		@endif

		<div class="modal fade" aria-hidden="true">
			{{ Form::open(array('url'=>'admin/schedule', 'role'=>"form")) }}
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Publish Schedule</h4>
					</div>
					<div class="modal-body">
						<!-- <div class="col-md-6"> -->
							{{ Form::label('start-date',"Start Date:") }}
							{{ Form::text('start-date',null, array('id'=>'start-date', 'class'=>'form-control date-input')) }}
						<!-- </div>
						<div class="col-md-6"> -->
							{{ Form::label('end-date',"End Date:") }}
							{{ Form::text('end-date',null, array('id'=>'end-date', 'class'=>'form-control date-input')) }}
						<!-- </div> -->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Publish</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
			{{ Form::close() }}
		</div><!-- /.modal -->
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
								<td class="text-center">
									{{ str_pad(intval($i/100), 2, "0", STR_PAD_LEFT) }}:{{ str_pad($i%100/100*60, 2, "0", STR_PAD_LEFT) }}
									 - 
									{{ str_pad(intval(($i+50)/100), 2, "0", STR_PAD_LEFT) }}:{{ str_pad(($i+50)%100/100*60, 2, "0", STR_PAD_LEFT) }}
								</td>

			        			@foreach ($days as $day)
			        				
									<td id="{{ $day }}-{{ str_pad($i, 4, '0', STR_PAD_LEFT) }}"
										@if (isset($assigned[$day][$i]))
											class="info"
										@elseif (isset($week[$day][$i]))
											@if (($week[$day][$i] / $max) > (2 / 3))
												class="success"
											@elseif (($week[$day][$i] / $max) > (1 / 3))
												class="warning"
											@else
												class="danger"
											@endif
										@endif
										>
										@if (isset($assigned[$day][$i]))
											{{ $assigned[$day][$i][0] }}
				        					@for ($j=1; $j < count($assigned[$day][$i]); $j++)
												{{ '&amp '.$assigned[$day][$i][$j] }}
											@endfor
			        					@endif
									</td>
								@endforeach

							</tr>	
			        	@endfor
		        	</tbody>
		        </table>
	        </div>
	        <div class="row">
	        	<div class="col-md-4 col-md-offset-4">
		        		{{ Form::button('Publish', array('id'=>'publish','class'=>'btn btn-lg btn-primary btn-block')) }}
		        	{{ Form::open(['url'=>'admin/schedule', 'method'=>'delete', 'role'=>'form']) }}
		        		{{ Form::submit('Reset', array('class'=>'btn btn-lg btn-danger btn-block')) }}
		        	{{ Form::close() }}	
	        	</div>
	        </div>
		</fieldset>
		<!-- Special for this page only -->
		{{ HTML::script('js/admin-schedule.js') }}
		<style>
			td:hover{
				cursor: pointer;
			}
		</style>
    </div>
@stop