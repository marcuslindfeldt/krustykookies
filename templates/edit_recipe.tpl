<form method="post">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Ingredient</th>
				<th>Quantity</th>
			</tr>
		</thead>	
		<tbody>
			{{#recipe.ingredients}}
			<tr>
				<td><label for="{{ingredient}}">{{ingredient}}</label></td>
				<td><input type="number" name="ingredients[{{ingredient}}]" id="{{ingredient}}" value="{{quantity}}" /></td>
			</tr>
			{{/recipe.ingredients}}
		</tbody>
	</table>
	<div class="form-actions">
		
		<input type="submit" class="btn btn-primary" value="Update">
		<a class="btn" href="/cookies/{{recipe.name}}">Cancel</a>
	</form>
</div>