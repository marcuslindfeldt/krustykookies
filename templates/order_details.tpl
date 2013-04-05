<table class="table  table-bordered">
<tbody>
	<tr>
		<th colspan="2">Order information</th>
	</tr>
	<tr>
		<th class="muted">Order id</th>
		<td>#{{order.order_id}}</td>
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
		<td>
			<span class="label label-{{order.getStatus.label}}">
				{{order.getStatus.title}}
			</span>
		</td>
	</tr>
	<tr>
		<th class="muted">Created</th>
		<td>{{order.created}}</td>
	</tr>
</tbody>
<tbody>
	<tr>
		<th colspan="2">Ordered Cookies {{#order.delivered}}<small><a href="/pallets?order_id={{order.order_id}}">track pallets</a></small>{{/order.delivered}}</th>
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
		<td><a href="/pallets?cookie={{cookie}}&order_id={{order.order_id}}">{{quantity}}</a></td>
	</tr>
{{/pallets}}
</tbody>
</table>
<form action="" method="post">
	<button type="submit" class="btn btn-success pull-right" {{#order.delivered}}disabled{{/order.delivered}}>Deliver order!</button>
	
</form>

<ul class="pager">
  <li class="previous">
    <a href="/orders">&larr; Back to orders</a>
  </li>
</ul>