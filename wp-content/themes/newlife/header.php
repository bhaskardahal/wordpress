<?php /**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @subpackage New life
 * @since New life 1.8
 */ ?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class = "ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class = "ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title( '|', true, 'left' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head();?>
</head>
<body <?php body_class(); ?>>

<div id="wrap">
	<div id="header">
		<div id="newlife-strip-brown"></div>
		<div id="newlife-strip-green"></div>
		<div id="main">
			<div id="logo">
				<h1 id="newlife-site-title">
					<span>
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</span>
				</h1>
				<div id="newlife-site-description"><?php bloginfo( 'description' ); ?></div>
			</div>
			<div id="menu">
				<?php wp_nav_menu( array( 'theme_location' => 'menu' ) ); ?>
			</div><!-- #menu -->
			<div class="clear"></div>
			<div id="newlife-tips">
				<?php if ( ! is_home() ) get_search_form(); ?>
			</div>
		</div><!-- #main -->	
	</div><!-- #header -->
	<div id="newlife-container">
