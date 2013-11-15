@extends("layout")
@section("content")
    <div class="col-md-12">
        <fieldset class="col-md-12">
        	<legend>My Information</legend>
        	{{ Form::open(array('url' => 'ta/profile', 'role' =>"form")) }}
	        	<div class="col-md-3">
	        		<div class="form-group">
						{{ Form::label('picture', 'Image') }} <br>
						<img src="{{ asset($ta->picture) }}" alt="{{ $ta->name }}" class="img-thumbnail">
						{{ Form::file('picture', array("class" => "form-control") ) }}
					</div>
	        	</div>

	        	<div class="col-md-4">
	        		<div class="form-group">
						{{ Form::label('name', 'Name') }}
						{{ Form::text('name', $ta->name, array("class" => "form-control") ) }}
					</div>
					<div class="form-group">
						{{ Form::label('description', 'Description') }}
						{{ Form::textarea('description', $ta->description, array("class" => "form-control") ) }}
					</div>
	        	</div>
	        	<div class="col-md-4">
	        		<div class="form-group">
						{{ Form::label('graduate', 'Program') }}

						{{ Form::select('graduate', array('0' => 'Undergraduate', '1' => 'Graduate'), $ta->graduate, array('class' => 'form-control') )  }}
					</div>
					<div class="form-group">
						{{ Form::label('year', 'Year') }}
						<input type="number" name="year" class="form-control" value="{{ $ta->year }}"/>
					</div>
	        		<div class="form-group">
						{{ Form::label('hours', 'Hours Wanted') }}
						<input type="number" name="hours" class="form-control" value="{{ $ta->hours }}"/>
					</div>

					{{ Form::submit("Save Changes", array('class'=>'btn btn-primary') ) }}
	        	</div>
			{{ Form::close() }}

        </fieldset>
    </div>
@stop