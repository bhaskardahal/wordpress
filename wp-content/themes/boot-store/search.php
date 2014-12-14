<?php
/**
 * The template for displaying Search Results pages.
 * Boot Store theme is based on Twentytwelve theme. The official WordPress theme.
 *
 * @package WordPress
 * @subpackage Boot Store
 * @since Boot Store 1.0
 */

get_header();

if ( ! is_active_sidebar( 'sidebar-1' ) ) $col_width = 'span12';
else $col_width = 'span9'; ?>

	<section id="primary" class="site-content <?php echo $col_width; ?>">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			
			<?php $out = array();
			while ( have_posts() ) : the_post();
				ob_start();
				get_template_part( 'content', 'search' );
				$html = ob_get_clean();
				$post_type = get_post_type( get_the_ID() );
				$out[$post_type][] = $html;
			endwhile; ?>

			<?php foreach( $out as $post_type => $post_types ) :
				$post_type_def = get_post_type_object($post_type); ?>

					<h3 class="posttype-title box-title"><?php printf( __( '%s: Results for %s', 'bre-bootstrap-ecommerce' ), '<strong>' . $post_type_def->labels->name . '</strong>', '<span>' . get_search_query() . '</span>' ); ?></h3>

				<?php foreach( $post_types as $html ) : ?>

					<?php echo $html; ?>

				<?php endforeach; ?>					

			<?php endforeach; ?>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'bre-bootstrap-ecommerce' ); ?></h1>
				</header>

				<div class="entry-content clearfix">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'bre-bootstrap-ecommerce' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>