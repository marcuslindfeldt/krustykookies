<div class="container">

  <form class="form-horizontal form-signin" id="login" action="/login" method="post">
    <h2 class="form-signin-heading">Please sign in</h2>
		
		<div class="input-prepend">
		  	<button type="button" class="btn btn-warning"><i class="icon-user icon-white"></i></button>
			<input type="text" class="input-block-level" name="username" placeholder="Username" tabindex="1" required autofocus>
		</div>

		<div class="input-prepend">
		  	<button type="button" class="btn btn-warning"><i class="icon-lock icon-white"></i></button>
		    <input type="password" class="input-block-level"name="password" placeholder="Password" tabindex="2" required>
		</div>

    <button class="btn btn-large btn-primary" type="submit" tabindex="3">Sign in</button>
  </form>

</div> <!-- /container -->