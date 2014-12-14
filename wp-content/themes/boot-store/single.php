<?php
/**
 * The Template for displaying all single posts.
 * Boot Store theme is based on Twentytwelve theme. The official WordPress theme.
 *
 * @package WordPress
 * @subpackage Boot Store
 * @since Boot Store 1.0
 */

get_header();

	if ( ! is_active_sidebar( 'sidebar-blog' ) ) $col_width = 'span12';
	else $col_width = 'span9'; ?>

	<div id="primary" class="site-content <?php echo $col_width; ?>">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

				<?php if ( is_active_sidebar( 'sidebar-cross' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar-cross' ); ?>
				<?php endif; ?>

				<nav class="nav-single">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'bre-bootstrap-ecommerce' ); ?></h3>
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'bre-bootstrap-ecommerce' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'bre-bootstrap-ecommerce' ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar( 'blog' ); ?>
<?php get_footer(); ?>
