<?php 
/*

Template Name: Register Page

*/
?>

<?php
get_header(); ?>

	<div class="container-fluid">
		
		<div class="customer-register-form">
			<div class="customer-error"></div>
		</div>
		
		<form id="foundanimalregister" name="foundanimalregister" method="post">
		
			<input type="hidden" name="action" value="netsuite_customer_register_action">
        
		<div class="row">	
		
					<div class="col-xs-6 col-md-4">
			 
						<legend>Customer Information :</legend>
						
						<div class="form-group">
						<label> First Name</label>
						<input type="text" name="firstname" value="" placeholder="Enter First Name" class="form-control">
						</div>
						
						<div class="form-group">
						<label> Last Name</label>
						<input type="text" name="lastname" value="" placeholder="Enter Last Name" class="form-control">
						</div>
						
						<div class="form-group">
						<label> Phone Number</label>
						<input type="text" name="phonenumber" value="" placeholder="Enter Phone Number" class="form-control">
						</div>
						
						<div class="form-group">
							<label> Email Address</label>
							<input type="text" name="emailaddress" value="" placeholder="Enter Email Address" class="form-control">
						</div>
						
						<div class="form-group">
							<label> Password</label>
							<input type="text" name="password" id="password" value="" placeholder="Enter Password" class="form-control">
						</div>
						
						<div class="form-group">
						<label> Confirm Password</label>
						<input type="text" name="confirmpassword" id="confirmpassword" value="" placeholder="Confrim Password" class="form-control">
						</div>
						
					
						
						<div class="form-group">
						<label> Street</label>
						<input type="text" name="street" value="" placeholder="Enter Street" class="form-control">
						</div>
						
						<div class="form-group">
						<label> City</label>
						<input type="text" name="city" value="" placeholder="Enter City" class="form-control">
						</div>
						
						<div class="form-group">
						<label> State</label>
						<input type="text" name="state" value="" placeholder="Enter State" class="form-control">
						</div>
						
						<div class="form-group">
						<label> Zip</label>
						<input type="text" name="zip" value="" placeholder="Enter Zip" class="form-control">
						</div>
						
						<?php /*<div class="form-group">
						<label> Country</label>
						<select name="country">
							<option value=""> Select Country</option>
							<option value="USA"> USA</option>
						</select>
						</div>*/?>
						
					</div>
			
			 
			 
				
				
					<div class="col-xs-6 col-md-4">
						<legend>Primary Emergency Contact:</legend>
						
						
						<div class="form-group">
						<label> First Name <input type="text" name="primary_firstname" value="" placeholder="Primary First Name" class="form-control">
						</div>
						
						<div class="form-group">
						<label> Last Name </label> <input type="text" name="primary_lastname" value="" placeholder="Primary Last Name" class="form-control">
						</div>
						
						<div class="form-group">
						<label> Phone Number </label> <input type="text" name="primary_phonenumber" value="" placeholder="Primary Phone Number" class="form-control">
						</div>
						
						<div class="form-group">
						<label> E-Mail </label> <input type="text" name="primary_email" value="" placeholder="Primary Email" class="form-control">
						</div>
						
						<div class="form-group">
						<label> Address Line1 </label> <input type="text" name="primary_address1" value="" placeholder="Primary Address" class="form-control">
						</div>
						
						<div class="form-group">
						<label> Address Line2 </label> <input type="text" name="primary_address2" value="" placeholder="Primary Address" class="form-control">
						</div>
						
						<div class="form-group">
						<label> City </label> <input type="text" name="primary_city" value="" placeholder="Primary City" class="form-control">
						</div>
						
						<div class="form-group">
						<label> State </label> <input type="text" name="primary_state" value="" placeholder="Primary State" class="form-control">
						</div>
						
						<div class="form-group">
						<label> Zipcode </label> <input type="text" name="primary_zip" value="" placeholder="Primary Zip" class="form-control">
						</div>
						
						<div class="form-group">
						<label> Country</label>
						<select name="primary_country" class="form-control">
							<option value=""> Select Country</option>
							<option value="USA"> USA</option>
						</select>
						</div>
					</div>		
					
					
					<div class="col-xs-6 col-md-4">
						<legend>Secondary Emergency Contact:</legend>
						
						
						<div class="form-group">
						<label> First Name <input type="text" name="secondary_firstname" value="" placeholder="Secondary First Name" class="form-control">
						</div>
						
						<div class="form-group">
						<label> Last Name </label> <input type="text" name="secondary_lastname" value="" placeholder="Secondary Last Name" class="form-control">
						</div>
						
						<div class="form-group">
						<label> Phone Number </label> <input type="text" name="secondary_phonenumber" value="" placeholder="Secondary Phone Number" class="form-control">
						</div>
						
						<div class="form-group">
						<label> E-Mail </label> <input type="text" name="secondary_email" value="" placeholder="Secondary Email" class="form-control">
						</div>
						
						<div class="form-group">
						<label> Address Line1 </label> <input type="text" name="secondary_address1" value="" placeholder="Secondary Address" class="form-control">
						</div>
						
						<div class="form-group">
						<label> Address Line2 </label> <input type="text" name="secondary_address2" value="" placeholder="Secondary Address" class="form-control">
						</div>
						
						<div class="form-group">
						<label> City </label> <input type="text" name="secondary_city" value="" placeholder="Secondary City" class="form-control">
						</div>
						
						<div class="form-group">
						<label> State </label> <input type="text" name="secondary_state" value="" placeholder="Secondary State" class="form-control">
						</div>
						
						<div class="form-group">
						<label> Zipcode </label> <input type="text" name="secondary_zip" value="" placeholder="Secondary Zip" class="form-control">
						</div>
						
						<div class="form-group">
						<label> Country</label>
						<select name="secondary_country" class="form-control">
							<option value=""> Select Country</option>
							<option value="USA"> USA</option>
						</select>
						</div>
					</div>
				
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<legend>Veterinarian Contact:</legend>
					
					
					<div class="form-group">
					<label> Facility Name <input type="text" name="veterinarian_faclityname" value="" placeholder="Facility Name" class="form-control">
					</div>
					
					<div class="form-group">
					<label> Phone Number </label> <input type="text" name="veterinarian_phonenumber" value="" placeholder="Phone Number" class="form-control">
					</div>
					
					<div class="form-group">
					<label> E-Mail </label> <input type="text" name="veterinarian_email" value="" placeholder="E-Mail Address" class="form-control">
					</div>
					
					<input type="submit" name="registercutomer" value="Sign Up" class="btn btn-primary">
					
				</div>
			</div>			
			
			
			
			
			
			
			</div>	
			
        </form>
		
		
	</div><!-- .content-area -->

<?php get_footer(); ?>
