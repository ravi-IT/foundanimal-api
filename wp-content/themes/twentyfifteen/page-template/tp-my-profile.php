<?php 
/*

Template Name: My Profile Page

*/
?>

<?php
get_header(); ?>

<div class="container-fluid">
		<h1><?php echo get_the_title();?></h1>
		
		<div class="customer-update-form">
			<div class="customer-error"></div>
		</div>
		
		<?php 
		
		
		$CustomerId = $_SESSION['userID'];
		$flag = false;
		$url = "http://localhost/Registry-API/customer?id=".$CustomerId;
		
		$curl = curl_init();

				curl_setopt_array($curl, array(
					CURLOPT_URL => $url,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "GET",
						CURLOPT_HTTPHEADER => array(
							"Authorization: Token 0901ea36fec4a5f0ab5fb8377f97740d:o9Ro8OmIaWP0",
						),
					)
				);

				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);

				$ProfileData = json_decode($response,true); 
				
				if ($err) {
					
					echo "cURL Error #:" . $err;
					
				} else {
					
					if(isset($ProfileData['error_msg'])) {
						
							echo $ProfileData['error_msg'];
								
						} else {
		
							//echo '<pre>';
							//print_r($ProfileData['suite_response']);
							$flag = true;
							$firstName = $ProfileData['suite_response']['readResponse']['record']['firstName'];
							$lastName = $ProfileData['suite_response']['readResponse']['record']['lastName'];
							$phone = $ProfileData['suite_response']['readResponse']['record']['phone'];
							$email = $ProfileData['suite_response']['readResponse']['record']['email'];
							$defaultAddress = $ProfileData['suite_response']['readResponse']['record']['defaultAddress'];
							$addressbookList = $ProfileData['suite_response']['readResponse']['record']['addressbookList']['addressbook'];
							
							
							
						}
					
				}
		?>
		
		<?php if($flag){ ?>	
				<div class="row">
						
					<div class="col-xs-6 col-md-6">	
						<form id="netsuiteupdatepprofile" name="netsuiteupdatepprofile" method="post">
							<input type="hidden" name="action" value="foundanimal_update_profile_action">
							<input type="hidden" name="IntrnalID" value="<?php echo $CustomerId;?>">
							
								<div class="form-group">
								<label> First Name : </label> <input type="text" name="firstname" value="<?php echo $firstName;?>" class="form-control">
								</div>
								
								<div class="form-group">
								<label> Last Name : </label> <input type="text" name="lastname" value="<?php echo $lastName;?>" class="form-control">
								</div>
								
								<div class="form-group">
								<label> Phone Number : </label> <input type="text" name="phonenumber" value="<?php echo $phone;?>" class="form-control">
								</div>
								
								<div class="form-group">
								<label> E-Mail : </label> <input type="text" name="emailaddress" value="<?php echo $email;?>" disabled="disabled" class="form-control">
								</div>
								
								<div class="form-group">
								<label> Password</label><input type="text" name="password"  id="password" value="" placeholder="Enter Password" class="form-control">
								</div>
								
								<div class="form-group">
								<label> Confirm Password</label><input type="text" id="confirmpassword" name="confirmpassword" value="" placeholder="Confrim Password" class="form-control">
								</div>
								
								<div class="form-group">
								<input type="submit" class="btn fa-input" name="updateprofile" value="Update">
								</div>
								
						</form>	
					</div>
					
					<div class="col-xs-6 col-md-6">
						<div class="addresslist">
							<h2>Address</h2>
							<?php 
							
							foreach($addressbookList as $address) { 
									
									$attention = $address ['addressbookAddress']['attention'];
									$addressee = $address['addressbookAddress']['addressee'];
									$addr1 = $address['addressbookAddress']['addr1'];
									$addr2 = $address['addressbookAddress']['addr2'];
									$city = $address['addressbookAddress']['city'];
									$state = $address['addressbookAddress']['state'];
									$zip = $address['addressbookAddress']['zip'];
									$addrText = $address['addressbookAddress']['addrText'];
									$internalId = $address['internalId'];
							?>		
									<div class="address-block-customer" style="display:block">
										<?php echo nl2br($addrText);?>
										<a href="javascript:void(0)" class="edit_customer_address">Edit</a>
										
										
									</div>	
									
									<div class="edit_customer_address" style="display:none">
									
										<form id="netsuite_update_profile_address" name="netsuite_update_profile_address" method="post" >
											
											<input type="hidden" name="action" value="netsuite_customer_address_update_action">
											
											<input type="hidden" name="customer_inernal_id" value="<?php echo $CustomerId;?>">
											
											<input type="hidden" name="address_internalid" value="<?php echo $internalId;?>">
											
											
											
											<div class="form-group">
												<label> Attention</label>
												<input type="text" name="attention" value="<?php echo $attention;?>" placeholder="Enter Attention" class="form-control">
											</div>
											
											<div class="form-group">
												<label> Address1</label>
												<input type="text" name="address1" value="<?php echo $addr1;?>" placeholder="Enter Address" class="form-control">
											</div>
											
											<div class="form-group">
												<label> Address2</label>
												<input type="text" name="address2" value="<?php echo $addr2;?>" placeholder="Enter Address" class="form-control">
											</div>
											
											<div class="form-group">
												<label> City</label>
												<input type="text" name="city" value="<?php echo $city;?>" placeholder="Enter City" class="form-control">
											</div>
											
											<div class="form-group">
												<label> State</label>
												<input type="text" name="state" value="<?php echo $state;?>" placeholder="Enter State" class="form-control">
											</div>
											
											<div class="form-group">
												<label> Zip</label>
												<input type="text" name="zip" value="<?php echo $zip;?>" placeholder="Enter Zip" class="form-control">
											</div>
											
											<div class="form-group">
											<input type="submit" class="btn fa-input" name="updateprofile" value="Update">
											</div>
											
										</form>
									</div>
							<?php 
							} 
							?>
							
							
						</div>	
					</div>
					
				</div>		
		<?php } ?>			
		
		
	</div><!-- .content-area -->

<?php get_footer(); ?>
