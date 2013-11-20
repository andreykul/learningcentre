@extends("layout")
@section("content")
	<div class="col-md-4">
		<fieldset>
			<legend>New Teaching Assistant</legend>
			{{ Form::open(["url" => "admin/ta", "role" => "form"]) }}
				<div class="form-group">
					{{ Form::label('email', 'Email') }}
					{{ Form::email('email', null, array("class" => "form-control") ) }}
				</div>
				{{ Form::submit("Add", array('class' => 'btn btn-block btn-primary')) }}
			{{ Form::close() }}
		</fieldset>
	</div>

    <div class="col-md-8">
    	<fieldset>
    		<legend>Teaching Assistants</legend>
    		<table class="table table-striped">
    			<thead>
    				<tr>
    					<th class="text-center">Name</th>
    					<th class="text-center">Email</th>
    					<th class="text-center">Action</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach ($tas as $ta)
    					<tr>
    						<td class="text-center">{{ $ta->name }}</td>
		    				<td class="text-center">{{ $ta->user()->email }}</td>
		    				<td class="text-center">
		    					{{ Form::open(["url" => "admin/ta/".$ta->id, 'method' => 'delete', "role" => "form"]) }}
		    						{{ Form::submit("Delete", array('class' => 'btn btn-block btn-danger')) }}
		    					{{ Form::close() }}
		    				</td>
		    			</tr>
		    		@endforeach
    			</tbody>
    		</table>
    	</fieldset>
	<div>
@stop