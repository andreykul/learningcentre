@extends("layout")
@section("content")
	<div class="col-md-12">
		<div class="col-md-4">
			<fieldset>
				<legend class="text-center">New Teaching Assistant</legend>
				@foreach ($errors->all() as $error)
					<div>
						<div class="alert alert-danger text-center">
							{{ $error }}
						</div>
					</div>
				@endforeach

				{{ Form::open(["url" => "admin/tas/add", "role" => "form"]) }}
					<div class="form-group">
						{{ Form::label('name', 'Name') }}
						{{ Form::text('name', null, array("class" => "form-control", "placeholder" => "John Smith") ) }}
					</div>
					<div class="form-group">
						{{ Form::label('email', 'Email') }}
						{{ Form::email('email', null, array("class" => "form-control", "placeholder" => "john.smith@cs.dal.ca") ) }}
					</div>
					<button type="submit" class='btn btn-block btn-primary'>
						<span class="glyphicon glyphicon-plus-sign"></span> Add TA
					</button>
				{{ Form::close() }}
			</fieldset>
			<br>
			<br>
			<fieldset>
				<legend class="text-center">Courses</legend>
				@if ( Session::get('course_fail') )
					<div>
						<div class="alert alert-danger text-center">
							{{ Session::get('course_fail') }}
						</div>
					</div>
				@elseif ( Session::get('course_success') )
					<div>
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
					
					<button type="submit" class='btn btn-block btn-primary'>
						<span class="glyphicon glyphicon-plus-sign"></span> Add Course
					</button>
				{{ Form::close() }}
				<br>
				<label>Existing Courses</label>
				<ul class='list-unstyled'>
					@foreach ($courses as $course)
						<li>
							{{ Form::open(array('url'=>'admin/courses', 'role'=>'form', 'method'=>'delete')) }}
								<button type="button" name="course_id" value="{{ $course->id }}" class="removeCourse btn-link"><span class="text-danger glyphicon glyphicon-remove"></span></button>
							{{ "{$course->prefix} {$course->number} {$course->name}" }}
							{{ Form::close() }}
						</li>
					@endforeach
				</ul>
			</fieldset>
		</div>

	    <div class="col-md-8">
	    	<fieldset>
	    		<legend class="text-center">Teaching Assistants</legend>
	    		<table class="table table-striped">
	    			<thead>
	    				<tr>
	    					<th class="text-center">Name</th>
	    					<th class="text-center">Active</th>
	    					<th class="text-center">Wanted Hours</th>
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
			    				<td class="text-center">{{ $ta->wanted_hours }}</td>
			    				<td class="text-center">{{ $ta->user()->email }}</td>
			    				<td class="text-center">
			    					{{ Form::open(["url" => "admin/tas/remove/".$ta->id, 'method' => 'delete', "role" => "form"]) }}
			    					<button class='removeTA btn btn-block btn-danger'>
										<span class="glyphicon glyphicon-remove"></span> Delete
									</button>
									{{ Form::close() }}
			    					
			    				</td>
			    			</tr>
			    		@endforeach
	    			</tbody>
	    		</table>
	    	</fieldset>
		<div>
	</div>
	{{ HTML::script('js/admin-tas.js') }}
@stop