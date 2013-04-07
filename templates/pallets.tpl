
<form method="get" class="clearfix row-fluid form-inline">	

	<input type="text" name="start" id="rangeStart" class="span3" placeholder="DD/MM/YYYY" value="{{filters.start}}" /> 
	<input type="text" name="end" id="rangeEnd" class="span3" placeholder="DD/MM/YYYY" value="{{filters.end}}" /> 
	<select name="cookie" class="span2">
		<option value="">-- Cookie --</option>
		{{#cookies}}
		<option {{selected}} value="{{name}}">{{name}}</option>
		{{/cookies}}
	</select>    
	<select name="status" id="status" class="span2">
		<option value="">-- Status --</option>
		<option value="blocked">Blocked</option>
		<option value="in-storage">In storage</option>
		<option value="delivered">Delivered</option>
	</select>
	
	

<div class="btn-group pull-right">
  <button type="submit" class="btn">Filter</button>
  <button class="btn dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <!-- dropdown menu links -->
    <li><a href="/pallets">Reset</a></li>
  </ul>
</div>


</form>


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
			<td><a href="/pallets/{{pallet_id}}">#{{pallet_id}}</a></td>
			<td>{{cookie}}</td>
			<td>{{produced}}</td>
			<td class="center-column"><span class="label label-{{getStatus.label}}">{{getStatus.title}}</span></td>
		</tr>
{{/pallets}}
{{^pallets.getNbPages}}
		<tr>
			<td colspan="4">No results :(</td>
		</tr>
{{/pallets.getNbPages}}
</tbody>
</table>
<span class="input-small uneditable-input pull-right">#Results: {{pallets.getNbResults}}</span>
{{#pallets.getNbPages}}
{{{pallets_paginator}}}
{{/pallets.getNbPages}}


<h2>Produce new pallets</h2>
<form action="/pallets" method="post" class="form-horizontal well">
	<fieldset>
	<div class="control-group">
		<label class="control-label required" for="cookie">Product</label>
		<div class="controls">
			<select class="span3" name="cookies" id="cookie" required>
				{{#cookies}}
				<option value="{{name}}">{{name}}</option>
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
