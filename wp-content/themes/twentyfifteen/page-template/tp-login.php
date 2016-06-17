<?php 
/*

Template Name: Login Page

*/
?>

<?php
get_header(); ?>

		<div class="container-fluid">
		
		
		<div class="row">	

			<div class="col-xs-6 col-md-8">
					
				<div class="login-form">
					<div class="login-error"></div>
				</div>
				
				<form id="foundanimallogin" name="foundanimallogin"  method="post">
					<input type="hidden" name="action" value="found_animal_login_action">
					<h2>Login</h2>
					
					<div class="form-group">
					<label>Email Address</label>
					<input type="text" name="emailaddress" value="" placeholder="Enter email" class="form-control">
					</div>
					
					<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" value="" placeholder="Enter password" class="form-control">
					</div>
					
					<div class="form-group">
					<input type="submit" value="Login" name="login" class="btn btn-primary">
					</div>
				</form>
			</div>
		</div>	
		
	</div><!-- .content-area -->

<?php get_footer(); ?>
