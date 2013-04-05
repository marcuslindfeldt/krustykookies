<table class="table table-striped table-bordered">
<thead>
	<tr>
		<th>Ingredient</th>
		<th>Quantity in storage</th>
		<th>Last used</th>
		<th>Last withdrawal</th>
	</tr>
</thead>	
<tbody>
{{#ingredients}}
		<tr>
			<td>{{ingredient}}</td>
			<td>{{quantity}} g</td>
			<td>{{modified}}</td>
			<td>{{latest_withdrawal}} g</td>
		</tr>
{{/ingredients}}
</tbody>
</table>
{{{ingredients_paginator}}}

<h2>Refill ingredients</h2>
<form action="/ingredients" method="post" class="form-horizontal well">
	<fieldset>
	<div class="control-group">
		<label class="control-label required" for="ingredient">Ingredient</label>
		<div class="controls">
			<select class="span3" name="ingredient" id="ingredient" required>
				{{#ingredients.getAdapter.getArray}}
				<option value="{{ingredient}}">{{ingredient}}</option>
				{{/ingredients.getAdapter.getArray}}
			</select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label required" for="quantity">Quantity</label>
		<div class="controls">
			<input type="number" class="span3" name="quantity" id="quantity" min="1" placeholder="quantity" required />
		</div>

	</div>
	<div class="controls">
			<input type="submit" class="btn btn-primary" value="Refill" />
	</div>
	</fieldset>
</form>