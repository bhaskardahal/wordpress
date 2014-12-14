<?php
/**
 * The template for displaying 404 pages (Not Found).
 * Boot Store theme is based on Twentytwelve theme. The official WordPress theme.
 *
 * @package WordPress
 * @subpackage Boot Store
 * @since Boot Store 1.0
 */

get_header();

if ( ! is_active_sidebar( 'sidebar-1' ) ) $col_width = 'span12';
else $col_width = 'span9'; ?>

	<div id="primary" class="site-content <?php echo $col_width; ?>">
		<div id="content" role="main">
			
			<article id="post-0" class="post error404 no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'bre-bootstrap-ecommerce' ); ?></h1>
				</header>

				<div class="entry-content clearfix">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'bre-bootstrap-ecommerce' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>