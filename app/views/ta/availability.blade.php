@extends("layout")
@section("content")
    <div class="col-md-12">
        <div>
        	Some stuff!
        </div>

        <table class="table table-striped table-bordered table-condensed">
        	<thead>
        		<tr>
        			<th>Time</th>
        			@foreach ($days as $day)
						<th>{{ $day }}</th>
        			@endforeach
        		</tr>
        	</thead>
        	<tbody>
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
@stop