<p>Block cookies:</p><hr>
<form action='/unblock' method='POST'>
{{#blocks}}
	<p><dd>
	{{{cookie}}}
	<br>
	{{{start}}}
	<br>
	{{{end}}}
	<br>
	<input type="hidden" name="blocked_id" value="{{blocked_id}}">
	<input type="submit" value="Unblock now"/>
	</p></dd><hr>
{{/blocks}}
</form>