<table>
<thead>
	<tr>
		<th>Ingredient</th>
		<th>Quantity</th>
		<th>Modified</th>
		<th>Last addition</th>
	</tr>
</thead>	
<tbody>
{{#ingredients}}
		<tr>
			<td>{{ingredient}}</td>
			<td>{{quantity}}</td>
			<td>{{modified}}</td>
			<td style="padding: 20px;">{{lastAddition}}</td>
		</tr>
{{/ingredients}}
</tbody>
</table>
<br />