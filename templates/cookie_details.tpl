
<p>Cookie: {{{recipie.name}}}</p>
<table>
<thead>
	<tr>
		<th>Ingredient</th>
		<th>Quantity</th>
	</tr>
</thead>	
<tbody>
{{#recipie.ingredients}}
	<tr>
		<td>{{{ingredient}}}</td>
		<td>{{quantity}} g</td>
	</tr>
{{/recipie.ingredients}}
</tbody>
</table>