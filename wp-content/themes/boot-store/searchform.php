<?php
/**
 * The Search Form for our theme.
 * Boot Store theme is based on Twentytwelve theme. The official WordPress theme.
 *
 * @package WordPress
 * @subpackage Boot Store
 * @since MarketPlace 1.0
 */
?>

<form class="navbar-form pull-left searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">

	<input class="market-search" type="text" placeholder="<?php _e( 'Search', 'bre-bootstrap-ecommerce' ); ?>" name="s" id="s">
	<input class="btn btn-inverse searchsubmit" type="submit" value="Search"/>

</form>