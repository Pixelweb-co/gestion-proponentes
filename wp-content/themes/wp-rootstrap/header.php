<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package rootstrap
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- favicon -->

<?php if ( rootstrap_get_option( 'custom_favicon' ) ) { ?>
<link rel="icon" href="<?php echo rootstrap_get_option( 'custom_favicon' ); ?>" />
<?php } ?>

<!--[if IE]><?php if ( rootstrap_get_option( 'custom_favicon' ) ) { ?><link rel="shortcut icon" href="<?php echo rootstrap_get_option( 'custom_favicon' ); ?>" /><?php } ?><![endif]-->	

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'before' ); ?>	
<div id="page" class="hfeed site">
<?php do_action( 'nav-before' ); ?>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container">
		        <div class="navbar-header">
		            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
		                <span class="sr-only">Toggle navigation</span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		            </button>						
					<div id="logo" >
				    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php if(rootstrap_get_option('logo_uploader')=='') {
						echo bloginfo( 'name' ); ?>
						<span id="site-description"><?php bloginfo( 'description' ); ?></span>
					 <?php } else { ?>
						<img src="<?php echo rootstrap_get_option('logo_uploader'); ?>">	
					<?php } ?>
					</a>
					</div>
		        </div>

		       <?php if(!is_user_logged_in()){  ?>
		        
		        <div style="float:right; margin-right: 30px; padding-top: 20px">

		        	<a href="<?=site_url('login')?>"><h3>Acceder</h3></a>

		        </div>

		    <?php }else{ ?>
		    	
		    	<div style="float:right; margin-right: 30px; padding-top: 20px">

		        	<a href="<?=wp_logout_url()?>"><h3>Salir</h3></a>

		        </div>


		    <?php } ?>

				<?php rootstrap_header_menu(); ?>
		    </div>
		</nav><!-- .site-navigation -->	
		<?php do_action( 'nav-after' ); ?>