<?php
/**
 * The Template for displaying all single posts.
 *
 * @subpackage New life
 * @since New life 1.8
 */

get_header(); ?>
<?php get_sidebar(); ?>
<div class="content">
	<?php global $wp_query;
		while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="newlife-date-back">
						<div class="newlife-date-post">
							<p class='newlife-month'><?php the_date( 'M' );?></p>
							<p class='newlife-day'><?php the_time( 'j' );?></p>			
						</div><!-- .newlife-date-post -->
					</div><!-- .newlife-date-back -->
				<div class="newlife-post-title"><?php the_title(); ?></div>
				<div class="newlife-entry-content">
					<?php if ( has_post_thumbnail() ) {
						the_post_thumbnail();
					} ?>
					<?php the_content( __( 'Continue reading', 'newlife' ).' <span class="meta-nav">&rarr;</span>' ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'newlife' ), 'after' => '</div>' ) ); ?>
				</div><!-- .newlife-entry-content -->
				<div class="entry-utility">
					<?php if ( count( get_the_category() ) ) : ?>
						<span class="cat-links">
							<?php printf( '<span class="%1$s">'.__( 'Posted in', 'newlife' ).'</span> %2$s', 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
						</span>
						<span class="meta-sep">|</span>
					<?php endif; ?>
					<?php
					$tags_list = get_the_tag_list( '', ', ' );
					if ( $tags_list ): ?>
						<span class="tag-links">
							<?php printf( '<span class="%1$s">'.__( 'Tagged', 'newlife' ).'</span> %2$s', 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
						</span>
						<span class="meta-sep">|</span>
					<?php endif; 
					if ( is_attachment() && wp_attachment_is_image() ) { 
						the_excerpt(); ?>
						<div id="nav-below" class="newlife-navigation">
							<div class="newlife-nav-previous"><?php previous_image_link( false, '&larr; '.__( 'Previous image', 'newlife' ) ); ?></div>
							<div class="newlife-nav-next"><?php next_image_link( false, __( 'Next image', 'newlife' ).' &rarr;' ); ?></div>
							<div class="clear"></div>
						</div><!-- #nav-below -->
					<?php } ?>
					<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'newlife' ), __( '1 Comment', 'newlife' ), '% '.__( 'Comments', 'newlife' ), __( 'Comments Off', 'newlife' ) ); ?></span>
					<?php edit_post_link( __( 'Edit', 'newlife' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-utility -->
			</div><!-- #post-## -->
			<div class='clear'></div>	
			<?php comments_template( '', true ); 
		endwhile;
		if ( ! wp_attachment_is_image() ) { ?>
			<div id="nav-below" class="newlife-navigation">
				<div class="newlife-nav-previous"><?php previous_post_link( '%link', '<span class="newlife-read-more">&larr; '.__( 'Older', 'newlife' ).'</span>' ); ?></div>
				<div class="newlife-nav-next"><?php next_post_link( '%link', '<span class="newlife-read-more">'.__( 'Newer', 'newlife' ).' &rarr;</span>' ); ?></div>
			</div><!-- #nav-below -->
		<?php } ?>

</div><!-- #content -->
<?php get_footer(); ?>
