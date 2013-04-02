<!-- <div class="btn-toolbar clearfix">
	<div class="btn-group pull-right" data-toggle="buttons-checkbox">
	  <button type="button" class="btn" name="" id="" disabled><strong>Filter &raquo;</strong></button>
	  <button type="button" class="btn btn-primary">In storage</button>
	  <button type="button" class="btn btn-primary">Delivered</button>
	  <button type="button" class="btn btn-primary">Blocked</button>
	</div>
</div> -->

<table class="table table-striped table-bordered">
<thead>
	<tr>
		<th>Pallet ID</th>
		<th>Cookie</th>
		<th>Produced</th>
		<th class="center-column">Status</th>
	</tr>
</thead>	
<tbody>
{{#pallets}}
		<tr>
			<td><a href="#">{{pallet_id}}</a></td>
			<td>{{cookie}}</td>
			<td>{{produced}}</td>
			<td class="center-column"><span class="label label-{{getStatus.label}}">{{getStatus.title}}</span></td>
		</tr>
{{/pallets}}
</tbody>
</table>

{{{pallets_paginator}}}


<h2>Produce new pallets</h2>
<form action="/pallets" method="post" class="form-horizontal well">
	<fieldset>
	<div class="control-group">
		<label class="control-label required" for="cookie">Product</label>
		<div class="controls">
			<select class="span3" name="cookies" id="cookie" required>
				{{#cookies}}
				<option value="{{cookie}}">{{cookie}}</option>
				{{/cookies}}
			</select>
			<span class="help-block">Please enter a type of cookie.</span>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label required" for="amount">Amount</label>
		<div class="controls">
			<input type="number" class="span3" name="amount" id="amount" min="1" max="100" placeholder="amount" required />
			<span class="help-block">Enter the amount of pallets to produce.</span>
		</div>

	</div>
	<div class="controls">
			<input type="submit" class="btn btn-primary" value="Produce" />
	</div>
	</fieldset>
</form>
