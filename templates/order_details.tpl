<table class="table  table-bordered">
<tbody>
	<tr>
		<th colspan="2">Order information</th>
	</tr>
	<tr>
		<th class="muted">Order id</th>
		<td>{{order.order_id}}</td>
	</tr>
	<tr>
		<th class="muted">Delivery date</th>
		<td>{{order.deadline}}</td>
	</tr>
	<tr>
		<th class="muted">Customer</th>
		<td>{{{order.customer}}}</td>
	</tr>
		<tr>
		<th class="muted">Status</th>
		<td><span class="label label-success">Delivered</span></td>
	</tr>
</tbody>
<tbody>
	<tr>
		<th colspan="2">Ordered Cookies</th>
	</tr>
	<tr>
		<th class="muted">Name</th>
		<th class="muted">Quantity</th>
	</tr>
</tbody>	
<tbody>
{{#pallets}}
	<tr>
		<td>{{{cookie}}}</td>
		<td>{{quantity}}</td>
	</tr>
{{/pallets}}
</tbody>
</table>

<ul class="pager">
  <li class="previous">
    <a href="/orders">&larr; Back to orders</a>
  </li>
</ul>