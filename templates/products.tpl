<table>
<thead>
	<tr>
		<th>Cookie</th>
		<th>Description</th>
		<th></th>
	</tr>
</thead>	
<tbody>
{{#cookies}}
		<tr>
			<td>{{cookie}}</td>
			<td>{{getDescription}}</td>
			<td><a href="/products/{{getId}}">Details</a></td>
		</tr>
{{/cookies}}
</tbody>
</table>
<br />
<form action="/products">
	<fieldset>
		<legend>New product</legend>
	<ul>
		<li>
			<label for="cookie">Name</label>
			<input type="text" name="cookie" id="cookie" />
		</li>
		<li>
			<table>
				<thead>
					<tr>
						<th>Ingredient</th>
						<th>Quantity (grams)</th>
					</tr>
				</thead>
				<tbody>
					<tr class="ingredient">
						<td>
							<select name="ingredient[]">
							{{#ingredients}}
								<option value="{{ingredient}}">{{ingredient}}</option>
							{{/ingredients}}
							</select>
						</td>
						<td>
							<input type="number" min="1" value="1">
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td colspan="3"><a href="#" id="new-ingredient">Add another ingredient</a></td>	
					</tr>
				</tbody>
			</table>
		</li>
		<li>
			<input type="submit" value="Submit" />
		</li>
	</ul>
	</fieldset>
</form>

<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="/js/mustache.js"></script>
<script type="text/template" id ="ingredient-field">
<tr class="ingredient">
	<td>
		<select name="ingredient[]" >
		{{#ingredients}}
			<option value="{{ingredient}}">{{ingredient}}</option>
		{{/ingredients}}
		</select>
	</td>
	<td>
		<input type="number" min="1" value="1">
	</td>
	<td>
		<a href="#" class="delete">[x]</a>
	</td>
</tr>
<tr>
</script> 
<script type="text/javascript">
(function(){

	template = $('#ingredient-field').html();

	$('#new-ingredient').on('click', function(e){
		e.preventDefault();
		html = Mustache.render(template);
		$(this).closest('tr').before(html);
	});

	$(document).on('click', 'a.delete', function(e){
		e.preventDefault();
		$(this).closest('tr').remove();
	});
})();
</script>