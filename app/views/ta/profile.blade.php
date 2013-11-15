@extends("layout")
@section("content")
    <div class="col-md-12">
        <fieldset class="col-md-12">
        	<legend>My Information</legend>
        	{{ Form::open(array('url' => 'ta/profile', 'role' =>"form")) }}
	        	<div class="col-md-6">
	        		<div class="form-group">
						{{ Form::label('picture', 'Image') }} <br>
						<img src="{{ asset($ta->picture) }}" alt="{{ $ta->name }}" class="img-thumbnail">
						{{ Form::file('picture', array("class" => "form-control") ) }}
					</div>
					<div class="form-group">
						{{ Form::label('name', 'Name') }}
						{{ Form::text('name', $ta->name, array("class" => "form-control") ) }}
					</div>
					<div class="form-group">
						{{ Form::label('description', 'Description') }}
						{{ Form::textarea('description', $ta->description, array("class" => "form-control") ) }}
					</div>
					
					<div class="form-group">
						{{ Form::label('name', 'Name') }}
						{{ Form::text('name', $ta->name, array("class" => "form-control") ) }}
					</div>
	        	</div>
			{{ Form::close() }}

        </fieldset>
    </div>
@stop