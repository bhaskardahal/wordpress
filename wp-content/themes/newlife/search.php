<?php /**
 * The template for displaying Search Results pages.
 *
 * @subpackage New life
 * @since New life 1.8
 */

get_header(); ?>
<?php get_sidebar(); ?>
<div class="content">
	<?php if ( have_posts() ) : ?>
		<h1 class="newlife-title-content"><?php printf( __( 'Search Results for:', 'newlife' ).' %s', '<span>' . get_search_query() . '</span>' ); ?></h1>
		<?php while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="newlife-date-back">
					<div class="newlife-date-post">
						<p class='newlife-month'><?php the_time( 'M' );?></p>
						<p class='newlife-day'><?php the_time( 'j' );?></p>			
					</div>		
				</div>
				<div class="newlife-title-news"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
				<div class="entry-utility">
					<?php the_excerpt(); ?>
					<div class="newlife-read-more"><a href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>"><?php _e( 'read more', 'test' );?></a></div>
					<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'newlife' ), __( '1 Comment', 'newlife' ), '% '.__( 'Comments', 'newlife' ), __( 'Comments Off', 'newlife' ) ); ?></span>
					<?php edit_post_link( __( 'Edit', 'newlife' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
				</div>
			</div>
			<div class='clear'></div>	
			<?php comments_template( '', true ); ?>
		<?php endwhile;?>
		<?php if ( $wp_query->max_num_pages > 1 ) : ?>
			<?php previous_posts_link( '<span class="newlife-read-more">'.__( 'Newer', 'newlife' ).' &rarr;</span>' ); ?>
			<?php next_posts_link( '<span class="newlife-read-more">&larr; '.__( 'Older', 'newlife' ).'</span>' ); ?>
		<?php endif; ?>
		<?php else : ?>
			<div id="post-0" class="post no-results not-found">
				<h2 class="newlife-title-content"><?php print( __( 'Nothing Found','newlife' ) );?></h2>
				<div class="newlife-entry-content">
					<p><?php print( __( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.','newlife' ) );?></p>
				</div><!-- .newlife-entry-content -->
			</div><!-- #post-0 -->
	<?php endif; ?>
</div><!-- content -->
<?php get_footer(); ?>
