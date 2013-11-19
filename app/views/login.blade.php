@extends("layout")
@section("content")
	<div class="col-md-4 col-md-offset-4">
		{{ Form::open(["url" => "login", "autocomplete" => "off", "role" => "form"]) }}
		    @if ( $error = $errors->first("password") )
	            <div class="alert alert-warning alert-dismissable">
	            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                {{ $error }}
	            </div>
	        @endif
	    	<div class="form-group">
		        {{ Form::label("username", "Username") }}
		        {{ Form::text("username", Input::get("username"), [
		            "placeholder" => "Username",
		            "class" =>"form-control"
		        ]) }}
		    </div>
		    <div class="form-group">
		    	{{ Form::label("password", "Password") }}
		        {{ Form::password("password", [
		            "placeholder" => "Password",
		            "class" =>"form-control"
		        ]) }}
		    </div>
	        {{ Form::submit("login", array("class"=>"btn btn-block btn-lg btn-success") ) }}
	    {{ Form::close() }}
	</div>
@stop