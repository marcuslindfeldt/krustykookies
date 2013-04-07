
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
		<td>{{{ingredient}}}</td>
		<td>{{quantity}} g</td>
	</tr>
{{/recipe.ingredients}}
</tbody>
</table>

<a class="btn btn-primary pull-right" href="/cookies/{{recipe.name}}/edit">Edit</a>

<ul class="pager">
  <li class="previous">
    <a href="/cookies">&larr; Back to products</a>
  </li>
</ul>
