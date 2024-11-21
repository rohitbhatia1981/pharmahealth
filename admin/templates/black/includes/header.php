	<?php	
	if ($_SESSION['name']!="")
		{
			$fullName = $_SESSION['name'];
			$nameParts = explode(' ', $fullName);
			$firstInitial = strtoupper(substr($nameParts[0], 0, 1));
			$lastInitial = isset($nameParts[1]) ? strtoupper(substr($nameParts[1], 0, 1)) : '';
			
		}
	?>
    					<!--app header-->
						<div class="app-header header">
							<div class="container-fluid">
								<div class="d-flex">
									<a class="header-brand" href="#">
										<img src="<?php echo URL?>images/Pharmacy-health-final-logo.svg" class="header-brand-img desktop-lgo" alt="">
										<img src="<?php echo URL?>images/Pharmacy-health-final-logo.svg" class="header-brand-img dark-logo" alt="">
										<img src="<?php echo URL?>images/Pharmacy-health-final-logo.svg" class="header-brand-img mobile-logo" alt="">
										<img src="<?php echo URL?>images/Pharmacy-health-final-logo.svg" class="header-brand-img darkmobile-logo" alt="">
									</a>
									<div class="app-sidebar__toggle" data-toggle="sidebar">
										<a class="open-toggle" href="#">
											<i class="feather feather-menu"></i>
										</a>
										<a class="close-toggle" href="#">
											<i class="feather feather-x"></i>
										</a>
									</div>
									<div class="mt-0">
										<form class="form-inline">
											<div class="search-element">
												<input type="search" class="form-control header-search" placeholder="Search…" aria-label="Search" tabindex="1">
												<button class="btn btn-primary-color" >
													<i class="feather feather-search"></i>
												</button>
											</div>
										</form>
									</div><!-- SEARCH -->
									<div class="d-flex order-lg-2 my-auto ml-auto">
										<a class="nav-link my-auto icon p-0 nav-link-lg d-md-none navsearch" href="#" data-toggle="search">
											<i class="feather feather-search search-icon header-icon"></i>
										</a>
										
								
										<div class="dropdown profile-dropdown">
											<a href="#" class="nav-link pr-1 pl-0 leading-none" data-toggle="dropdown">
												<span class="circle">
												<?php echo $firstInitial; ?><?php echo $lastInitial; ?>
                                            </span>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated">
												<div class="p-3 text-center border-bottom">
													<a href="#" class="text-center user pb-0 font-weight-bold">Pharma Health</a>
													<p class="text-center user-semi-title">Admin</p>
												</div>
												
												<a class="dropdown-item d-flex" href="?c=change-password" >
													<i class="feather feather-edit-2 mr-3 fs-16 my-auto"></i>
													<div class="mt-1">Change Password</div>
												</a>
												<a class="dropdown-item d-flex" href="<?php echo URL?>admin/logout.php">
													<i class="feather feather-power mr-3 fs-16 my-auto"></i>
													<div class="mt-1">Sign Out</div>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--/app header-->