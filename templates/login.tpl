<div class="container">

  <form class="form-horizontal form-signin" id="login" action="/login" method="post">
    <h2 class="form-signin-heading">Please sign in</h2>
		
		<div class="input-prepend">
		  	<button type="button" class="btn btn-warning"><i class="icon-user icon-white"></i></button>
			<input type="text" class="input-block-level" name="username" placeholder="Username" required>
		</div>

		<div class="input-prepend">
		  	<button type="button" class="btn btn-warning"><i class="icon-lock icon-white"></i></button>
		    <input type="password" class="input-block-level"name="password" placeholder="Password" required>
		</div>

    <button class="btn btn-large btn-primary" type="submit">Sign in</button>
  </form>

</div> <!-- /container -->

<script type="text/javascript">
	$(document).ready(function(){
		$('#login').find('button[type=button]').on('click', function(){
			$(this).next().focus().select();
		});
	});
</script>