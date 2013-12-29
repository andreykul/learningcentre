@extends("layout")
@section("content")
    <div class="col-md-12">
    	@if ( $user['active'] )
        <fieldset>
        	<legend>My Information</legend>
        	{{ Form::open(array('url' => 'ta/profile', 'method'=>'put', 'role' =>"form", 'files' => true)) }}
		        <div class="row">
		        	<div class="col-md-4">
		        		<div class="form-group">
							{{ Form::label('picture', 'Image') }} <br>
								<img src="{{ asset('images/'.$ta->picture) }}" width="100%" alt="{{ $ta->name }}" class="img-thumbnail">
							<div class="input-group">
								<span class="input-group-btn">
									<span class="btn btn-success btn-file">
										Browse… <input type="file" id="picture" class="browse-file" accept="image/*" name="picture">
									</span>
								</span>
								<input type="text" class="form-control file-text" readonly="">
							</div>
							@if ( $error = $errors->first("picture") )
								<div class="alert alert-warning alert-dismissable">
					            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					                {{ $error }}
					            </div>
							@endif
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
							{{ Form::label('wanted_hours', 'Hours Wanted') }}
							<input type="number" name="wanted_hours" class="form-control" value="{{ $ta->wanted_hours }}"/>
						</div>
						<div class="form-group">
							{{ link_to('ta/profile/courses', "Courses Knowledge Rating", $attributes = array('class'=>'btn btn-lg btn-block btn-info')) }}
						</div>

		        	</div>
		        </div>
		        
		        <div class="col-md-4 col-md-offset-4">
		        	{{ Form::submit("Save Changes", array('class'=>'btn btn-primary btn-lg btn-block') ) }}
		        	{{ Form::close() }}
		        </div>
        </fieldset>
        @endif

        <div class="col-md-4 col-md-offset-4">
        	@if ($user['active'])
	        	{{ Form::open(array('url' => 'ta/profile', 'role' => 'form', 'method'=>'delete')) }}
					{{ Form::submit("Deactivate", array('class'=>'btn btn-danger btn-lg btn-block')) }}
				{{ Form::close() }}
			@else
				{{ Form::open(array('url' => 'ta/profile', 'role' => 'form')) }}
					{{ Form::submit("Activate", array('class' => 'btn btn-success btn-lg btn-block')) }}
				{{ Form::close() }}
			@endif
        </div>
    </div>
@stop