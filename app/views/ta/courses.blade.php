@extends("layout")
@section("content")
    <div class="col-md-12">
        <fieldset>
        	<legend class='text-center row'><a class="pull-left btn-link" href="{{ url('ta/profile') }}">
        		<span class="glyphicon glyphicon-circle-arrow-left"></span></a>Courses Knowledge Rating
        	</legend>
        	<table class='table'>
        		<thead>
        			<tr>
        				<th class="col-md-6 text-center">Course</th>
        				<th class="col-md-6 text-center">Material Knowledge</th>
        			</tr>
        		</thead>
        		<tbody>
        			<!-- <tr>
        				<td></td>
        				<td><span class='pull-left'>No Knowledge</span><span class='pull-right'>Know Well</span></td>
        			</tr> -->
        			@foreach ($courses as $course)
        				<tr>
        					<td class="text-center">
        						{{ "{$course->prefix} {$course->number} {$course->name}" }}
        					</td>
        					<td class="text-center">
        						<span id='course-{{ $course->id }}' class="stars">
        						@for ($i = 1; $i <= 5 ; $i++)
        							@if ( $i > $knowledge[$course->id] )
        								<span id='course-{{ "{$course->id}-$i" }}'
        									class="star glyphicon glyphicon-lg glyphicon-star-empty"></span>
        							@else
        								<span id='course-{{ "{$course->id}-$i" }}'
        									class="star glyphicon glyphicon-lg glyphicon-star text-warning {{ $knowledge[$course->id]==$i?'selected':'' }}"></span>
        							@endif
        						@endfor
        						</span>
        					</td>
        				</tr>
	        		@endforeach	
        		</tbody>
        	</table>
        </fieldset>

        {{ HTML::script('js/ta-courses.js') }}
    </div>
@stop