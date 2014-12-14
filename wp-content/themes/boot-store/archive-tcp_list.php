<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Boot Store already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
			<header class="archive-header">
				<h1 class="archive-title">
					<?php printf( $wp_query->queried_object->labels->name ); ?>&nbsp; 
					<?php if ( is_day() ) :
						printf( __( '%s', 'bre-bootstrap-ecommerce' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( '%s', 'bre-bootstrap-ecommerce' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'bre-bootstrap-ecommerce' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( '%s', 'bre-bootstrap-ecommerce' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'bre-bootstrap-ecommerce' ) ) . '</span>' );
					endif; ?>
				</h1>
			</header><!-- .archive-header -->

			<?php if ( is_active_sidebar( 'sidebar-layered' ) ) : ?>
				<div class="horizontal-layered">
					<?php dynamic_sidebar( 'sidebar-layered' ); ?>
				</div>
			<?php endif; ?>

			<?php /* Start the Loop */
				get_template_part( 'loop-tcp-list' );
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
