@section("header")
   <nav class="navbar navbar-default" role="navigation">
		<div class="navbar-header">
			<a class="navbar-brand" href="{{ url('/') }}">Learning Centre Application</a>
		</div>
		<div class="collapse navbar-collapse">
			@if (isset($navbar))
				<ul class="nav navbar-nav">
			    	@foreach ($navbar as $name => $url)
			    		<li><a href="{{ $url }}">{{ $name }}</a></li>
			    	@endforeach
			    </ul>
		    @endif

			@if (isset($user))
	            <div class="btn-group navbar-right">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						{{ $user['username'] }} <span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="{{ url('logout') }}">Logout</a></li>
					</ul>
				</div>
			@elseif ( ! isset($loginPage))
				{{ Form::open(["url" => "login","autocomplete" => "off", "class" => "navbar-form navbar-right"]) }}
			        {{ Form::text("username", Input::old("username"), [
			            "placeholder" => "Username"
			        ]) }}
			        {{ Form::password("password", [
			            "placeholder" => "Password"
			        ]) }}
			        {{ Form::submit("Login") }}
			    {{ Form::close() }}	
	        @endif
			 
		</div>
		
	</nav>
@show