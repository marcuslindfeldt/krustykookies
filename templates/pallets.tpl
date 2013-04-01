<table class="table table-striped table-bordered">
<thead>
	<tr>
		<th>Pallet Id</th>
		<th>Order Id</th>
		<th>Cookie</th>
		<th>Produced</th>
		<th>Customer</th>
		<th>Delivered</th>
		<th>Location</th>
	</tr>
</thead>	
<tbody>
{{#pallets}}
		<tr>
			<td>{{pallet_id}}</td>
			<td>{{order_id}}</td>
			<td>{{cookie}}</td>
			<td>{{produced}}</td>
			<td>{{customer}}</td>
			<td></td>
			<td></td>
		</tr>
{{/pallets}}
</tbody>
</table>

<h2>Produce new pallets</h2>
<form action="/pallets" method="post" class="form-horizontal well">
	<fieldset>
	<div class="control-group">
		<label class="control-label" for="inputEmail">Product</label>
		<div class="controls">
			<select class="span3" name="cookies" id="cookies" required>
				{{#cookies}}
				<option value="{{cookie}}">{{cookie}}</option>
				{{/cookies}}
			</select>
			<span class="help-block">Please enter a type of cookie.</span>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="inputEmail">Amount</label>
		<div class="controls">
			<input type="number" class="span3" name="amount" min="1" max="100" placeholder="amount" required />
			<span class="help-block">Enter the amount of pallets to produce.</span>
		</div>

	</div>
	<div class="controls">
			<input type="submit" class="btn btn-primary" value="Produce" />
	</div>
	</fieldset>
</form>
