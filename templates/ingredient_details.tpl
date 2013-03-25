<table>
<thead>
	<tr>
		<th>Ingredient</th>
		<th>Quantity</th>
		<th>Last delivery date</th>
		<th>Last delivery amount</th>
	</tr>
</thead>	
<tbody>
{{#ingredients}}
		<tr>
			<td>{{ingredient}}</td>
			<td>{{quantity}}</td>
			<td>{{modified}}</td>
			<td>{{lastAddition}}</td>
		</tr>
{{/ingredients}}
</tbody>
</table>
<br />