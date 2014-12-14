<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @subpackage New life
 * @since New life 1.8
 */
?>
	<div class='clear'></div>	
</div><!-- #newlife-container -->
<div id="footer">
	<div id="newlife-footer-menu-block">
		<div id="newlife-footer-menu">
			<?php wp_nav_menu( array( 'theme_location' => 'menu', 'depth' => 1 ) ); ?>
			<div class="clear"></div>
			<div id="newlife-footer-content">
				<p class="newlife-copirate"><?php _e( 'Copyright', 'newlife'); ?> &#169; <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a> <?php echo date('Y'); ?></p>
				<p class="newlife-footerlinks"><?php _e( 'Powered by', 'newlife' ); ?> <a href="<?php echo esc_url( 'https://github.com/bestwebsoft' ); ?>" target="_blank"><?php printf( 'BestWebSoft team' ); ?></a> <?php _e( 'and', 'newlife' ); ?> <a href="http://www.wordpress.org" target="_blank"><?php _e( 'WordPress', 'newlife' ); ?></a></p>
			</div><!-- #newlife_footer-content -->
		</div><!-- #newlife-footer-menu -->
	</div><!-- #newlife-footer-menu-block -->
</div><!-- #footer -->
</div><!-- #wrap -->
<?php wp_footer();?>
</body>
</html>
