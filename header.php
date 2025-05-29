<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $pageTitle; ?></title>
<link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
<link rel="manifest" href="favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|Lato:400,100,300,700,900|Roboto+Condensed:400,300,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="css/default.css">
<link rel="stylesheet" type="text/css" href="css/nivo-slider.css">
<link rel="stylesheet" type="text/css" href="css/style.css">

<script type="text/javascript" src="js/greensock/TweenMax.min.js"></script>

</head>
<body <?php if(!empty($page) && $page=="home"): ?> id="home" <?php endif; ?>>
<script type="text/javascript">document.write('<div id="preloader"><div id="status"></div></div>');</script>
<header <?php if(!empty($page) && $page=="home"): ?> id="mainHeader" <?php endif; ?>>
	<div class="container-fluid white_bg">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 text-center ">
				<a class="navbar-brand" href="index.php"><img class="img-responsive" src="img/logo.png"></a>
			</div>
			<div class="clear"></div>
			<?php if(!empty($page) && $page=="home"): ?>

			<div class="navWrapper">
				<div class="navInner">
					<a class="smallLogo" href="index.php"><img class="img-responsive" src="img/logo-small.png"></a>
					<nav class="navbar ">		
						<div class="navbar-header">        
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>				   
						</div>    

						<div id="navbar" class="navbar-collapse collapse ">
							<ul class="nav navbar-nav" id="single-page-nav">
								<li><a class="active" href="#home">Home</a></li>                                                                   
								<li><a href="#aboutUs">ABout us</a></li>
								<li><a href="#whyUs">why us</a></li>
								<li><a href="#advantage">Advantages</a></li>
								<li><a href="#howWeWork">how we work </a></li>
								<li><a href="#derivatives">Derivatives</a></li>        
								<li><a href="#contact">contact us</a></li>          
							</ul>                         
						</div><!--/.nav-collapse -->		
					</nav>
				</div>
			</div>

		<?php else: ?>


			<nav class="navbar">		
				<div class="navbar-header">        
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>				   
				</div>    

				<div id="navbar" class="navbar-collapse collapse ">
					<ul class="nav navbar-nav">
						<li><a class="<?php if($currentPage =='home'){echo 'active';}?>" href="index.php">Home</a></li>
						<li><a class="<?php if($currentPage =='aboutus'){echo 'active';}?>" href="aboutus.php">ABout us</a></li>
						<li><a class="<?php if($currentPage =='whyus'){echo 'active';}?>" href="whyus.php">why us</a></li>
						<li><a class="<?php if($currentPage =='advantages'){echo 'active';}?>" href="advantage.php">Advantages</a></li>
						<li><a class="<?php if($currentPage =='howwework'){echo 'active';}?>" href="how_we_work.php">how we work </a></li>
						<li><a class="<?php if($currentPage =='derivatives'){echo 'active';}?>" href="derivates.php">Derivatives</a></li>        
						<li><a class="<?php if($currentPage =='contactus'){echo 'active';}?>" href="contactus.php">contact us</a></li>          
					</ul>                         
				</div><!--/.nav-collapse -->		
			</nav>


		<?php endif; ?>
		</div>
	</div>
</header>