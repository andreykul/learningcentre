@extends("layout")
@section("content")
    <div class="col-md-12">
        <fieldset>
        	<legend><a class="btn btn-lg btn-link" href="{{ url('/') }}">
        		<span class="glyphicon glyphicon-circle-arrow-left"></span></a> {{ $ta->name }}</legend>
		        <div class="row">
		        	<div class="col-md-4">
						<label>Image</label> <br>
							<img src="{{ asset('images/'.$ta->picture) }}" width="100%" alt="{{ $ta->name }}" class="img-thumbnail">
		        	</div>

		        	<div class="col-md-4">
		        		<dl>
		        			<dt>Name</dt>
							<dd>{{ $ta->name }}</dd>
							<br>
							<dt>Description</dt>
							<dd>{{ $ta->description }}</dd>
		        		</dl>
		        	</div>
		        	<div class="col-md-4">
						<dt>Program</dt>
						<dd>{{ $ta->graduate?"Graduate":"Undergraduate" }}</dd>
						<br>
						<dt>Year</dt>
						<dd>{{ $ta->year }}</dd>
		        	</div>
		        </div>
        </fieldset>
    </div>
@stop