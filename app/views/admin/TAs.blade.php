@extends("layout")
@section("content")
	<div class="row">
		<div class="col-md-4">
			<fieldset>
				<legend>New Teaching Assistant</legend>
				@foreach ($errors->all() as $error)
					<div class="row">
						<div class="alert alert-danger text-center">
							{{ $error }}
						</div>
					</div>
				@endforeach

				{{ Form::open(["url" => "admin/tas/add", "role" => "form"]) }}
					<div class="form-group">
						{{ Form::label('name', 'Name') }}
						{{ Form::text('name', null, array("class" => "form-control") ) }}
					</div>
					<div class="form-group">
						{{ Form::label('email', 'Email') }}
						{{ Form::email('email', null, array("class" => "form-control") ) }}
					</div>
					{{ Form::submit("Add TA", array('class' => 'btn btn-block btn-primary')) }}
				{{ Form::close() }}
			</fieldset>
			<br>
			<fieldset>
				<legend>Courses</legend>
				@if ( Session::get('course_fail') )
					<div class="row">
						<div class="alert alert-danger text-center">
							{{ Session::get('course_fail') }}
						</div>
					</div>
				@elseif ( Session::get('course_success') )
					<div class="row">
						<div class="alert alert-success text-center">
							{{ Session::get('course_success') }}
						</div>
					</div>
				@endif
				{{ Form::open(array('url'=>'admin/courses', 'role'=>'form')) }}
					<div class="form-group">
						{{ Form::label('course', 'Course') }}
						{{ Form::text('course', null, array("class" => "form-control","placeholder"=>"CSCI 2110 Introfuction to Computer Science III") ) }}
					</div>
					{{ Form::submit("Add Course", array('class' => 'btn btn-block btn-primary')) }}
				{{ Form::close() }}
				<br>
				<label>Existing Courses</label>
				<ul class='list-unstyled'>
					@foreach ($courses as $course)
						<li>
							{{ Form::open(array('url'=>'admin/courses', 'role'=>'form', 'method'=>'delete')) }}
							<button type="submit" name="course_id" value="{{ $course->id }}" class="btn-link"><span class="text-danger glyphicon glyphicon-remove"></span></button>
							{{ "{$course->prefix} {$course->number} {$course->name}" }}
							{{ Form::close() }}
						</li>
					@endforeach
				</ul>
			</fieldset>
		</div>

	    <div class="col-md-8">
	    	<fieldset>
	    		<legend>Teaching Assistants</legend>
	    		<table class="table table-striped">
	    			<thead>
	    				<tr>
	    					<th class="text-center">Name</th>
	    					<th class="text-center">Active</th>
	    					<th class="text-center">Email</th>
	    					<th class="text-center">Action</th>
	    				</tr>
	    			</thead>
	    			<tbody>
	    				@foreach ($tas as $ta)
	    					<tr>
	    						<td class="text-center">{{ $ta->name }}</td>
	    						<td class="text-center">
			    					@if ($ta->active)
			    						<span class="text-success glyphicon glyphicon-lg glyphicon-ok-sign"></span>
			    					@else
			    						<span class="text-danger glyphicon glyphicon-lg glyphicon-minus-sign"></span>
			    					@endif
			    				</td>
			    				<td class="text-center">{{ $ta->user()->email }}</td>
			    				<td class="text-center">
			    					{{ Form::open(["url" => "admin/tas/remove/".$ta->id, 'method' => 'delete', "role" => "form"]) }}
			    						{{ Form::submit("Delete", array('class' => 'btn btn-block btn-danger')) }}
			    					{{ Form::close() }}
			    				</td>
			    			</tr>
			    		@endforeach
	    			</tbody>
	    		</table>
	    	</fieldset>
		<div>
	</div>
@stop