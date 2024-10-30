
<div id="open-modal" class="modal-window">
  <div>
    <a href="#" title="Close" class="modal-close"><i class="fas fa-times" style="font-size:20px;margin:15px;cursor:pointer"></i></a>

    <div class="user-profile" style="text-align:center;">
      <i class="fas fa-user-circle" style="color:#281859;font-size:85px;margin:auto;"></i>
      <p style="text-align:center;"><small>Please identify yourself</small></p>
    </div>

    <!-- <div class="col-md-10">
      <form action="#">

      </form>
    </div> -->

    <div class="col-md-12" style="padding:10px">
		<div class="login-box-body dg-user-header">
			<p class="login-box-msg" style="text-align:center;color:#281859;">Sign in to start your session</p>
			<div class="alert alert-danger" role="alert" id="error" style="display:none;"></div>
			<div class="form-group has-feedback">
				<span class="glyphicon glyphicon-envelope form-control-feedback dg-logicon"></span>
				<input type="text" class=" dg-textbox" value=""  name="email" placeholder="Email" id="email" title="Username" autocomplete="off">
			</div>
		<div class="form-group has-feedback">
			<span class="glyphicon glyphicon-lock form-control-feedback dg-logicon"></span>
			<input type="password" class=" dg-textbox" value="" title="Password"  name="password" placeholder="Password" id="pass">
		</div>
 
		<div class="dg-login-content">
			<div class="col-xs-12" style="text-align: right;">
				<button type="button" id="Login" class="dg-btn dg-login-btn" onclick="login_user(event)">Login</button>
			</div>
			<!-- /.col -->
		</div>  
		<div class="dg-login-content">
			<div class="col-xs-12">
				<a href="signup.php" class="dg-new-user" style="float:left;text-decoration: none;">Register</a>
				<a href="forget_pass.php" class="text-center" style="float:right;text-decoration: none;">Forgot Password</a>
			<div class="clearfix"></div>	
		</div><!-- /.col -->
	</div>    
					       
	</div>
</div>
    
  </div>
</div>

<script src="./js/jquery.min.js"></script>
<script>
		function login_user(e){
            e.preventDefault();
            var email = ($('#email').val()).toLowerCase();   
            var pass = $('#pass').val();
            $.ajax({
                    url: "php/logincheck.php",
                    type: "POST",
                    data: {
                        email: email,
                        pass: pass
                    },
                    success: function(dataResult){
                        if (dataResult == 1) {
                            window.location.replace("index.php");
                        } else{
                            $("#error").show();
                            $('#error').html(dataResult);
                        }
                    }
                });
        }
	</script>