<?php get_header(); ?>
	<div id="newlife-home-head">
		<div id="newlife-block-head"></div>
		<div id="newlife-block-searches">
			<?php if ( get_header_image() ) { ?>
				<div id="newlife-legend-without-background">
					<img src="<?php header_image(); ?>" width="<?php echo $custom_header_support['width']; ?>" height="<?php echo $custom_header_support['height']; ?>" alt="" />
				</div>				
			<?php } 
			else { ?>
				<div id="newlife-legend-background"></div>
			<?php } ?>
			<div id="newlife-searches">
				<?php $i = 0;
				$number_of_posts = 3;
				while ( have_posts() && $i < $number_of_posts ) : the_post(); ?>
					<div class="newlife-title-searches"><p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p></div>
					<div class="newlife-content-searches"><?php the_excerpt(); ?></div>
					<?php $i++;
				endwhile; ?>
			</div><!-- #newlife-searches -->
			<div class='clear'></div>
		</div><!-- #newlife-block-searches -->
		<div id="newlife-search-block">
			<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<p><input type="text" class="newlife-field" name="s" id="s" value="<?php _e( 'Search ...','newlife' );?>"/></p>
			</form>
		</div><!-- #newlife-search-block -->
		<div id="newlife-angle"></div>
	</div><!-- #newlife-home-head-->
	<?php get_sidebar(); ?>
	<div class="newlife-content-home content">
		<div id="newlife-page-child">
			<?php $i = 0 ;
			$number_of_posts = get_option( 'posts_per_page' ) - 3;
			while ( have_posts() && $i <= $number_of_posts ) : the_post();
				if( $i == 0 || $i == ceil( $number_of_posts / 2 ) ) { ?>
					<div class="page_content<?php if( $i == ceil( $number_of_posts / 2 ) ) echo "_last"; ?>">
				<?php } ?>
					<div class="newlife-title-content-post" ><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
					<?php if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'thumbnail' );
					}
					the_content(); ?>
					<div class="entry-utility">
						<?php if ( count( get_the_category() ) ) : ?>
							<span class="cat-links">
								<?php printf( '<span class="%1$s">'.__( 'Posted in', 'newlife' ).'</span> %2$s', 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
							</span>
							<span class="meta-sep">|</span>
						<?php endif; ?>
						<?php $tags_list = get_the_tag_list( '', ', ' );
						if ( $tags_list ): ?>
							<span class="tag-links">
								<?php printf( '<span class="%1$s">'.__( 'Tagged', 'newlife' ).'</span> %2$s', 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
							</span>
							<span class="meta-sep">|</span>
						<?php endif; ?>
						<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'newlife' ), __( '1 Comment', 'newlife' ), '% '.__( 'Comments', 'newlife' ), __( 'Comments Off', 'newlife' ) ); ?></span>
						<?php edit_post_link( __( 'Edit', 'newlife' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-utility -->
				<?php if ( $i + 1 == ceil( $number_of_posts / 2 ) ) { ?> 
					</div><!-- #page_content -->
					<div class="newlife-line-home"></div>
				<?php }
				if( $i == $number_of_posts || $i + 1 == $wp_query->post_count - 3 ) { ?>
					</div>
				<?php } 
				$i++;
			endwhile; //end of The Loop ?>
		<div class="clear"></div>
		<?php if (  $wp_query->max_num_pages > 1 ) : ?>
			<div id="nav-below" class="newlife-navigation">
				<div class="newlife-nav-previous"><?php next_posts_link( '<span class="meta-nav">&larr;</span> ' . __( 'Older posts', 'newlife' ) ); ?></div>
				<div class="newlife-nav-next"><?php previous_posts_link( __( 'Newer posts', 'newlife' ) . ' <span class="meta-nav">&rarr;</span>' ); ?></div>
			</div><!-- #nav-below -->
		<?php endif; ?>
		</div><!-- #newlife-page-child -->
	</div><!-- #content -->
<?php get_footer(); ?>
