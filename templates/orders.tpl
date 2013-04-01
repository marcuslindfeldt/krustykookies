<table class="table table-striped table-bordered">
<thead>
	<tr>
		<th>Order ID</th>
		<th>Delivery date</th>
		<th>Customer</th>
		<th></th>
	</tr>
</thead>	
<tbody>
{{#orders}}
		<tr>
			<td>{{order_id}}</td>
			<td>{{deadline}}</td>
			<td>{{{customer}}}</td>
			<td class="center-column"><a class="label label-info" href="/orders/{{order_id}}">Details</a></td>

		</tr>
{{/orders}}
</tbody>
</table>