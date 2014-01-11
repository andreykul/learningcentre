@extends("layout")
@section("content")
    <div class="col-md-12">
    	<div class="row">
    		<div class="col-md-6">
    			<fieldset>
    				<legend>Hours Break Down</legend>
    			</fieldset>
    			
    			<div class="accordion">
    				<h3>Week 2 : Jan 12th - Jan 18th</h3>
					<div>
						<p>Monday, Jan 13th : 10:00 - 12:30 : 2.5 hours</p>
						<p>Total: 2.5 hours</p>
					</div>

    				<h3>Week 1 : Jan 5th - Jan 11th</h3>
					<div>
						<p>Monday, Jan 6th : 10:00 - 12:30 : 2.5 hours</p>
						<p>Thursday, Jan 9th : 10:00 - 12:30 : 2.5 hours</p>
						<p>Total: 5 hours</p>
					</div>
					
    			</div>
    		</div>
    		<div class="col-md-4 col-md-offset-2">
    			<fieldset>
    				<legend>Hours Summary</legend>
    			</fieldset>
    			<table class="table">
    				<thead>
    					<tr>
    						<th>Description</th><th class="text-center">Value</th>
    					</tr>
    				</thead>
    				<tbody>
    					<tr>
    						<td>Hours this week:</td><td class="text-center">2.5</td>
    					</tr>
    					<tr>
    						<td>Total Hours:</td><td class="text-center">7.5</td>
    					</tr>
    					<tr>
    						<td>Hours submitted:</td><td class="text-center">0</td>
    					</tr>
    					<tr>
    						<td>Hours Paid:</td><td class="text-center">0</td>
    					</tr>
    				</tbody>
    			</table>
    		</div>
    	</div>
    </div>
    <script>
    	$('.accordion').accordion({collapsible: true,heightStyle: "content"});
    </script>
@stop