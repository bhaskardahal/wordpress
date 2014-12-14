<?php
/**
 * The template for displaying search forms in NewLife
 *
 * @subpackage New life
 * @since New life 1.8
 */
?>

<div id="newlife-search-form-block">
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<p><input type="text" name="s" id="s" value="<?php _e( 'Search ...','newlife' );?>"/></p>
		<input type="submit" class="newlife-searchform-submit" value=""/>
	</form>
</div>
