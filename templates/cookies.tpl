<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Cookie</th>
			<th>Description</th>
			<th class="center-column">In storage</th>
		</tr>
	</thead>	
	<tbody>
		{{#cookies}}
		<tr>
			<td>
				{{#isBlocked}}
				<span class="label label-important pull-right">Blocked</span>
				{{/isBlocked}}
				<a href="/cookies/{{getId}}">{{cookie}}</a>
			</td>
			<td>{{getDescription}}</td>
			<td class="center-column">
				{{#inStorage}}
				<a href="/pallets?cookie={{getId}}">{{in_store}}</a>
				{{/inStorage}}
				{{^inStorage}}
				<span class="label label-warning">Sold out!</span>
				{{/inStorage}}
			</td>
		</tr>
		{{/cookies}}
	</tbody>
</table>
<br />
<h2>Create a new product</h2>
<form action="/cookies" method="post" class="form-horizontal">
	<fieldset>
		<legend>Product details</legend>
		<div class="control-group">
			<label class="control-label required" for="name">Name</label>
			<div class="controls">
				<input type="text" name="name" id="name" required />
				<span class="help-block">Choose a name for your product</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="description">Description</label>
			<div class="controls">
				<input type="text" name="description" id="description" />
				<span class="help-block">Optional</span>
			</div>
		</div>
	</fieldset>
	<fieldset>
		<legend>Ingredients</legend>		
		{{#ingredients}}
		<div class="control-group">
			<label class="control-label" for="ingredients[{{ingredient}}]">{{ingredient}}</label>
			<div class="controls">
				<input type="number" name ="ingredients[{{ingredient}}]" id="ingredients[{{ingredient}}]" min="0" value="0">
			</div>
		</div>
		{{/ingredients}}
	</fieldset>
	<div class="form-actions">
		<input type="submit" class="btn btn-primary" value="Create" />
		<input type="reset" class="btn" value="Reset" />
	</div>
</form>

<h2>Blocked products</h2>

<table id="block-table" class="table table-bordered">
	<thead>
		<tr class="alert-danger">
			<th colspan="4">
				<strong>Current blocks</strong>
			</th>
		</tr>
		<tr>
			<th>Product</th>
			<th>Block start date</th>
			<th>Block release date</th>
			<th class="center-column">Blocked pallets</th>
		</tr>
	</thead>
	<tbody>
		{{#blocks}}
		<tr>
			<td>{{cookie}}</td>
			<td>{{start}}</td>
			<td>{{end}}</td>
			<td class="center-column">
				<a href="/pallets?start={{start}}&end={{end}}&cookie={{cookie}}&status=blocked">view</a>
			</td>
		</tr>
		{{/blocks}}
		{{^blocks}}
		<tr>
			<td colspan="4">No results :(</td>
		</tr>
		{{/blocks}}
	</tbody>
</table>

<table class="table table-bordered">
	<thead>
		<tr class="alert-danger">
			<th colspan="3">
				<strong>Upcoming blocks</strong>
			</th>
		</tr>
		<tr>
			<th>Product</th>
			<th>Block start date</th>
			<th>Block release date</th>
		</tr>
	</thead>
	<tbody>
		{{#next_blocks}}
		<tr>
			<td>{{cookie}}</td>
			<td>{{start}}</td>
			<td>{{end}}</td>
		</tr>
		{{/next_blocks}}
		{{^next_blocks}}
		<tr>
			<td colspan="4">No results :(</td>
		</tr>
		{{/next_blocks}}
	</tbody>
 </table>

<table id="block-table" class="table table-striped table-bordered">
  <thead>
	<tr class="alert-danger">
		<th colspan="3">
			<strong>Previous blocks</strong>
		</th>
	</tr>
<tr>
	<th>Product</th>
	<th>Block start date</th>
	<th>Block release date</th>
</tr>
</thead>
<tbody>
	{{#prev_blocks}}
	<tr>
		<td>{{cookie}}</td>
		<td>{{start}}</td>
		<td>{{end}}</td>
	</tr>
	{{/prev_blocks}}
	{{^prev_blocks}}
	<tr>
		<td colspan="4">No results :(</td>
	</tr>
	{{/prev_blocks}}
</tbody>
</table>

<form action="/blocked" method="post" class="form-horizontal well">
	<fieldset>
		<legend>Create a new block</legend>
		<div class="control-group">
			<label class="control-label required" for="cookie">Product</label>
			<div class="controls">
				<select name="cookie" id="cookie" required>
					{{#cookies}}
					<option value="{{cookie}}">{{cookie}}</option>
					{{/cookies}}
				</select>                 
			</div>
		</div>	
		<div class="control-group">
			<label class="control-label required" for="rangeStart">Block start date</label>
			<div class="controls">
				<input type="text" name="start" id="rangeStart" class="min-date-tomorrow" placeholder="DD/MM/YYYY" required />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label required" for="rangeEnd">Block release date</label>
			<div class="controls">
				<input type="text" name="end" id="rangeEnd" placeholder="DD/MM/YYYY" required />
			</div>
		</div>
		<div class="controls">
			<input type="submit" class="btn btn-danger" value="Block now" />
		</div>
	</fieldset>
</form>
