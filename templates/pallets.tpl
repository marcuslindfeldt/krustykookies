<table>
<thead>
	<tr>
		<th>Pallet Id</th>
		<th>Order Id</th>
		<th>Cookie</th>
		<th>Produced</th>
		<th>Customer</th>
		<th>Delivered</th>
		<th>Location</th>
	</tr>
</thead>	
<tbody>
{{#pallets}}
		<tr>
			<td>{{pallet_id}}</td>
			<td>{{order_id}}</td>
			<td>{{cookie}}</td>
			<td>{{produced}}</td>
			<td>{{customer}}</td>
			<td></td>
			<td></td>
		</tr>
{{/pallets}}
</tbody>
</table>
<br />