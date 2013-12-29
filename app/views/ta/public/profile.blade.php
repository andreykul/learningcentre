@extends("layout")
@section("content")
    <div class="col-md-12">
        <fieldset>
        	<legend class="text-center"><a class="pull-left btn-link" href="{{ url('/') }}">
        		<span class="glyphicon glyphicon-circle-arrow-left"></span></a> {{ $ta->name }}</legend>
		        <div class="row">
		        	<div class="col-md-4">
						<label>Image</label> <br>
							<img src="{{ asset('images/'.$ta->picture) }}" width="100%" alt="{{ $ta->name }}" class="img-thumbnail">
		        	</div>

		        	<div class="col-md-4">
		        		<dl>
		        			<dt>Name</dt>
							<dd>{{ $ta->name }}</dd>
							<br>
							<dt>Description</dt>
							<dd>{{ $ta->description }}</dd>
		        		</dl>
		        	</div>
		        	<div class="col-md-4">
						<dt>Program</dt>
						<dd>{{ $ta->graduate?"Graduate":"Undergraduate" }}</dd>
						<br>
						<dt>Year</dt>
						<dd>{{ $ta->year }}</dd>
		        	</div>
		        </div>

				<br>

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
        					<td class="text-center">
        						{{ "{$course->prefix} {$course->number} {$course->name}" }}
        					</td>
        					<td class="text-center">
        						@for ($i = 1; $i <= 5 ; $i++)
        							@if ( $i > $knowledge[$course->id] )
        								<span id='course-{{ "{$course->id}-$i" }}'
        									class="glyphicon glyphicon-lg glyphicon-star-empty"></span>
        							@else
        								<span id='course-{{ "{$course->id}-$i" }}'
        									class="glyphicon glyphicon-lg glyphicon-star text-warning {{ $knowledge[$course->id]==$i?'selected':'' }}"></span>
        							@endif
        						@endfor
        					</td>
        				</tr>
	        		@endforeach	
        		</tbody>
        	</table>
        </fieldset>
    </div>
@stop