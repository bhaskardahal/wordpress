<?php
/**
 * Template Name: Community template
 *
 * Description: A page template that provides a key component of WordPress as a Buddypress community using buddypress plugin
 * Boot Store theme is based on Twentytwelve theme. The official WordPress theme.
 *
 * @package WordPress
 * @subpackage Boot Store
 * @since Boot Store 1.0
 */

get_header();

if ( ! is_active_sidebar( 'sidebar-buddypress' ) ) $col_width = 'span12';
else $col_width = 'span9'; ?>

	<div id="primary" class="site-content <?php echo $col_width; ?>">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar('buddypress'); ?>
<?php get_footer(); ?>