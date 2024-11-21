<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="">
		<meta content="" name="author">
		<meta name="keywords" content=""/>

		<!-- Title -->
		<title><?php echo TITLE; ?>- Prescriber Account</title>

		<!--Favicon -->
		<link rel="icon" href="<?php echo URL?><?php echo PHARMACY_ADMIN?>templates/black/assets/images/brand/favicon.ico" type="image/x-icon"/>

		<!-- Bootstrap css -->
		<link href="<?php echo URL?><?php echo PHARMACY_ADMIN?>templates/black/assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" />

		<!-- Style css -->
		<link href="<?php echo URL?><?php echo PHARMACY_ADMIN?>templates/black/assets/css/style.css" rel="stylesheet" />
		<link href="<?php echo URL?><?php echo PHARMACY_ADMIN?>templates/black/assets/css/dark.css" rel="stylesheet" />
		<link href="<?php echo URL?><?php echo PHARMACY_ADMIN?>templates/black/assets/css/skin-modes.css" rel="stylesheet" />

		<!-- Animate css -->
		<link href="<?php echo URL?><?php echo PHARMACY_ADMIN?>templates/black/assets/css/animated.css" rel="stylesheet" />

		<!---Icons css-->
		<link href="<?php echo URL?><?php echo PHARMACY_ADMIN?>templates/black/assets/css/icons.css" rel="stylesheet" />

		<!-- Select2 css -->
		<link href="<?php echo URL?><?php echo PHARMACY_ADMIN?>templates/black/assets/plugins/select2/select2.min.css" rel="stylesheet" />

		<!-- P-scroll bar css-->
		<link href="<?php echo URL?><?php echo PHARMACY_ADMIN?>templates/black/assets/plugins/p-scrollbar/p-scrollbar.css" rel="stylesheet" />

	</head>

	<body>

		<div class="page login-bg">
			<div class="page-single">
				<div class="container">
					<div class="row">
						<div class="col mx-auto">
							<div class="row justify-content-center">
								<div class="col-md-7 col-lg-5">
									<div class="card" style="top:15%;">
										<div class="pt-3 text-center">
                                        <?php if ($_GET['forgot-password']=="1") { ?>
											<h1 class="mb-2">Forgot Password</h1>
                                            <p class="text-muted">If you have forgotten your password, please enter your email to get instructions to reset</p>
                                          <?php } else if ($_GET['forgot-password']=="")  { ?>
                                          <h1 class="mb-2">Pharmacy Login</h1>
                                          <p class="text-muted">Sign In to your account</p>
                                          <?php } ?>
											
											<span class="error" align="center">
											<?php echo $error;?>
											</span>
										</div>
                                        <?php if ($_GET['otp']=="sent" && $_SESSION['sess_pharmacy_id_temp']!="") { ?>
                                       
										<form class="card-body" id="login" name="login" method="post">
											<div class="form-group">
                                            <h3>Account verification</h3>
                                            <p> <?php if ($_GET['wr']==1) echo "<font style='color:red'>Incorrect OTP</font>"; ?></p>
												<label class="form-label"> Please enter OTP sent in email</label>
												
												<input class="form-control" placeholder="OTP" type="test" name="txtOTP">
											</div>
											
											
											<div class="submit">
												
												<input type="submit" name="submit" value="Login" class="btn btn-primary btn-block">
											</div>
										</form>
                                        <?php } else {
											
											if ($_GET['forgot-password']==1) { ?>
                                            
                                           
                                            
                                            <form class="card-body" action="checkforgotemail.php" id="login" name="login" method="post">
											<div class="form-group">
                                            
                                             <?php if ($_GET['wrong']==1) { ?>
                                            <div style="color:#F00;padding-bottom:10px">Email id is not registered with us, please check.</div>
                                            <?php } ?>
                                            
												<label class="form-label">Please enter your registered email</label>
												
												<input class="form-control" placeholder="Your Email" type="email" name="txtLoginEmail" required>
											</div>
											
											
											<div class="submit">
												
												<button class="btn btn-primary btn-block">Submit</button>
                                                <br>
                                                <a href="<?php echo URL?>pharmacy/account/">Go back to login page</a>
                                                
											</div>
										</form>
												
											<?php }
											else if ($_GET['forgot-password']==2) { ?>
                                            
                                           
                                            
                                           
											<div class="form-group" style="padding:20px">
                                            
                                            <h4 class="title_h4">Please check your Email</h4>
                    <div id="error-container-login" style="color:#F00; padding:10px"></div>
                   <p>We've sent an instruction to your email id. Please follow it to reset your password.</p>
					
				</div>
                                            
                                           
											</div>
											
											
											
										
												
											<?php } if ($_GET['forgot-password']==3) { ?>
                                            
                                           
                                            
                                            <form class="card-body" action="submit-reset-password.php" id="login" name="login" method="post">
											<div class="form-group">
                                            
                                            <h4 class="title_h4">Reset Password</h4>
                                             <div style="height:20px"></div>
                                            
                                            
												<label class="form-label">New Password</label>												
												<input type="password" class="form-control" name="txtLoginPwd" id="txtLoginPwd" placeholder="Enter New Password"  autocomplete="off">
                                                
                                                <div style="height:20px"></div>
                                                <label class="form-label">Re-enter Password</label>												
												<input type="password" class="form-control" name="txtLoginPwd2" id="txtLoginPwd2" placeholder="Re-enter New Password"  autocomplete="off">
                                                
                                                
											</div>
											
											
											<div class="submit">
												
												<button class="btn btn-primary btn-block">Submit</button>
                                                
                                                
											</div>
										</form>
												
											<?php } else if ($_GET['forgot-password']==4) { ?>
                                            
                                           
                                            
                                           
											<div class="form-group" style="padding:20px">
                                            
                                            <h4 class="title_h4">Password Updated</h4>
                    <div id="error-container-login" style="color:#F00; padding:10px"></div>
                   <p>Your password has been updated, you can now login with the new password. <a href="<?php echo URL?>pharmacy/account/" style="color:#069; text-decoration:underline">Click here to login</a></p>
					
				</div>
                                            
                                           
											</div>
											
											
											<?php }
											
											else if ($_GET['forgot-password']=="")
											{
											
											 ?>
                                        
                                        <form class="card-body" id="login" name="login" method="post">
											<div class="form-group">
												<label class="form-label"> Email</label>
												
												<input class="form-control" placeholder="Username" type="test" name="username">
											</div>
											<div class="form-group">
												<label class="form-label">Password</label>
												<input class="form-control" placeholder="password" type="password" name="password">
											</div>
											<div class="form-group">
												<label>
													
													<a href="?forgot-password=1">Forgot Password?</a>
												</label>
											</div>
											<div class="submit">
												
												<input type="submit" name="submit" value="Login" class="btn btn-primary btn-block">
											</div>
										</form>
                                        
                                        <?php 
											}
										} ?>
										<!--<div class="card-body border-top-0 pb-6 pt-2">
											<div class="text-center">
												<span class="avatar brround mr-3 bg-primary-transparent text-primary"><i class="ri-facebook-line"></i></span>
												<span class="avatar brround mr-3 bg-primary-transparent text-primary"><i class="ri-instagram-line"></i></span>
												<span class="avatar brround mr-3 bg-primary-transparent text-primary"><i class="ri-twitter-line"></i></span>
											</div>
										</div>-->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

		<!-- Jquery js-->
		<script src="<?php echo URL?><?php echo PHARMACY_ADMIN?>templates/black/assets/plugins/jquery/jquery.min.js"></script>

		<!-- Bootstrap4 js-->
		<script src="<?php echo URL?><?php echo PHARMACY_ADMIN?>templates/black/assets/plugins/bootstrap/popper.min.js"></script>
		<script src="<?php echo URL?><?php echo PHARMACY_ADMIN?>templates/black/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

		<!-- Select2 js -->
		<script src="<?php echo URL?><?php echo PHARMACY_ADMIN?>templates/black/assets/plugins/select2/select2.full.min.js"></script>

		<!-- P-scroll js-->
		<script src="<?php echo URL?><?php echo PHARMACY_ADMIN?>templates/black/assets/plugins/p-scrollbar/p-scrollbar.js"></script>

		<!-- Custom js-->
		<script src="<?php echo URL?><?php echo PHARMACY_ADMIN?>templates/black/assets/js/custom.js"></script>

	</body>
</html>
