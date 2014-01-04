@extends("layout")
@section("content")
    <div class="col-md-12">
        <fieldset>
        	<legend class='text-center row'><a class="pull-left btn-link" href="{{ url('ta/profile') }}">
        		<span class="glyphicon glyphicon-circle-arrow-left"></span></a>Courses Knowledge Rating
        	</legend>

            <div class="row">
                <div hidden=hidden class="alert alert-success text-center">
                </div>    
            </div>

        	<table class='table'>
        		<thead>
        			<tr>
        				<th class="col-md-6 text-center">Course</th>
        				<th class="col-md-6 text-center">Material Knowledge</th>
        			</tr>
        		</thead>
        		<tbody>
        			@foreach ($courses as $course)
        				<tr>
        					<td id='course-{{ $course->id }}' class="text-center">
        						{{ "{$course->prefix} {$course->number} {$course->name}" }}
        					</td>
        					<td class="text-center">
        						<span class="stars">
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