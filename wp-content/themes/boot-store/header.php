<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 * Boot Store theme is based on Twentytwelve theme. The official WordPress theme.
 *
 * @package WordPress
 * @subpackage Boot Store
 * @since Boot Store 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->


<?php wp_head(); ?>

</head>

<body <?php body_class(); ?> id="bp-default" >
<?php if ( ! is_user_logged_in() ) : ?>
	<div id="myLoginRegister" class="modal hide fade">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

		<div class="row-fluid">
			<div class="span12">
				<div class="modal-header">
					<h3><?php _e( 'Login', 'bre-bootstrap-ecommerce' ); ?></h3>
				</div>
				<div class="modal-body">
					<?php if ( function_exists( 'tcp_login_form' ) ) tcp_login_form(); ?>
				</div>
			</div>
		</div><!-- .row-fluid -->
	</div><!-- #myLoginRegister -->
<?php endif; ?>
	
<div id="page-top-wrapper" class="container-fluid-wrapper">
	<div id="page-top" class="site">

		<header id="masthead" class="site-header wrapper" role="banner">
			<div class="hgroup">
				<div class="site-title-description clearfix">
					<?php $bre_logo = get_option( 'bre_image_logo', false );
					if ( $bre_logo !== false ) : $bre_logo = $bre_logo['url']; ?>
						<h1 class="site-title bre-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" src="<?php echo $bre_logo ?>"></a></h1>
					<?php else : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php endif; ?>

					<?php $bse_site_description = get_option( 'bre_site_description_hide', false );
					if ( $bse_site_description == false ) :  ?>
						<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
					<?php endif; ?>
				</div>
				<div class="bse-language">
					<?php do_action( 'icl_language_selector' ); ?>
				</div>
				<?php $header_image = get_header_image();
				if ( ! empty( $header_image ) ) : ?>
					<!-- a href="<?php echo esc_url( home_url( '/' ) ); ?>"></a> -->
						<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
				<?php endif; ?>
			</div>

		<?php ob_start();
		wp_nav_menu( array( 
			'theme_location' => 'primary', 
			'menu_class' => 'nav',
			'container_class' => 'nav-collapse-primary nav-collapse collapse',
			'fallback_cb'     => 'false',
		) );
		$out = ob_get_clean(); 
		if ( strlen( $out ) > 0 ) : ?>
			<div class="primary-menu-wrapper">
				<?php $bre_primary_menu = get_option( 'bre_primary_menu', '' );
				$bre_primary_menu_transparent = get_option( 'bre_primary_menu_transparent', true );
				$bre_primary_menu_transparent = $bre_primary_menu_transparent ? 'transparent' : ''; ?>
				<div class="navbar <?php echo $bre_primary_menu; ?> <?php echo $bre_primary_menu_transparent; ?> primary-menu-bs">
						<div class="navbar-inner">
							<div class="container">
								<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
								<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse-primary">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								</a>
								<?php echo $out; ?>
							</div>
						</div>
					</div><!-- .navbar -->
			</div><!-- .primary-menu-wrapper -->
		<?php endif; ?>
		</header><!-- #masthead -->

		<?php $bre_secondary_menu		= get_option( 'bre_secondary_menu', 'navbar-inverse' );
		$bre_secondary_menu_transparent	= get_option( 'bre_secondary_menu_transparent', false );
		$bre_secondary_menu_transparent	= $bre_secondary_menu_transparent ? 'transparent' : ''; ?>

		<div class="navbar <?php echo $bre_secondary_menu; ?> <?php echo $bre_secondary_menu_transparent; ?> secondary-menu-bs">
			<div class="navbar-inner">
				<div class="container">

					<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse-secondary">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</a>

					<ul class="nav pull-right">
						<li class="divider-vertical"></li>
						<li class="pull-right">
							<?php get_search_form(); ?>
						</li>
					</ul>

					<?php wp_nav_menu( array( 
						'theme_location' => 'secondary-menu', 
						'menu_class' => 'nav',
						'container_class' => 'nav-collapse-secondary nav-collapse collapse',
					) ); ?>

				</div>
			</div>
		</div><!-- navbar -->
<?php $bre_carousel_hide = get_option( 'bre_carousel_hide', false );

if ( ! $bre_carousel_hide && ( is_front_page() || is_page_template( 'page-templates/full-width-carousel.php' ) ) ) : ?>
	
		<script type="text/javascript">
		jQuery( function() {
			jQuery( '#template-carousel' ).carousel( {
				interval: 8000
			} );
		} );
		</script>

	<?php
	$bre_carousel_order_desc = get_option( 'bre_carousel_order_desc', 'desc' );
	$carousel_args = array(
		'post_type'		 => get_post_types( array( 'public' => true ) ),
		'posts_per_page' => -1,
		'post_status'	 => 'publish',
		'fields'		 => 'ids',
		'order'			 => $bre_carousel_order_desc, //'DESC',
		'meta_query' => array(
			array(
				'key'		=> 'bre_add_to_home_carousel',
				'value'		=> true,
				'compare'	=> '=',
			),
		),
	);
	$carousel_posts = get_posts( $carousel_args );

	if ( is_array( $carousel_posts ) && count( $carousel_posts ) == 0 ) $carousel_posts = get_posts( array( 'fields' => 'ids' ) );
	
	if ( is_array( $carousel_posts ) && count( $carousel_posts ) > 0 ) : ?>

		<div id="header-slide" class="row-fluid hidden-phone">
			<div id="template-carousel" class="carousel slide hidden-phone">
				<div class="carousel-inner" style="background-color: rgba(0, 0, 0, <?php echo get_option( 'bre_carousel_opacity', 0.5 ); ?>);">

				<?php if ( ! isset( $instance ) ) $instance = get_option( 'ttc_settings' );
				$suffix = '-' . get_post_type( get_the_ID() );
				if ( ! isset( $instance['title_tag' . $suffix] ) ) $suffix = '';
				$image_size = isset( $instance['image_size' . $suffix] ) ? $instance['image_size' . $suffix] : 'thumbnail';

					$class = 'active';
					foreach( $carousel_posts as $post_id ) :
						$image = bre_get_image_for_carousel( $post_id );?>

						<div id="bs-slide-<?php echo $post_id; ?>" class="item <?php echo $class; ?> bs-slide-<?php echo $post_id; ?>" style="background-image: url(<?php echo $image['url']; ?>);">
							<?php $class = ''; ?>
							<div class="bigcarousel-bg hidden-phone">
							<?php if ( isset( $image['url'] ) ) : ?>
								<!--<img src="<?php echo $image['url']; ?>" />-->
							<?php endif; ?>
							</div>
							<div id="post-<?php echo $post_id; ?>" <?php post_class(); ?>>

								<div class="site row-fluid wrapper-group">

									<?php if ( has_post_thumbnail( $post_id ) ): ?>
									<div class="span7">
									<?php else: ?>
									<div class="span12">
									<?php endif; ?>


										<div class="carousel-caption">


											<?php $permalink_url = bre_get_carousel_link( $post_id );
											if ( strlen( $permalink_url ) == 0 ) {
												$permalink_url = function_exists( 'tcp_get_permalink' ) ? tcp_get_permalink( $post_id ) : get_permalink( $post_id );
											}
											$bre_carousel_external_link = bre_get_carousel_external_link( $post_id );
											$title = bre_get_carousel_title( $post_id );
											if ( strlen( $title ) == 0 ) {
												$title = function_exists( 'tcp_get_the_title' ) ? tcp_get_the_title( $post_id ) : get_the_title( $post_id );
											}
											?>
											<h2 class="carousel-title"><a href="<?php echo $permalink_url; ?>" <?php if ( $bre_carousel_external_link ) :?>target="_blank"<?php endif; ?>><?php echo $title; ?></a></h2>
											<?php if ( function_exists( 'sharing_display' ) ) remove_filter( 'the_excerpt', 'sharing_display', 19 ); ?>



											<div class="slide-summary lead">
												<?php $slogan = bre_get_carousel_slogan( $post_id );
												if ( strlen( $slogan ) > 0 ) {
													echo do_shortcode( $slogan );
												} elseif ( function_exists( 'tcp_the_excerpt' ) ) {
													echo tcp_the_excerpt( $post_id, get_option( 'bre_carousel_excerpt_length', 50 ) );
												} else {
													bre_the_excerpt( $post_id, get_option( 'bre_carousel_excerpt_length', 50 ) );
												} ?>
											</div>

											<div class="wrapper-prices">

											</div><!-- .wrapper-prices -->

											<?php if ( function_exists( 'tcp_is_saleable' ) && tcp_is_saleable( $post_id ) ) : ?>
												<?php if ( ! get_option( 'bre_carousel_hide_more_details', false ) ) : ?>

													<a href="<?php echo tcp_get_permalink( $post_id );?>" class="btn btn-large btn-primary">
														<?php echo tcp_get_the_price_label( $post_id );?>
													</a>
													<?php if ( function_exists( 'tcp_has_discounts' )) : ?>
														<?php if ( tcp_has_discounts() ) : ?>
															<span class="loop-discount">-<?php tcp_the_discount_value(); ?></span>
														<?php endif; ?>
													<?php endif; ?>
													<?php if ( function_exists( 'tcp_get_the_stock' )) : ?>
														<?php $stock = tcp_get_the_stock( get_the_ID() );
														if ( $stock == 0 ) : ?>
															<span class="loop-out-stock"><?php _e( 'Out of stock', 'bre-bootstrap-ecommerce' ); ?></span>
														<?php endif; ?>
													<?php endif; ?>
								
												<?php endif; ?>

											<?php else :
												if ( ! get_option( 'bre_carousel_hide_more_details', false ) ) : ?>
												<a href="<?php echo $permalink_url; ?>" class="btn btn-large btn-primary">
													<?php _e( 'More info', 'bre-bootstrap-ecommerce' ); ?>
												</a>
												<?php endif; ?>	
											<?php endif; ?>


										</div><!-- .carousel-caption -->
									</div><!-- .span -->

									<div class="span5 bs-carousel-img">
									
										<?php if ( has_post_thumbnail( $post_id ) ) :  ?>
											<div class="slide-post-thumbnail">
												<a class="tcp_size-<?php echo $image_size;?>" href="<?php echo get_permalink( $post_id ); ?>">
													<?php if ( function_exists( 'the_post_thumbnail' ) ) echo get_the_post_thumbnail( $post_id, 'large' ); ?></a>
											</div><!-- .entry-post-thumbnail -->
										<?php else : ?>
										<?php endif; ?>	 

									</div><!-- .span -->

								</div><!-- .wrapper-group -->

							</div><!-- #post-## -->
						</div><!-- .item -->
					<?php endforeach; // End the loop ?>
				</div><!-- .carousel-inner -->

				<!-- Carousel nav -->
				
				<?php if ( count( $carousel_posts ) > 1 ) : ?>
				<a class="carousel-control left" href="#template-carousel" data-slide="prev">&lsaquo;</a>
				<a class="carousel-control right" href="#template-carousel" data-slide="next">&rsaquo;</a>
				<?php endif ?>

			</div><!-- #template-carousel -->

		</div><!-- header-slide -->
	<?php endif ?>
<?php endif ?>

	</div><!-- page-top -->

</div><!-- page-top-wrapper -->

<div id="page" class="hfeed site">
	<div class="bse-container">

		<div class="main-tools clearfix hidden-phone">

			<div class="breadcrumbs">
				<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<div id="breadcrumbs">','</div>'); } ?> 
			</div>

			<ul class="login-tool-bar pull-right">
			<?php if ( function_exists( 'tcp_the_total' ) ) : ?>
			<?php global $thecartpress;
			$disable_ecommerce = $thecartpress->get_setting( 'disable_ecommerce' );
			if ( ! $disable_ecommerce ) :
				global $shoppingCart;
				$shoppingCart = TheCartPress::getShoppingCart();
				if ( ! $shoppingCart->isEmpty() ) : ?>
				<li class="my-cart">
					<a href="<?php tcp_the_shopping_cart_url(); ?>">
					<span class="navbar-total"><?php tcp_the_total(); ?></span>
					</a>
				</li>
				<li class="separator"> | </li>
				<?php endif; ?>
			<?php endif; ?>
		<script type="text/javascript">
		jQuery( function() {
			jQuery( '.tcp_user_name' ).tooltip( );
		} );
		</script>
				<li>
				<?php if ( ! is_user_logged_in() ) : ?>
					<a href="#myLoginRegister" role="button" class="" data-toggle="modal">
						<?php _e( 'Login', 'bre-bootstrap-ecommerce' ); ?>
					</a>
					<?php if ( isset( $_REQUEST['tcp_register_error'] ) ) : ?>
						<p class="error"><?php echo $_REQUEST['tcp_register_error']; ?></p>
					<?php endif; ?>
				<?php else : 
					global $current_user;
					get_currentuserinfo();
					if ( function_exists( 'tcp_the_my_account_url' ) ) : ?>
					<span class="tcp_user_name"><a href="<?php tcp_the_my_account_url() ?>" title="<?php _e( 'My Account', 'bre-bootstrap-ecommerce' ); ?>" data-toggle="tooltip"><?php printf( __( 'Hi, %s', 'bre-bootstrap-ecommerce' ), $current_user->user_nicename ); ?></span></a>
					</li><li class="separator"> | </li><li>
					<?php endif; ?>
					<a href="<?php echo wp_logout_url(); ?>" title="Logout"> <?php _e( 'Logout', 'bre-bootstrap-ecommerce' ); ?></a>
				<?php endif; ?>
				</li>
			<?php endif; ?>
			</ul>
			
		</div><!-- .main-tools -->	

<?php if ( is_front_page() ) :
	if ( ! get_option( 'bre_hide_home_shortcuts', false ) ) bre_the_three_boxes() ?>
<?php endif; ?>

		<div id="main" class="row-fluid">
