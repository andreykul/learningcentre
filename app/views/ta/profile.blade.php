@extends("layout")
@section("content")
    <div class="col-md-12">
		@if (Session::get('success'))
			<div>
				<div class="alert alert-success text-center">
					{{ Session::get('success') }}
				</div>
			</div>
		@elseif (Session::get('fail'))
			<div>
				<div class="alert alert-danger text-center">
					{{ Session::get('fail') }}
				</div>
			</div>
		@endif


    	@if ( $user['active'] )
        <fieldset>
        	<legend class="text-center">My Information</legend>
        	{{ Form::open(array('url' => 'ta/profile', 'method'=>'put', 'role' =>"form", 'files' => true)) }}
		        <div class="col-md-12">
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
							<a href="{{ url('ta/profile/courses') }}" class='btn btn-lg btn-block btn-info'>
								<span class="glyphicon glyphicon-certificate"></span> Courses Knowledge Rating
							</a>
						</div>

		        	</div>
		        </div>
		        
		        <div class="col-md-4 col-md-offset-4">
		        	<button type="submit" class='btn btn-primary btn-lg btn-block'>
						<span class="glyphicon glyphicon-floppy-disk"></span> Save Changes
					</button>
		        	{{ Form::close() }}
		        </div>
        </fieldset>
        @endif

        <div class="col-md-4 col-md-offset-4">
        	@if ($user['active'])
	        	{{ Form::open(array('url' => 'ta/profile', 'role' => 'form', 'method'=>'delete')) }}
					<button type="button" class='deactivateTA btn btn-danger btn-lg btn-block'>
						<span class="glyphicon glyphicon-remove-circle"></span> Deactivate
					</button>
				{{ Form::close() }}
			@else
				{{ Form::open(array('url' => 'ta/profile', 'role' => 'form')) }}
					<button type="submit" class='btn btn-success btn-lg btn-block'>
						<span class="glyphicon glyphicon-ok-circle"></span> Activate
					</button>
				{{ Form::close() }}
			@endif
        </div>
    </div>
    {{ HTML::script('js/ta-profile.js') }}
@stop