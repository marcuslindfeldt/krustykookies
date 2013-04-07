<form method="get" class="clearfix row-fluid form-inline">	
	<div class="btn-group pull-right">
		<button type="submit" class="btn">Filter</button>
		<button class="btn dropdown-toggle" data-toggle="dropdown">
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu">
			<!-- dropdown menu links -->
			<li><a href="/orders">Reset</a></li>
		</ul>
	</div>

	<input type="text" name="start" id="rangeStart" class="span3" placeholder="DD/MM/YYYY" value="{{filters.start}}" />
	<span class="hidden-phone">-</span>
	<input type="text" name="end" id="rangeEnd" class="span3" placeholder="DD/MM/YYYY" value="{{filters.end}}" /> 
	<span class="help-block hidden-phone">Delivery date time period</span>

</form>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Order ID</th>
			<th>Customer</th>
			<th>Delivery date</th>
			<th class="center-column">Status</th>
		</tr>
	</thead>	
	<tbody>
		{{#orders}}
		<tr>
			<td><a href="/orders/{{order_id}}">#{{order_id}}</a></td>
			<td>{{{customer}}}</td>
			<td>{{deadline}}</td>
			<td class="center-column"><a class="label label-{{getStatus.label}}" href="/orders/{{order_id}}">{{getStatus.title}}</a></td>

		</tr>
		{{/orders}}
	</tbody>
</table>

<h2>Create a new Order</h2>
<form action="/orders" method="post" class="form-horizontal">
	<fieldset>
		<legend>Order details</legend>
		<div class="control-group">
			<label class="control-label required" for="customer">Customer</label>
			<div class="controls">
				<select name="customer" id="customer" required>
					{{#customers}}
					<option value="{{{customer}}}">{{{customer}}}</option>
					{{/customers}}
				</select>                 
			</div>
		</div>	
		<div class="control-group">
			<label class="control-label required" for="deadline">Delivery date</label>
			<div class="controls">
				<input type="text" name="deadline" id="deadline" class="datepicker mindate" placeholder="DD/MM/YYYY" required />
			</div>
		</div>
	</fieldset>
	<fieldset>
		<legend>Products</legend>		
		{{#cookies}}
		<div class="control-group">
			<label class="control-label" for="cookies[{{name}}]">{{name}}</label>
			<div class="controls">
				<input type="number" name ="cookies[{{name}}]" id="cookies[{{name}}]" min="0" value="0">
			</div>
		</div>
		{{/cookies}}
	</fieldset>
	<div class="form-actions">
		<input type="submit" class="btn btn-primary" value="Create" />
		<input type="reset" class="btn" value="Reset" />
	</div>
</form>