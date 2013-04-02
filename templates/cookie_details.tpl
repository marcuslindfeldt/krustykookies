
<table class="table table-striped table-bordered">
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

<ul class="pager">
  <li class="previous">
    <a href="/cookies">&larr; Back to products</a>
  </li>
</ul>