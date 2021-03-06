@section("header")
   <nav class="navbar navbar-default" role="navigation">
		<div class="navbar-header">
			<a class="navbar-brand" href="{{ url('/') }}">
				Learning Centre Application
			</a>
		</div>
		<div class="collapse navbar-collapse">
			@if (isset($navbar))
				<ul class="nav navbar-nav">
			    	@foreach ($navbar as $name => $link)
			    		<li @if ($link['active']) {{ "class='active'" }} @endif>
			    			<a href="{{ $link['url'] }}">{{ $name }}</a>
			    		</li>
			    	@endforeach
			    </ul>
		    @endif

			@if ( ! isset($noLogin) )
				@if (isset($user))
		            <ul class="nav navbar-nav navbar-right">
		            	<li class="dropdown">
		            		<a href="#" class="dropdown-toggle" 
		            			data-toggle="dropdown">
		            			<span class="glyphicon glyphicon-user"></span>
		            			{{ $user['username'] }}
		            			<b class="caret"></b>
		            		</a>
							<ul class="dropdown-menu">
								<li><a href="{{ url('logout') }}">
									<span class="glyphicon glyphicon-off"></span> Logout
								</a></li>
							</ul>
		            	</li>
					</ul>
				@else
					{{ Form::open([
						"url" => "login",
						"autocomplete" => "off",
						"class" => "navbar-form navbar-right"
					]) }}
				        {{ Form::text("email", Input::old("email"), [
				            "placeholder" => "Email"
				        ]) }}
				        {{ Form::password("password", [
				            "placeholder" => "Password"
				        ]) }}
				        {{ Form::submit("Login", array("class"=>"btn btn-success") ) }}
				    {{ Form::close() }}	
			    @endif
	        @endif
			 
		</div>
		
	</nav>
@show