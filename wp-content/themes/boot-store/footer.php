<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 * Boot Store theme is based on Twentytwelve theme. The official WordPress theme.
 *
 * @package WordPress
 * @subpackage Boot Store
 * @since Boot Store 1.0
 */

$bre_sidebar_style = get_option( 'bre_sidebar_style', false );
$bre_layout = get_option( 'bre_layout', 'content-sidebar' ); ?>

<script>
/* Bre nav_menus in sidebars */
<?php if ( $bre_sidebar_style ) : ?>
	jQuery( '#secondary .widget_nav_menu, #secondary .taxonomytreesposttype, #secondary .flexipages_widget, #secondary .widget_categories, #secondary .widget_pages' ).addClass( 'bse_nav_menu' );
<?php endif; ?>
/* Left sidebar */
<?php if ( $bre_layout == 'sidebar-content' ) : ?>
	jQuery( '#secondary' ).addClass('tcp-bse-layout');
	jQuery( '#primary' ).addClass('tcp-bse-layout');
<?php endif; ?>
</script>

		</div><!-- #main .wrapper -->
	</div><!-- .bse-container -->	
</div><!-- #page -->

	<footer id="colophon" role="contentinfo" class="site">
		<div class="bse-container footer-widgets">
			<div class="row-fluid">
				<div class="footer-area footer1 span4">
					<?php if ( is_active_sidebar('sidebar-footer-1') ) : ?>
							<?php dynamic_sidebar('sidebar-footer-1'); ?>
					<?php endif; ?>
				</div> <!-- .footer1 -->
				<div class="footer-area footer2 span4">
					<?php if ( is_active_sidebar( 'sidebar-footer-2' ) ) : ?>
							<?php dynamic_sidebar( 'sidebar-footer-2' ); ?>
					<?php endif; ?>
				</div> <!-- .footer2 -->
				<div class="footer-area footer3 span4">
					<?php if ( is_active_sidebar( 'sidebar-footer-3' ) ) : ?>
							<?php dynamic_sidebar( 'sidebar-footer-3' ); ?>
					<?php endif; ?>
				</div> <!-- .footer3 -->
			</div>
		</div>

	</footer><!-- #colophon -->
	
	<div class="site site-info">
		<div class="row-fluid">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'bre-bootstrap-ecommerce' ) ); ?>" title="<?php esc_attr_e( 'Semantic Publishing Platform', 'bre-bootstrap-ecommerce' ); ?>"><?php printf( __( 'Running %s & <a title="Boot Store theme" href="http://extend.thecartpress.com/products/boot-store/">Boot Store theme</a>', 'bre-bootstrap-ecommerce' ), 'WordPress' ); ?></a>
		</div>
	</div><!-- .site-info -->

<?php wp_footer(); ?>

</body>
</html>
