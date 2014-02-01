@extends("layout")
@section("content")
	<div class="col-md-12">
		@if (Session::get('success'))
			<div>
				<div class="alert alert-success text-center">
					{{ Session::get('success') }}
				</div>
			</div>
		@endif

		@if (Session::get('warning'))
			<div>
				<div class="alert alert-warning text-center">
					{{ Session::get('warning') }}
				</div>
			</div>
		@endif

		@if (Session::get('fail'))
			<div>
				<div class="alert alert-danger text-center">
					{{ Session::get('fail') }}
				</div>
			</div>
		@endif

		<div>
			<div class="col-md-4">
		    	<fieldset>
		    		<legend class="text-center">Availabiltiy Settings</legend>
					

		    		{{ Form::open(["url" => "admin/availability", "role" => "form"]) }}

						{{ Form::label("availability_locked","Availability Changes Locked:") }}
						{{ Form::select("availability_locked", 
								array(
									false =>"Off",
									true =>"On"
								),
								$availability['locked'],
								array("data-width" => "auto")
							) 
						}}

						<div>
							<label for="hours">Hours range:</label>
							<span id="hours">
								{{ $availability['start_time'] }} - {{ $availability['end_time'] }}
							</span>
							{{ Form::hidden("availability_start_hour", $availability['start_time']) }}
							{{ Form::hidden("availability_end_hour", $availability['end_time']) }}
						</div>

						<div id="slider-range"></div>	
					
						{{ HTML::script('js/time-conversion.js') }}
						{{ HTML::script('js/availability-settings.js') }}

						<br>

						{{ Form::button("<span class='glyphicon glyphicon-floppy-disk'></span> Save Changes",
								array("class" => "btn btn-primary btn-block","type" => "submit")
							)
						}}
					{{ Form::close() }}
		    	</fieldset>
		    	<br><br>
				<fieldset>
					<legend class="text-center">Export Availability</legend>
					<div>
		    			{{ Form::open(["url" => "admin/availability/export", "role" => "form"]) }}
							<div>
								{{ Form::label("day","Select:") }}
								{{ Form::select("day", 
										array(
											"All" => "All",
											"Monday" => "Monday",
											"Tuesday" => "Tuesday",
											"Wednesday" => "Wednesday",
											"Thursday" => "Thursday",
											"Friday" => "Friday",
											"Saturday" => "Saturday",
											"Sunday" => "Sunday",
										),
										null,
										array("data-width" => "auto")
									)
								}}
							</div>
							<br>
							{{ Form::button("<span class='glyphicon glyphicon-upload'></span> Export",
									array("class" => "btn btn-primary btn-block","type" => "submit")
								)
							}}
		    			{{ Form::close() }}
		    		</div>
				</fieldset>
		    	<br><br>
		    	<fieldset>
		    		<legend class="text-center">Import Availability</legend>
		    		{{ Form::open(array('url' => 'admin/availability/import', 'files' => true)) }}
			    		<div>
			    			
				    		{{ Form::label("day","Select:") }}
							{{ Form::select("day",
									array(
										"Monday" => "Monday",
										"Tuesday" => "Tuesday",
										"Wednesday" => "Wednesday",
										"Thursday" => "Thursday",
										"Friday" => "Friday",
										"Saturday" => "Saturday",
										"Sunday" => "Sunday",
									),
									null,
									array("data-width" => "auto")
								)
							}}
			    		</div>

			    		<br>

			    		<div class="input-group">
							<span class="input-group-btn">
								<span class="btn btn-success btn-file">
									Browse… <input type="file" id="csv" class="browse-file" accept="text/csv" name="csv">
								</span>
							</span>
							<input type="text" class="form-control file-text" readonly="">
						</div>

						<br>
						
						{{ Form::button("<span class='glyphicon glyphicon-download'></span> Import",
									array("class" => "btn btn-primary btn-block","type" => "submit")
								)
							}}

					{{ Form::close() }}

		    	</fieldset>
		    </div>
		    <div class="col-md-8">
		    	<fieldset>
		    		<legend class="text-center">Teaching Assistants Availability</legend>
		    		@if (Session::get('remind_success'))
		    			<div>
							<div class="alert alert-success text-center">
								{{ Session::get('remind_success') }}
							</div>
						</div>
		    		@endif
		    		<table class="table table-striped">
		    			<thead>
		    				<tr>
		    					<th class="text-center">Name</th>
		    					<th class="text-center">Last Updated</th>
		    					<th class="text-center">Action</th>
		    				</tr>
		    			</thead>
		    			<tbody>
		    				<tr>
		    					<td></td>
		    					<td></td>
		    					<td>
		    						{{ Form::open(["url" => "admin/availability/remind", "role" => "form"]) }}
										{{ Form::button("<span class='glyphicon glyphicon-envelope'></span> Remind All",
											array("class" => "btn btn-info btn-block","type"=>"submit")) 
										}}
									{{ Form::close() }}
		    					</td>
		    				</tr>
		    				@foreach ($tas as $ta)
		    					<tr>
		    						<td class="text-center">{{ $ta->name }}</td>
				    				<td class="text-center">
				    				@if ($ta->availability_updated_at)
				    					{{ date("F dS, Y",strtotime($ta->availability_updated_at)) }}
				    				@else
				    					<span class='text-danger glyphicon glyphicon-lg glyphicon-minus-sign'></span>
				    				@endif
				    				</td>
				    				<td class="text-center">
				    					{{ Form::open(["url" => "admin/availability/remind", "role" => "form"]) }}
				    						{{ Form::hidden('ta_id',$ta->id) }}
				    						{{ Form::button("<span class='glyphicon glyphicon-envelope'></span> Remind",
				    							array("class" => "btn btn-warning btn-block","type"=>"submit")) 
				    						}}
		    							{{ Form::close() }}
				    				</td>
				    			</tr>
				    		@endforeach
		    			</tbody>
		    		</table>
		    	</fieldset>
		    </div>
		</div>
	</div>
@stop