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
			<td><a href="/cookies/{{getId}}">Details</a></td>
		</tr>
{{/cookies}}
</tbody>
</table>
<br />

{{#flash.getMessages.error}}
<p>{{flash.getMessages.error}}</p>
{{/flash.getMessages.error}}
{{#flash.getMessages.success}}
<p>{{flash.getMessages.success}}</p>
{{/flash.getMessages.success}}
<form action="/cookies" method="post">
	<fieldset>
		<legend>New cookie</legend>
	<ul>
		<li>
			<label for="name">Name</label>
			<input type="text" name="name" required />
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
					{{#ingredients}}
					<tr class="ingredient">
						<td>
							{{ingredient}}
						</td>
						<td>
							<input type="number" name ="ingredients[{{ingredient}}]" min="0" value="0">
						</td>
						<td>
						</td>
					</tr>
					{{/ingredients}}
				</tbody>
			</table>
		</li>
		<li>
			<input type="submit" value="Submit" />
		</li>
	</ul>
	</fieldset>
</form>