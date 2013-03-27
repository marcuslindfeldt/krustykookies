<table>
  <thead>
    <tr>
      <th>Cookie</th>
      <th>Block start date</th>
      <th>Block release date</th>
    </tr>
  </thead>
  <tbody>
    {{#blocked}}
    <tr>
      <td>{{cookie}}</td>
      <td>{{start}}</td>
      <td>{{end}}</td>
    </tr>
    {{/blocked}}
    {{^blocked}}
      <tr>
        <td colspan="3">No cookies have been blocked yet! :)</td>
      </tr>
    {{/blocked}}
  </tbody>
</table>


<form action="/blocked" method="POST">
   <ul>
      <li>
         <label for="cookie">Cookie</label>
         <select name="cookie" id="cookie" required>
               {{#cookies}}
               <option value="{{cookie}}">{{cookie}}</option>
               {{/cookies}}
         </select>                 
      </li>
      <li>
         <label for="end">Block release date</label>
         <input type="text" name="end" id="end" placeholder="DD/MM/YYYY" required />
      </li>
      <li>
         <input type="submit" value="Block now" />
      </li>
   </ul>
   <br>
</form>

{{#flash}}
  <p>{{flash.getMessages.response_msg}}</p>
{{/flash}}

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js" 
        type="text/javascript"></script>
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