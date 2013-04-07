<table class="table table-bordered">
<tbody>
	<tr>
		<th colspan="2">Pallet information</th>
	</tr>
	<tr>
		<th class="muted">Pallet id</th>
		<td>#{{pallet.pallet_id}}</td>
	</tr>
	<tr>
		<th class="muted">Contents</th>
		<td>{{pallet.cookie}}</td>
	</tr>
	<tr>
		<th class="muted">Produced</th>
		<td>{{pallet.produced}}</td>
	</tr>
	<tr>
		<th class="muted">Status</th>
		<td>
			<span class="label label-{{pallet.getStatus.label}}">
				{{pallet.getStatus.title}}
			</span>
		</td>
	</tr>
	{{#pallet.order_id}}
	<tr>
		<th class="muted">Customer</th>
		<td>{{pallet.customer}}</td>
	</tr>
	<tr>
		<th class="muted">Part of order</th>
		<td><a href="/orders/{{pallet.order_id}}">#{{{pallet.order_id}}}</a></td>
	</tr>
	<tr>
		<th class="muted">Delivered at</th>
		<td>{{pallet.delivered}}</td>
	</tr>
	{{/pallet.order_id}}
</tbody>
</table>


<ul class="pager">
  <li class="previous">
    <a href="{{prev_page}}">&larr; Back</a>
  </li>
</ul>