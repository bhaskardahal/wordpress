<?php
/**
 * The template for displaying Author Archive pages.
 *
 * Used to display archive-type pages for posts by an author.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 * Boot Store theme is based on Twentytwelve theme. The official WordPress theme.
 *
 * @package WordPress
 * @subpackage Boot Store
 * @since Boot Store 1.0
 */

get_header(); ?>

	<section id="primary" class="site-content span9">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>

			<?php
				/* Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				 *
				 * We reset this later so we can run the loop
				 * properly with a call to rewind_posts().
				 */
				the_post();
			?>


			<?php
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();
			?>

			<?php bre_content_nav( 'nav-above' ); ?>

				<div class="author-header media">
					<div class="author-avatar pull-left">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'tcp_author_bio_avatar_size', 60 ) ); ?>
					</div><!-- #author-avatar -->
					<div class="author-description media-body">

					<?php if ( function_exists( 'bp_is_active' ) && bp_is_active( 'xprofile' ) ) { ?>
						<h2><?php printf( esc_attr__( 'Author &#187; %s', 'tcp' ), get_the_author_meta('display_name') ); ?></h2>
						<?php if ( get_the_author_meta( 'description') ) { // If a user has filled out their description, show a bio on their products
							the_author_meta( 'description');
						} ?>
					<?php } else { ?>
						<h2><?php printf( esc_attr__( 'Author: &#187; %s', 'tcp' ), get_the_author_meta('display_name') ); ?></h2>
						<?php if ( get_the_author_meta( 'description') ) { // If a user has filled out their description, show a bio on their products
							the_author_meta( 'description');
						}
					} ?>

					</div><!-- .author-description -->
				</div><!-- .entry-author-info -->

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

				<h3 class="posttype-title box-title"><a href="#post-type-tab-<?php echo $post_type; ?>" data-toggle="tab"><?php echo $post_type_def->labels->name; ?></a></h3>

				<?php foreach( $post_types as $html ) : ?>

					<?php echo $html; ?>

				<?php endforeach; ?>					

			<?php endforeach; ?>

			<?php bre_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar('author'); ?>
<?php get_footer(); ?>
