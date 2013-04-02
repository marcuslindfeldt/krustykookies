<table class="table table-striped table-bordered">
<thead>
	<tr>
		<th>Cookie</th>
		<th>Description</th>
		<th></th>
	</tr>
</thead>	
<tbody>
{{#cookies}}
		<tr>
			<td>{{cookie}}</td>
			<td>{{getDescription}}</td>
			<td class="center-column"><a class="label label-info" href="/cookies/{{getId}}">Recipie</a></td>
		</tr>
{{/cookies}}
</tbody>
</table>
<br />
<h2>Create a new product</h2>
<form action="/cookies" method="post" class="form-horizontal">
	<fieldset>
		<legend>Product details</legend>
		<div class="control-group">
			<label class="control-label required" for="name">Name</label>
			<div class="controls">
				<input type="text" name="name" id="name" required />
				<span class="help-block">Choose a name for your product</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="description">Description</label>
			<div class="controls">
				<input type="text" name="description" id="description" />
				<span class="help-block">Optional</span>
			</div>
		</div>
	</fieldset>
	<fieldset>
	<legend>Ingredients</legend>		
	{{#ingredients}}
		<div class="control-group">
			<label class="control-label" for="ingredients[{{ingredient}}]">{{ingredient}}</label>
			<div class="controls">
				<input type="number" name ="ingredients[{{ingredient}}]" id="ingredients[{{ingredient}}]" min="0" value="0">
			</div>
		</div>
	{{/ingredients}}
	</fieldset>
	<div class="form-actions">
		<input type="submit" class="btn btn-primary" value="Create" />
		<input type="reset" class="btn" value="Reset" />
	</div>
</form>

<h2>Temporarily blocked products</h2>
<table id="block-table" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Product</th>
      <th>Block start date</th>
      <th>Block release date</th>
      <th class="center-column">Release block</th>
    </tr>
  </thead>
  <tbody>
    {{#blocked}}
    <tr>
      <td>{{cookie}}</td>
      <td>{{start}}</td>
      <td>{{end}}</td>
      <td class="center-column">
      	<button class="unblock btn btn-inverse" value="{{cookie}}">Unblock</button>
      </td>
    </tr>
    {{/blocked}}
    {{^blocked}}
      <tr>
        <td colspan="4">No cookies have been blocked yet! :)</td>
      </tr>
    {{/blocked}}
  </tbody>
</table>

<form action="/blocked" method="post" class="form-horizontal well">
	<fieldset>
		<legend>Create a new block</legend>
		<div class="control-group">
			<label class="control-label required" for="cookie">Product</label>
			<div class="controls">
				<select name="cookie" id="cookie" required>
					{{#cookies}}
					<option value="{{cookie}}">{{cookie}}</option>
					{{/cookies}}
				</select>                 
			</div>
		</div>	
		<div class="control-group">
			<label class="control-label required" for="end">Block release date</label>
			<div class="controls">
				<input type="text" name="end" id="end" placeholder="DD/MM/YYYY" required />
			</div>
		</div>
		<div class="controls">
			<input type="submit" class="btn btn-danger" value="Block now" />
		</div>
	</fieldset>
</form>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" 
        type="text/javascript"></script>
<script type="text/javascript">
(function(){
  var date = new Date();
  date.setDate(date.getDate()+1);
  $( "#end" ).datepicker({ 
    dateFormat: 'yy-mm-dd',
    minDate: date
  });
})(); 
</script>