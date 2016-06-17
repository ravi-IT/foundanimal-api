<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script>
	var adminUrl =  '<?php echo admin_url( 'admin-ajax.php' );?>';
	var MyHomepath = "<?php echo esc_url( home_url( '/' ) ); ?>";
	var MyTemplatepath = "<?php echo get_template_directory_uri(); ?>";
	var homeurl = "<?php echo get_home_url(); ?>";	
</script>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentyfifteen' ); ?></a>

	<div id="sidebar" class="sidebar">
		<header id="masthead" class="site-header" role="banner">
			<div class="site-branding">
				<?php
					twentyfifteen_the_custom_logo();

					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; ?></p>
					<?php endif;
				?>
				<button class="secondary-toggle"><?php _e( 'Menu and widgets', 'twentyfifteen' ); ?></button>
			</div><!-- .site-branding -->
		</header><!-- .site-header -->

		<ul id="menu-header" class="nav-menu">
		<?php if(!isset($_SESSION['userID'])){ ?>
			
			<li id="menu-item-7" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7"><a href="<?php echo home_url('/register');?>">Register</a></li>		
			
			<li id="menu-item-7" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7"><a href="<?php echo home_url('/login');?>">Login</a></li>
		<?php } else { ?>	
		<?php /*<li id="menu-item-7" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7"><a href="http://localhost/foundanimal-api/logout/">Logout</a></li>*/?>
		
		<li id="menu-item-7" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7"><a href="<?php echo home_url('/my-profile'); ?>">My Profile</a></li>
		
		<li id="menu-item-7" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7"><a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a></li>
		
		
		
		<?php } ?>
		</ul>
		
		<?php// get_sidebar(); ?>
		
		
	</div><!-- .sidebar -->

	<div id="content" class="site-content">
	
	<?php 
	if(isset($_SESSION['userID'])){
		echo "NetSuite Customer Internal ID :"." ------->". $_SESSION['userID'];
		echo "<br/>";
	}
	
	if(isset($_SESSION['userName'])){
		echo "NetSuite Customer Name :"."------->".$_SESSION['userName'];
	}
	
	
	?>
