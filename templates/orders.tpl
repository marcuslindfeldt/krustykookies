<table>
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
			<td><a href="/orders/{{order_id}}">Details</a></td>
		</tr>
{{/orders}}
</tbody>
</table>