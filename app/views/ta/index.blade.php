@extends("layout")
@section("content")
    <div class="col-md-12">
    	<div class="row">
    		<div class="col-md-6">
    			<fieldset>
    				<legend class="text-center">Hours Break Down</legend>
    			</fieldset>
    			
    			<div class="accordion">
    				<h3>Week 5 : Feb 2nd - Feb 8th</h3>
					<div>
						<p>Monday, Jan 20th : 10:00 - 12:30 : 2.5 hours</p>
						<p>Thursday, Jan 23th : 10:00 - 12:30 : 2.5 hours</p>
						<p>Total: 5 hours</p>
						<button class="btn btn-primary">Submit Timesheet</button>
					</div>
    				<h3>
    					Week 4 : Jan 26th - Feb 1st
    					<span class="col-md-2 pull-right label label-success" >Submitted</span>
    				</h3>
					<div>
						<p>Monday, Jan 20th : 10:00 - 12:30 : 2.5 hours</p>
						<p>Thursday, Jan 23th : 10:00 - 12:30 : 2.5 hours</p>
						<p>Total: 5 hours</p>
						<button class="btn btn-primary">View Timesheet</button>
					</div>
    				<h3>
    					Week 3 : Jan 19th - Jan 25th
    					<span class="col-md-2 pull-right label label-danger" >Disapproved</span>
    				</h3>
					<div>
						<p>Monday, Jan 20th : 10:00 - 12:30 : 2.5 hours</p>
						<p>Thursday, Jan 23th : 10:00 - 12:30 : 2.5 hours</p>
						<p>Total: 5 hours</p>
					</div>

    				<h3>
    					Week 2 : Jan 12th - Jan 18th
    					<span class="col-md-2 pull-right label label-warning">Approved</span>
    				</h3>
					<div>
						<p>Monday, Jan 13th : 10:00 - 12:30 : 2.5 hours</p>
						<p>Total: 2.5 hours</p>
					</div>

    				<h3>
    					Week 1 : Jan 5th - Jan 11th
    					<span class="col-md-2 pull-right label label-warning">Approved</span>
    				</h3>
					<div>
						<p>Monday, Jan 6th : 10:00 - 12:30 : 2.5 hours</p>
						<p>Thursday, Jan 9th : 10:00 - 12:30 : 2.5 hours</p>
						<p>Total: 5 hours</p>
					</div>
					
    			</div>
    		</div>
    		<div class="col-md-6">
    			<fieldset>
    				<legend class="text-center">Hours Summary</legend>
    			</fieldset>
    			<div class="col-md-6">
    				<table class="table">
	    				<thead>
	    					<tr>
	    						<th>Hours</th><th class="text-center">Amount</th>
	    					</tr>
	    				</thead>
	    				<tbody>
	    					<tr>
	    						<td>Worked this week:</td><td class="text-center">5</td>
	    					</tr>
	    					<tr>
	    						<td>Total Additional:</td><td class="text-center">2</td>
	    					</tr>
	    					<tr>
	    						<td>Total Worked:</td><td class="text-center">22.5</td>
	    					</tr>
	    					<tr>
	    						<td>Total:</td><td class="text-center">24.5</td>
	    					</tr>
	    				</tbody>
	    			</table>
    			</div>
    			<div class="col-md-6">
    				<table class="table">
	    				<thead>
	    					<tr>
	    						<th>Hours</th><th>Amount</th>
	    					</tr>
	    				</thead>
	    				<tbody>
	    					<tr>
	    						<td>Submitted:</td><td class="text-center">12.5</td>
	    					</tr>
	    					<tr>
	    						<td>Approved:</td><td class="text-center">7.5</td>
	    					</tr>
	    				</tbody>
	    			</table>
    			</div>
    		</div>
    	</div>
    </div>
    <script>
    	$('.accordion').accordion({header: "h3",collapsible: true,heightStyle: "content"});
    </script>
@stop