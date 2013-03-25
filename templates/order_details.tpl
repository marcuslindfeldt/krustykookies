<p>Order id: {{order.order_id}}</p>
<p>Delivery date: {{order.deadline}}</p>
<p>Customer: {{{order.customer}}}</p>
<table>
<thead>
	<tr>
		<th>Quantity</th>
		<th>Cookie</th>
	</tr>
</thead>	
<tbody>
{{#pallets}}
	<tr>
		<td>{{quantity}}</td>
		<td>{{{cookie}}}</td>
	</tr>
{{/pallets}}
</tbody>
</table>