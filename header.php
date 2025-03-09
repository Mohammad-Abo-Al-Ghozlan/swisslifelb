<!-- This is main configuration File -->
<?php
ob_start();
session_start();
include("admin/inc/config.php");
include("admin/inc/functions.php");
include("admin/inc/CSRF_Protect.php");
$csrf = new CSRF_Protect();
$error_message = '';
$success_message = '';
$error_message1 = '';
$success_message1 = '';

// Getting all language variables into array as global variable
$i = 1;
$statement = $pdo->prepare("SELECT * FROM tbl_language");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	define('LANG_VALUE_' . $i, $row['lang_value']);
	$i++;
}

$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	$logo = $row['logo'];
	$favicon = $row['favicon'];
	$contact_email = $row['contact_email'];
	$contact_phone = $row['contact_phone'];
	$meta_title_home = $row['meta_title_home'];
	$meta_keyword_home = $row['meta_keyword_home'];
	$meta_description_home = $row['meta_description_home'];
	$before_head = $row['before_head'];
	$after_body = $row['after_body'];
}

// Checking the order table and removing the pending transaction that are 24 hours+ old. Very important
$current_date_time = date('Y-m-d H:i:s');
$statement = $pdo->prepare("SELECT * FROM tbl_payment WHERE payment_status=?");
$statement->execute(array('Pending'));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	$ts1 = strtotime($row['payment_date']);
	$ts2 = strtotime($current_date_time);
	$diff = $ts2 - $ts1;
	$time = $diff / (3600);
	if ($time > 24) {

		// Return back the stock amount
		$statement1 = $pdo->prepare("SELECT * FROM tbl_order WHERE payment_id=?");
		$statement1->execute(array($row['payment_id']));
		$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result1 as $row1) {
			$statement2 = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
			$statement2->execute(array($row1['product_id']));
			$result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result2 as $row2) {
				$p_qty = $row2['p_qty'];
			}
			$final = $p_qty + $row1['quantity'];

			$statement = $pdo->prepare("UPDATE tbl_product SET p_qty=? WHERE p_id=?");
			$statement->execute(array($final, $row1['product_id']));
		}

		// Deleting data from table
		$statement1 = $pdo->prepare("DELETE FROM tbl_order WHERE payment_id=?");
		$statement1->execute(array($row['payment_id']));

		$statement1 = $pdo->prepare("DELETE FROM tbl_payment WHERE id=?");
		$statement1->execute(array($row['id']));
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<?php
	$title = "Home - SwissLife";
	$description = "Welcome to SwissLife Pharmaceuticals, your trusted partner in healthcare and wellness.";
	?>
	<title><?php echo $title; ?></title>
	<meta name="description" content="<?php echo $description; ?>">

	<!-- Meta Tags -->
	<meta name="viewport" content="width=device-width,initial-scale=1.0" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta property="og:title" content="SwissLife Lebanon">
	<meta property="og:description" content="Get the best medicines in Lebanon.">
	<meta property="og:image" content="assets/uploads/<?php echo $favicon; ?>">
	<meta property="og:url" content="https://www.swisslifelb.com">


	<!-- Favicon -->
	<link rel="icon" type="image/png" href="assets/uploads/<?php echo $favicon; ?>">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script> <!--lazy loading-->

	<!-- Stylesheets -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="assets/css/jquery.bxslider.min.css">
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<link rel="stylesheet" href="assets/css/rating.css">
	<link rel="stylesheet" href="assets/css/spacing.css">
	<link rel="stylesheet" href="assets/css/bootstrap-touch-slider.css">
	<link rel="stylesheet" href="assets/css/animate.min.css">
	<link rel="stylesheet" href="assets/css/tree-menu.css">
	<link rel="stylesheet" href="assets/css/select2.min.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	<!-- for the form search -->
	<link rel="stylesheet" href="assets/css/formsearchcss.css">
	<link rel="stylesheet" href="assets/css/newcard.css">


	<?php

	$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $row) {
		$about_meta_title = $row['about_meta_title'];
		$about_meta_keyword = $row['about_meta_keyword'];
		$about_meta_description = $row['about_meta_description'];
		$faq_meta_title = $row['faq_meta_title'];
		$faq_meta_keyword = $row['faq_meta_keyword'];
		$faq_meta_description = $row['faq_meta_description'];
		$blog_meta_title = $row['blog_meta_title'];
		$blog_meta_keyword = $row['blog_meta_keyword'];
		$blog_meta_description = $row['blog_meta_description'];
		$contact_meta_title = $row['contact_meta_title'];
		$contact_meta_keyword = $row['contact_meta_keyword'];
		$contact_meta_description = $row['contact_meta_description'];
		$pgallery_meta_title = $row['pgallery_meta_title'];
		$pgallery_meta_keyword = $row['pgallery_meta_keyword'];
		$pgallery_meta_description = $row['pgallery_meta_description'];
		$vgallery_meta_title = $row['vgallery_meta_title'];
		$vgallery_meta_keyword = $row['vgallery_meta_keyword'];
		$vgallery_meta_description = $row['vgallery_meta_description'];
	}

	$cur_page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);

	if ($cur_page == 'index.php' || $cur_page == 'login.php' || $cur_page == 'registration.php' || $cur_page == 'cart.php' || $cur_page == 'checkout.php' || $cur_page == 'forget-password.php' || $cur_page == 'reset-password.php' || $cur_page == 'product-category.php' || $cur_page == 'product.php') {
	?>
		<title><?php echo $meta_title_home; ?></title>
		<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
		<meta name="description" content="<?php echo $meta_description_home; ?>">
	<?php
	}

	if ($cur_page == 'about.php') {
	?>
		<title><?php echo $about_meta_title; ?></title>
		<meta name="keywords" content="<?php echo $about_meta_keyword; ?>">
		<meta name="description" content="<?php echo $about_meta_description; ?>">
	<?php
	}
	if ($cur_page == 'faq.php') {
	?>
		<title><?php echo $faq_meta_title; ?></title>
		<meta name="keywords" content="<?php echo $faq_meta_keyword; ?>">
		<meta name="description" content="<?php echo $faq_meta_description; ?>">
	<?php
	}
	if ($cur_page == 'contact.php') {
	?>
		<title><?php echo $contact_meta_title; ?></title>
		<meta name="keywords" content="<?php echo $contact_meta_keyword; ?>">
		<meta name="description" content="<?php echo $contact_meta_description; ?>">
	<?php
	}
	if ($cur_page == 'product.php') {
		$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
		$statement->execute(array($_REQUEST['id']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row) {
			$og_photo = $row['p_featured_photo'];
			$og_title = $row['p_name'];
			$og_slug = 'product.php?id=' . $_REQUEST['id'];
			$og_description = substr(strip_tags($row['p_description']), 0, 200) . '...';
		}
	}

	if ($cur_page == 'dashboard.php') {
	?>
		<title>Dashboard - <?php echo $meta_title_home; ?></title>
		<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
		<meta name="description" content="<?php echo $meta_description_home; ?>">
	<?php
	}
	if ($cur_page == 'customer-profile-update.php') {
	?>
		<title>Update Profile - <?php echo $meta_title_home; ?></title>
		<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
		<meta name="description" content="<?php echo $meta_description_home; ?>">
	<?php
	}
	if ($cur_page == 'customer-billing-shipping-update.php') {
	?>
		<title>Update Billing and Shipping Info - <?php echo $meta_title_home; ?></title>
		<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
		<meta name="description" content="<?php echo $meta_description_home; ?>">
	<?php
	}
	if ($cur_page == 'customer-password-update.php') {
	?>
		<title>Update Password - <?php echo $meta_title_home; ?></title>
		<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
		<meta name="description" content="<?php echo $meta_description_home; ?>">
	<?php
	}
	if ($cur_page == 'customer-order.php') {
	?>
		<title>Orders - <?php echo $meta_title_home; ?></title>
		<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
		<meta name="description" content="<?php echo $meta_description_home; ?>">
	<?php
	}
	?>

	<?php if ($cur_page == 'blog-single.php'): ?>
		<meta property="og:title" content="<?php echo $og_title; ?>">
		<meta property="og:type" content="website">
		<meta property="og:url" content="<?php echo BASE_URL . $og_slug; ?>">
		<meta property="og:description" content="<?php echo $og_description; ?>">
		<meta property="og:image" content="assets/uploads/<?php echo $og_photo; ?>">
	<?php endif; ?>

	<?php if ($cur_page == 'product.php'): ?>
		<meta property="og:title" content="<?php echo $og_title; ?>">
		<meta property="og:type" content="website">
		<meta property="og:url" content="<?php echo BASE_URL . $og_slug; ?>">
		<meta property="og:description" content="<?php echo $og_description; ?>">
		<meta property="og:image" content="assets/uploads/<?php echo $og_photo; ?>">
	<?php endif; ?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

	<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5993ef01e2587a001253a261&product=inline-share-buttons"></script>
	<link rel="stylesheet" href="admin/css/nav.css">
	<?php echo $before_head; ?>
	<style>

	</style>

</head>

<body>

	<?php echo $after_body; ?>
	<!--
<div id="preloader">
	<div id="status"></div>
</div>-->

	<!-- top bar -->
	<div class="top" style="background-color:#9fcd58;">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="left">
						<ul>
							<li><i class="fa fa-phone"></i> <?php echo $contact_phone; ?></li>
							<li><i class="fa fa-envelope"></i> <?php echo $contact_email; ?></li>
						</ul>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="right">
						<ul>
							<?php
							$statement = $pdo->prepare("SELECT * FROM tbl_social");
							$statement->execute();
							$result = $statement->fetchAll(PDO::FETCH_ASSOC);
							foreach ($result as $row) {
							?>
								<?php if ($row['social_url'] != ''): ?>
									<li><a href="<?php echo $row['social_url']; ?>"><i class="<?php echo $row['social_icon']; ?>"></i></a></li>
								<?php endif; ?>
							<?php
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<style>
		/* Basic reset and body styles */
		* {
			outline: none;
			margin: 0;
			padding: 0;
		}

		html,
		body {
			height: 100%;
			min-height: 100%;
			font-family: 'Nunito', sans-serif;
			background-color: #fff;
		}

		#search-form {
			display: flex;
			justify-content: center;
			align-items: center;
		}

		#search-cover {
			display: flex;
			width: 100%;
			max-width: 500px;
			/* Adjust size as needed */
			margin: 20px auto;
			background-color: #c16c19;
			border-radius: 20px;
			box-shadow: 0 6px 30px rgba(0, 0, 0, 0.2), 0 0 0 10px #ffffffeb;
			overflow: hidden;
			/* To ensure the button and input fit inside */
		}

		#search-input {
			flex: 3;
			height: 40px;
			font-size: 16px;
			line-height: 1.2;
			padding: 0 15px;
			border: none;
			border-radius: 20px 0 0 20px;
			background-color: transparent;
			color: #fff;
			transition: background-color 0.3s ease;
		}

		#search-input::placeholder {
			color: #fff;
		}

		#search-button {
			display: flex;
			align-items: center;
			justify-content: center;
			width: 60px;
			height: 40px;
			border: none;
			background-color: #fff;
			color: #c16c19;
			border-radius: 0 20px 20px 0;
			cursor: pointer;
			transition: all 0.3s ease;
			/* Smooth transition */
			position: relative;
			overflow: hidden;
			/* To hide the arrow during the transition */
		}

		#search-button:hover {
			background-color: #c16c19;
			color: #fff;
			transform: scale(1.1);
			/* Scale up on hover */
		}

		.search-icon {
			width: 20px;
			height: 20px;
			transition: all 0.3s ease;
			/* Smooth transition */
		}

		#search-button:hover .search-icon {
			color: #fff;
		}

		/* Animation for the button */
		@keyframes to-arrow {
			0% {
				transform: rotate(0deg);
				width: 20px;
			}

			100% {
				transform: rotate(180deg);
				width: 20px;
			}
		}

		#search-button.clicked .search-icon {
			animation: to-arrow 0.3s ease forwards;
		}

		/* Responsive Design */
		@media (max-width: 576px) {
			#search-cover {
				max-width: 100%;
				margin: 15px 0px 10px 10px;
				margin-right: 0;
				width: 200px;
			}

			#search-input {
				font-size: 14px;
				height: 35px;
			}

			#search-button {
				width: 50px;
				height: 35px;
			}

			.search-icon {
				width: 18px;
				height: 18px;
			}
		}

		@media (min-width: 1200px) {
			#search-input {
				flex: 3;
				height: 40px;
				width: 400px;
				font-size: 16px;
				line-height: 1.2;
				padding: 0 15px;
				border: none;
				border-radius: 20px 0 0 20px;
				background-color: transparent;
				color: #fff;
				transition: background-color 0.3s ease;
			}
		}
	</style>
	<style>
    .logoo-img {
        width: 100%; /* Default for smaller screens */
        height: auto; /* Maintain aspect ratio */
    }

    @media (min-width: 1024px) { /* Targeting laptop screens and above */
        .logoo-img {
            width: 200px;
            height: 70px;
        }
    }
</style>

	<div class="header">
		<div class="container">
			<div class="row inner">
				<div class="col-md-4 logo" style="width:100%">
					<a href="index.php"><img src="assets/uploads/<?php echo $logo; ?>" class="logoo-img" alt="logo image"></a>
				</div>
				<div class="col-md-3 search-area">
					<form action="search-result.php" method="get" id="search-form" class="form-inline">
						<?php $csrf->echoInputField(); ?> <!-- CSRF protection, if applicable -->
						<div id="search-cover" class="d-flex align-items-center">
							<input type="text" name="search_text" id="search-input" placeholder="<?php echo LANG_VALUE_2; ?>" required class="form-control">
							<button type="submit" id="search-button" class="btn btn-danger">
								<svg stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="search-icon">
									<path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linejoin="round" stroke-linecap="round"></path>
								</svg>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


	<style>
		.navshiting {
			justify-content: center;
			/* Centers items horizontally */
			align-items: center;
			/* Centers items vertically */
			display: flex;
		}
	</style>


<style>
/* Existing styles... */

@media (max-width: 768px) {
  .menu-container {
    position: fixed;
    top: 0;
    right: -300px;
    width: 300px;
    height: 100vh;
    background-color: #026a33;
    transition: right 0.3s ease-in-out;
    overflow-y: auto;
    z-index: 1000;
  }

  .menu-container.active {
    right: 0;
  }

  .menu ul.main-menu {
    flex-direction: column;
    align-items: flex-start;
    padding: 20px;
  }

  .menu ul.main-menu li {
    width: 100%;
    margin-bottom: 10px;
  }

  .menu ul.main-menu li a {
    display: block;
    padding: 10px 0;
    color: #fff;
  }

  .submenu, .sub-submenu {
    position: static;
    display: none;
    width: 100%;
    padding-left: 20px;
    background-color: rgba(255, 255, 255, 0.1);
  }

  .submenu.active, .sub-submenu.active {
    display: block;
  }

  #mobile-menu-toggle {
    display: block;
    position: fixed;
    top: 10px;
    right: 10px;
    z-index: 1001;
    background: none;
    border: none;
    cursor: pointer;
  }

  #mobile-menu-toggle span {
    display: block;
    width: 25px;
    height: 3px;
    margin: 5px 0;
    background-color: #fff;
    transition: all 0.3s ease-in-out;
  }

  #mobile-menu-toggle.active span:nth-child(1) {
    transform: rotate(45deg) translate(5px, 5px);
  }

  #mobile-menu-toggle.active span:nth-child(2) {
    opacity: 0;
  }

  #mobile-menu-toggle.active span:nth-child(3) {
    transform: rotate(-45deg) translate(7px, -6px);
  }

  .menu ul.main-menu > li > a {
    display: flex;
    justify-content: space-between;
    align-items: center;
	width: auto;
  }
  .submenuFuck {
	background-color: #c16c19;
  }

  .menu ul.main-menu > li > a.active::after {
    content: '-';
  }
}
.show-on-mobile {
  display: block; /* Or whatever style you want for mobile */
}

</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
  const menuContainer = document.querySelector('.menu-container');
  const mainMenuItems = document.querySelectorAll('.menu ul.main-menu > li');
  const mainMenu = document.querySelector('.menu ul.main-menu');

  function applyMobileStyles() {
    if (window.innerWidth <= 768) {
      // Apply styles for mobile screen
      mobileMenuToggle.style.cssText = "background-color:#c16c19;border-radius:25px;padding:8px;";
    } else {
      // Remove styles for larger screens
      mobileMenuToggle.style.cssText = "";
    }
  }
  applyMobileStyles();
  mobileMenuToggle.addEventListener('click', function() {
    this.classList.toggle('active');
    menuContainer.classList.toggle('active');
	mainMenu.classList.toggle('show-on-mobile');
	applyMobileStyles();
  });

  mainMenuItems.forEach(item => {
    const link = item.querySelector('a');
    const submenu = item.querySelector('.submenu');

    if (submenu) {
      link.addEventListener('click', function(e) {
        if (window.innerWidth <= 768) {
          e.preventDefault();
          this.classList.toggle('active');
          submenu.classList.toggle('active');
        }
      });
    }
  });

  // Close menu when clicking outside
  document.addEventListener('click', function(e) {
    if (!menuContainer.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
      menuContainer.classList.remove('active');
      mobileMenuToggle.classList.remove('active');
	  mainMenu.classList.remove('show-on-mobile');
    }
  });
});
</script>


<button id="mobile-menu-toggle" aria-label="Toggle mobile menu">
  <span></span>
  <span></span>
  <span></span>
</button>
	<div class="nav" style="background-color:#026a33;">
		<div class="container">
			<div class="row">
				<div class="col-md-12 pl_0 pr_0">
					<div class="menu-container" style="background-color:#026a33;">
						<div class="menu">
							<a href="index.php" class="menuu-mobile">Swisslife</a>
							<ul class="main-menu navshiting">
								<li class="nav-shit-item" onclick="window.location.href='index.php';"><a href="index.php">Home</a></li>

								<?php
								$statement = $pdo->prepare("SELECT * FROM tbl_top_category WHERE show_on_menu=1");
								$statement->execute();
								$result = $statement->fetchAll(PDO::FETCH_ASSOC);
								$index = 0; // Initialize the index counter

								foreach ($result as $row) {
									// Determine if the current category should have a submenu
									$hasSubmenu = ($index != 2); // Exclude submenu for the third category (index 2)

								?>
									<li class="menu-item nav-shit-item" onclick="window.location.href=" product-category.php?id=<?php echo $row['tcat_id']; ?>&type=top-category";>
										<a href="product-category.php?id=<?php echo $row['tcat_id']; ?>&type=top-category">
											<?php echo $row['tcat_name']; ?>
										</a>

										<?php if ($hasSubmenu): ?>
											<?php
											// Fetch and display submenu items only if there are items
											$statement1 = $pdo->prepare("SELECT * FROM tbl_mid_category WHERE tcat_id=?");
											$statement1->execute(array($row['tcat_id']));
											$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);

											if (!empty($result1)): // Check if submenu items exist
											?>
												<ul class="submenu submenuFuck" style="color: black;">
													<?php foreach ($result1 as $row1): ?>
														<li class="submenu-item big-shit">
															<a href="product-category.php?id=<?php echo $row1['mcat_id']; ?>&type=mid-category" style="width:auto;">
																<img src="<?php echo $row1['mcat_img']; ?>" alt="<?php echo $row1['mcat_name']; ?>" class="mid-category-icon">
																<?php echo $row1['mcat_name']; ?>
															</a>
															<?php
															// Fetch and display sub-submenu items only if there are items
															$statement2 = $pdo->prepare("SELECT * FROM tbl_end_category WHERE mcat_id=?");
															$statement2->execute(array($row1['mcat_id']));
															$result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
															if (!empty($result2)):
															?>
																<ul class="sub-submenu smaller-shit">
																	<?php foreach ($result2 as $row2): ?>
																		<li class="sub-submenu-item">
																			<a href="product-category.php?id=<?php echo $row2['ecat_id']; ?>&type=end-category">
																				<?php echo $row2['ecat_name']; ?>
																			</a>
																		</li>
																	<?php endforeach; ?>
																</ul>
															<?php endif; ?>
														</li>
													<?php endforeach; ?>
												</ul>
											<?php endif; ?>
										<?php endif; ?>
									</li>
								<?php

									$index++; // Increment the index counter
								}
								?>

								<?php
								$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
								$statement->execute();
								$result = $statement->fetchAll(PDO::FETCH_ASSOC);
								foreach ($result as $row) {
									$about_title = $row['about_title'];
									$faq_title = $row['faq_title'];
									$blog_title = $row['blog_title'];
									$contact_title = $row['contact_title'];
									$pgallery_title = $row['pgallery_title'];
									$vgallery_title = $row['vgallery_title'];
								}
								?>

								<li class="footer-menu-item nav-shit-item" onclick="window.location.href='certOfAnalysis.php';"><a href="certOfAnalysis.php">Certificate Of Analysis</a></li>
								<li class="footer-menu-item nav-shit-item" onclick="window.location.href='about.php';"><a href="about.php"><?php echo $about_title; ?></a></li>
								<li class="footer-menu-item nav-shit-item" onclick="window.location.href='faq.php';"><a href="faq.php"><?php echo $faq_title; ?></a></li>
								<li class="footer-menu-item nav-shit-item" onclick="window.location.href='contact.php';"><a href="contact.php"><?php echo $contact_title; ?></a></li>
							</ul>

						</div>

					</div>
				</div>
			</div>
		</div>
	</div>