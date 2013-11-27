@extends("layout")
@section("content")
    <div class="col-md-12">
        <fieldset class="col-md-12">
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
										Browse… <input type="file" id="picture" class="browse-file" name="picture">
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
							{{ Form::label('hours', 'Hours Wanted') }}
							<input type="number" name="hours" class="form-control" value="{{ $ta->hours }}"/>
						</div>

		        	</div>
		        </div>
		        
		        <div class="col-md-4 col-md-offset-4">
		        	{{ Form::submit("Save Changes", array('class'=>'btn btn-primary btn-lg btn-block') ) }}
		        	{{ Form::close() }}

					{{ Form::open(array('url' => 'ta/profile', 'role' => 'form', 'method'=>'delete', 'class'=>'inline')) }}
						{{ Form::submit("Deactivate", array('class'=>'btn btn-danger btn-lg btn-block') ) }}
					{{ Form::close() }}
		        </div>
        </fieldset>
    </div>
@stop