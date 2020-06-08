<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Data Direct - Fueling Research</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="css/jquery-ui.structure.min.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="css/jquery-ui.theme.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="css/jquery-ui.css">
	<link rel="stylesheet" href="css/style.css">
	
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo BASE_URL."favicons" ?>/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo BASE_URL."favicons" ?>/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo BASE_URL."favicons" ?>/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo BASE_URL."favicons" ?>/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo BASE_URL."favicons" ?>/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo BASE_URL."favicons" ?>/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo BASE_URL."favicons" ?>/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo BASE_URL."favicons" ?>/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE_URL."favicons" ?>/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="<?php echo BASE_URL."favicons" ?>/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php echo BASE_URL."favicons" ?>/android-chrome-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="<?php echo BASE_URL."favicons" ?>/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="<?php echo BASE_URL."favicons" ?>/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="<?php echo BASE_URL."favicons" ?>/manifest.json">
	<link rel="mask-icon" href="<?php echo BASE_URL."favicons" ?>/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#65747b">
	<meta name="msapplication-TileImage" content="/mstile-144x144.png">
	<meta name="theme-color" content="#ffffff">
	
	<script type="text/javascript">
	var base_url='<?php echo BASE_URL; ?>';
	</script>
	<script src="js/modernizr.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
</head>
<body class="<?php if($currentPage=='home' ){ echo 'homecontrol'; } ?>">
	<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
	<header class="clearfix">
		<?php $currentPage=str_replace('.php','',end(explode('/',$_SERVER['PHP_SELF']))); ?>
			<div class="topmenu">
				<div class="maxwidth">
					<!-- a class="<?php if($currentPage=='about'){ echo 'active'; } ?>" href="<?php echo BASE_URL.'about' ?>">About</a -->
					<?php if(!is_numeric($_SESSION['uID'])){ ?>
						<a class="<?php if($currentPage=='register'){ echo 'active'; } ?>" href="<?php echo BASE_URL.'register' ?>" class="active">Register</a>
						<a class="<?php if($currentPage=='login'){ echo 'active'; } ?>" href="<?php echo BASE_URL.'login' ?>">Login</a>
						<a class="<?php if($currentPage=='contact_us'){ echo 'active'; } ?>" href="<?php echo BASE_URL.'contact-us' ?>">Contact Us</a>
					<?php } else { ?>
						<div class="top-username">
							<span><?php echo $_SESSION['fullName'] ?></span>
							<div class="loginmenu">
								<a href="<?php echo BASE_URL.'dashboard' ?>">Dashboard</a>
								<a href="<?php echo BASE_URL.'proc/logout.php' ?>">Logout</a>
							</div>
						</div>
					<?php } ?>
					
					<span class="cart-toggle">
						Your Cart [ <?php echo number_format(count($_SESSION['cart'])); ?> ]
						<?php if(!empty($_SESSION['cart']) && $hideCheckout<1){ ?>
						<div class="cart-container">
							
								<div class="shopping_cart">
									<div class="data">
										<h4>Shopping Cart</h4>
										<table>
											<tr>
												<th>#</th>
												<th>Description </th>
												<th># Records </th>
												<th>Amount </th>
												<th>&nbsp;</th>
											</tr>
											<?php  
											$count = 1;
											$totalCost = 0;
											$totalCount = 0;
											//echo "<pre>";
											//print_r($_SESSION['cart']);
											//echo "</pre>";
											foreach ($_SESSION['cart'] as $key => $cart) { 

												$cartResourceInfo=$genObj->read('resources', " AND table_name='{$key}' ", $start=0,$interval=1000000000000, $status=NULL,$order=NULL, $fields='*');
												$cartCount = count($cart);
												$cartCost = count($cart)*$cartResourceInfo[0]->unit_cost;

												$totalCost += $cartCost;
												$toBuyStr .= $cartCount." ".$cartResourceInfo[0]->resource_name.",";
												$totalCount += $cartCount; 
												?>
												<tr>
													<td><?php echo $count; ?></td>
													<td><?php echo $cartResourceInfo[0]->resource_name  ?></td>
													<td><?php echo $cartCount ?></td>
													<td><?php echo number_format($cartCost,2) ?></td>
													<td><a href="<?php echo BASE_URL."proc/remove-from-cart.php?resource=$key" ?>" class="remove" title="Remove">&times;</a></td>
												</tr>

											<?php $count++; } ?>
												<tr class="total">
													<td>&nbsp;</td>
													<td>TOTAL</td>
													<td>&nbsp;</td>
													<td><?php echo number_format($totalCost,2); ?></td>
													<td>&nbsp;</td>
												</tr>
										</table>
										<p style="text-align:right">
											<a class="refinebutton to-right" href="<?php echo BASE_URL."checkout" ?>">CHECK OUT</a>
										</p>
										
									</div>		
								</div>
							
						</div>
						<?php } else { ?>
							
							<div class="cart-container">

									<p class="notification info">Your shopping cart is empty.</p>

							</div>
							
						<?php } ?>
					</span>
				</div>
			</div>
		<div class="maxwidth">
			<h1>
				<a href="<?php echo BASE_URL ?>">Data Direct - Fueling Research</a>
			</h1>
			<div class="menu-toggle">
				Menu
			</div>
			<nav>
				<ul>
                	
                    <li class="<?php if($currentPage==''){ echo 'active'; } ?>"><a href="<?php echo BASE_URL; ?>">HOME</a></li>
                    <li class="<?php if($currentPage=='stock-index'){ echo 'active'; } ?>"><a href="<?php echo BASE_URL.'stock-index' ?>">Stock Index</a></li>
					<li class="<?php if($currentPage=='stock-price'){ echo 'active'; } ?>"><a href="<?php echo BASE_URL.'stock-price' ?>">Stock Price</a></li>
					<li class="<?php if($currentPage=='forex-rate'){ echo 'active'; } ?>"><a href="<?php echo BASE_URL.'forex-rate' ?>">FOREX</a></li>
					<li class="<?php if($currentPage=='consumer-price-index'){ echo 'active'; } ?>"><a href="<?php echo BASE_URL.'consumer-price-index' ?>">CPI</a></li>
					<li class="<?php if($currentPage=='interest-rates'){ echo 'active'; } ?>"><a href="<?php echo BASE_URL.'interest-rates' ?>">INTEREST RATES</a></li>
					<!-- li class="<?php if($currentPage=='profiles'){ echo 'active'; } ?>"><a href="<?php echo BASE_URL.'profiles' ?>">COMPANY PROFILE/FINANCIALS</a></li -->
				</ul>
			</nav>
			
		</div>
	</header>
	