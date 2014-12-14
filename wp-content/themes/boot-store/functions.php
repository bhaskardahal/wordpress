<?php
/**
 * Boot Store functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 * Boot Store theme is based on Twentytwelve theme. The official WordPress theme.
 *
 * @package WordPress
 * @subpackage Boot Store
 * @since Boot Store 1.0
 */

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 870;

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Boot Store supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 */
function bre_setup() {
	/*
	 * Makes Boot Store available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Boot Store, use a find and replace
	 * to change 'bre-bootstrap-ecommerce' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'bre-bootstrap-ecommerce', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'bre-bootstrap-ecommerce' ) );

	// This theme uses extra menus wp_nav_menu() in one location.
	register_nav_menu( 'secondary-menu', __( 'Secondary Menu', 'bre-bootstrap-ecommerce' ) );

	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'D7EDFB',
		'default-image' => get_template_directory_uri() . '/images/background.jpg',
	) );

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 870, 9999 );

	add_image_size( '150cropped', 150, 150, true );
	add_image_size( '270cropped', 270, 270, true );

	add_image_size( 'height90', 9999, 90 );   /* 120x90  4:3 */
	add_image_size( 'height135', 9999, 135 ); /* 180x135 4:3 */
	add_image_size( 'height195', 9999, 192 ); /* 256x192 4:3 */
	add_image_size( 'height270', 9999, 270 ); /* 360x270 4:3 */
	add_image_size( 'height360', 9999, 360 ); /* 440x360 4:3 */


	// excerpt support for pages
	add_post_type_support( 'page', 'excerpt' );

}
add_action( 'after_setup_theme', 'bre_setup' );


/**
 * Filter callback to add image sizes to Media Uploader
 *
 * WP 3.3 beta adds a new filter 'image_size_names_choose' to
 * the list of image sizes which are displayed in the Media Uploader
 * after an image has been uploaded.
 *
 * See image_size_input_fields() in wp-admin/includes/media.php
 * 
 *
 * @uses get_intermediate_image_sizes()
 *
 * @param $sizes, array of default image sizes (associative array)
 * @return $new_sizes, array of all image sizes (associative array)
 */
function bre_display_image_size_names_muploader( $sizes ) {
	
	$new_sizes = array();
	
	$added_sizes = get_intermediate_image_sizes();
	
	// $added_sizes is an indexed array, therefore need to convert it
	// to associative array, using $value for $key and $value
	foreach( $added_sizes as $key => $value) {
		$new_sizes[$value] = $value;
	}
	
	// This preserves the labels in $sizes, and merges the two arrays
	$new_sizes = array_merge( $new_sizes, $sizes );
	
	return $new_sizes;
}
add_filter('image_size_names_choose', 'bre_display_image_size_names_muploader', 11, 1);

/**
 * Adds support for a custom header image.
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Enqueues scripts and styles for front-end.
 *
 * @since Boot Store 1.0
 */

function bre_scripts_styles() {
	global $wp_styles;


	// Loads Bootstrap CSS
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), null );

	/*
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'bre-style', get_stylesheet_uri() );

	/*
	 * Loads the Internet Explorer specific stylesheet.
	 */
	wp_enqueue_style( 'bre-ie', get_template_directory_uri() . '/css/ie.css', array( 'bre-style' ), '20121010' );
	$wp_styles->add_data( 'bre-ie', 'conditional', 'lt IE 9' );


	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	
	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'respond'		, get_template_directory_uri() . '/js/respond.min.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'bootstrap'		, get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'bre_bootstrap'	, get_template_directory_uri() . '/js/bre-bootstrap.js', array( 'jquery' ), '1.0', true );

	/*
	 * Loads our special font CSS file.
	 *
	 * The use of Open Sans by default is localized. For languages that use
	 * characters not supported by the font, the font can be disabled.
	 *
	 * To disable in a child theme, use wp_dequeue_style()
	 * function mytheme_dequeue_fonts() {
	 *     wp_dequeue_style( 'bre-fonts' );
	 * }
	 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
	 */

	/* translators: If there are characters in your language that are not supported
	   by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'bre-bootstrap-ecommerce' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Open Sans character subset specific to your language, translate
		   this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language. */
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'bre-bootstrap-ecommerce' );

		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $subset )
			$subsets .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Open+Sans:400italic,700italic,400,600,700',
			'subset' => $subsets,
		);
		wp_enqueue_style( 'bre-fonts', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );
	}


}
add_action( 'wp_enqueue_scripts', 'bre_scripts_styles' );

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Boot Store 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function bre_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'bre-bootstrap-ecommerce' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'bre_wp_title', 10, 2 );

/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since Boot Store 1.0
 */
function bre_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'bre_page_menu_args' );

/**
 * Registers our main widget area and the front page widget areas.
 *
 * @since Boot Store 1.0
 */
function bre_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Store/Site Sidebar', 'bre-bootstrap-ecommerce' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on Store pages', 'bre-bootstrap-ecommerce' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Blog Sidebar', 'bre-bootstrap-ecommerce' ),
		'id' => 'sidebar-blog',
		'description' => __( 'Appears in blog templates: archive, single, category and author templates', 'bre-bootstrap-ecommerce' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Site Pages Sidebar', 'bre-bootstrap-ecommerce' ),
		'id' => 'sidebar-page',
		'description' => __( 'Appears in pages', 'bre-bootstrap-ecommerce' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Shoppingcart/Checkout Pages Sidebar', 'bre-bootstrap-ecommerce' ),
		'id' => 'sidebar-shoppingcart-checkout',
		'description' => __( 'Appears in shoppingcart-checkout template', 'bre-bootstrap-ecommerce' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Author Page Sidebar', 'bre-bootstrap-ecommerce' ),
		'id' => 'sidebar-author',
		'description' => __( 'Appears in author template', 'bre-bootstrap-ecommerce' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Customer Account Pages Sidebar', 'bre-bootstrap-ecommerce' ),
		'id' => 'sidebar-account',
		'description' => __( 'Appears in Customer Account Pages templates', 'bre-bootstrap-ecommerce' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Community Sidebar', 'bre-bootstrap-ecommerce' ),
		'id' => 'sidebar-buddypress',
		'description' => __( 'Appears in Buddypress community templates', 'bre-bootstrap-ecommerce' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
		register_sidebar( array(
		'name' => __( 'In TCP loop', 'bre-bootstrap-ecommerce' ),
		'id' => 'sidebar-loop-details',
		'description' => __( 'Appears in tcp loops, after excerpt', 'bre-bootstrap-ecommerce' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
		register_sidebar( array(
		'name' => __( 'Below the purchase area', 'bre-bootstrap-ecommerce' ),
		'id' => 'sidebar-buying-area',
		'description' => __( 'Appears in product details page, below the purchase area', 'bre-bootstrap-ecommerce' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Product Detail Tab 1', 'bre-bootstrap-ecommerce' ),
		'id' => 'sidebar-product-tab1',
		'description' => __( 'Second tab in single product page', 'bre-bootstrap-ecommerce' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Product Detail Tab 2', 'bre-bootstrap-ecommerce' ),
		'id' => 'sidebar-product-tab2',
		'description' => __( 'Third tab in single product page', 'bre-bootstrap-ecommerce' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Product Detail Tab 3', 'bre-bootstrap-ecommerce' ),
		'id' => 'sidebar-product-tab3',
		'description' => __( 'Fourth tab in single product page', 'bre-bootstrap-ecommerce' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Cross Sales/Content Sidebar', 'bre-bootstrap-ecommerce' ),
		'id' => 'sidebar-cross',
		'description' => __( 'Appears after the content in single, category, single-product and taxonomy templates (blog and store). Cross sales and cross content !', 'bre-bootstrap-ecommerce' ),
		'before_widget' => '<aside id="%1$s" class="cross-content %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Horizontal Layered Navigation support', 'bre-bootstrap-ecommerce' ),
		'id' => 'sidebar-layered',
		'description' => __( 'Add support for horizontal layered navigation. Appears before the loop in taxonomy template. ', 'bre-bootstrap-ecommerce' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
	register_sidebar( array(
		'name' => __( 'First Front Page Widget Area', 'bre-bootstrap-ecommerce' ),
		'id' => 'sidebar-2',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'bre-bootstrap-ecommerce' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Second Front Page Widget Area', 'bre-bootstrap-ecommerce' ),
		'id' => 'sidebar-3',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'bre-bootstrap-ecommerce' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'First footer Widget Area', 'bre-bootstrap-ecommerce' ),
		'id' => 'sidebar-footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Second footer Widget Area', 'bre-bootstrap-ecommerce' ),
		'id' => 'sidebar-footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Third footer Widget Area', 'bre-bootstrap-ecommerce' ),
		'id' => 'sidebar-footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'bre_widgets_init' );

if ( ! function_exists( 'bre_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Boot Store 1.0
 */
function bre_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'bre-bootstrap-ecommerce' ); ?></h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'bre-bootstrap-ecommerce' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'bre-bootstrap-ecommerce' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;

if ( ! function_exists( 'bre_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own bre_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Boot Store 1.0
 */
function bre_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'bre-bootstrap-ecommerce' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'bre-bootstrap-ecommerce' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'bre-bootstrap-ecommerce' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'bre-bootstrap-ecommerce' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation alert alert-info"><?php _e( 'Your comment is awaiting moderation.', 'bre-bootstrap-ecommerce' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'bre-bootstrap-ecommerce' ), '<p class="edit-link btn btn-mini">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'bre-bootstrap-ecommerce' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'bre_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own bre_entry_meta() to override in a child theme.
 *
 * @since Boot Store 1.0
 */
function bre_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'bre-bootstrap-ecommerce' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'bre-bootstrap-ecommerce' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'bre-bootstrap-ecommerce' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'bre-bootstrap-ecommerce' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'bre-bootstrap-ecommerce' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'bre-bootstrap-ecommerce' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

/**
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since Boot Store 1.0
 *
 * @param array Existing class values.
 * @return array Filtered class values.
 */
function bre_body_class( $classes ) {
	$background_color = get_background_color();

	if ( is_page_template( 'page-templates/full-width.php' ) ):
				$classes[] = 'full-width';
	endif;
	if ( is_page_template( 'page-templates/page-account.php' ) ):
				$classes[] = 'template-page-account';
	endif;
	if ( is_page_template( 'page-templates/page-blog.php' ) ):
				$classes[] = 'template-page-blog';
	endif;
	if ( is_page_template( 'page-templates/page-shoppingcart-checkout.php' ) ):
				$classes[] = 'template-page-shoppingcart-checkout';
	endif;



	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}

	if ( is_page_template( 'page-templates/full-width-carousel.php' ) ) {
		$classes[] = 'full-width-carousel';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}


	if ( empty( $background_color ) )
		$classes[] = 'custom-background-empty';
	elseif ( in_array( $background_color, array( 'D7EDFB' ) ) )
		$classes[] = 'custom-background-default';

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'bre-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	return $classes;
}
add_filter( 'body_class', 'bre_body_class' );

/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since Boot Store 1.0
 */
function bre_content_width() {
	if ( is_page_template( 'page-templates/fullwidth-carouselheader.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
		global $content_width;
		$content_width = 870;
	}
}
add_action( 'template_redirect', 'bre_content_width' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since Boot Store 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function bre_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'bre_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Boot Store 1.0
 */
function bre_customize_preview_js() {
	wp_enqueue_script( 'bre-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20120827', true );
}
add_action( 'customize_preview_init', 'bre_customize_preview_js' );

/* Free label */
function bre_tcp_get_the_price_label( $label, $post_id, $price ) {
	if ( $price == 0 ) return '<span class="tcp_free">' . __( 'Free', 'bre-bootstrap-ecommerce' ) . '</span>';
	return $label;
}
add_filter( 'tcp_get_the_price_label', 'bre_tcp_get_the_price_label', 10, 3 );

/* bootStrap shortcode support WordPress editor */
require_once( trailingslashit( get_template_directory() ) . 'admin/bootstrap-shortcode.php' );

/* Theme options setup */
require_once( trailingslashit( get_template_directory() ) . 'admin/update-version.php' );
require_once( trailingslashit( get_template_directory() ) . 'admin/bootstrap-ecommerce-support.class.php' );
require_once( trailingslashit( get_template_directory() ) . 'admin/bootstrap-ecommerce-setup.class.php' );
require_once( trailingslashit( get_template_directory() ) . 'admin/boostrap-carousel.class.php' );

if ( function_exists( 'bp_loggedin_user_avatar' ) ) {
	require_once( trailingslashit( get_template_directory() ) . 'admin/BPLoginWidget.class.php' );
}

/* Only show admin bar to authors */
if ( ! current_user_can( 'edit_posts' ) ) :
	show_admin_bar( false );
endif;

/* Login Logout redirect */
function redirect_me() {
	//if the user has rights of editor then return don't do anything
	//if(current_user_can('editor')) return;
	//get the reffer or you may user home_url() if the "request_to" is not set
	$logout_redirect_url = $_SERVER['HTTP_REFERER'];
	if( ! empty( $_REQUEST['redirect_to'] ) ) wp_safe_redirect( $_REQUEST['redirect_to'] );
	else wp_redirect( $logout_redirect_url );
	exit();
}
add_filter('wp_logout', 'redirect_me');

//redirect user to their buddypress profile if they are trying to view their wp profile
 
function bre_redirect_user_to_bp_profile() {
	if ( ! defined( 'IS_PROFILE_PAGE' ) ) return false;//if this is not the profile page, do not do anything
	if ( ! function_exists( 'bp_core_get_user_domain' ) ) return ;
	$current_user = wp_get_current_user();
	$bp_profile_link = bp_core_get_user_domain( $current_user->ID);
	bp_core_redirect( $bp_profile_link );
}
add_action('admin_init', 'bre_redirect_user_to_bp_profile');

function bre_link_to_bp_profile( $actions,$user ) {
	if ( ! function_exists( 'bp_core_get_user_domain' ) ) return $actions;
	$bp_profile_link = bp_core_get_user_domain( $user->ID );
	$actions['profile'] = "<a href='".$bp_profile_link."'>Profile</a>";//hook our link
	return $actions;
}
add_filter( 'user_row_actions', 'bre_link_to_bp_profile', 10, 2 );//hook our link to row actions

function bre_ecommerce_upgrade() { ?>
<div style="padding:2px; background:url('<?php echo get_template_directory_uri(); ?>/images/birds.jpg') no-repeat;text-align:left;padding-left:20px;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px;-khtml-border-radius:5px;">

	<p style="color:white;font-weight:bold;font-size:3em;text-shadow: -1px -1px white, 1px 1px #333"><?php echo wp_get_theme(); ?></p>

	<p class="socials" style="text-align:left;">
		<span class="social twitter">
			<a href="https://twitter.com/thecartpress" class="twitter-follow-button" data-show-count="false" data-size="small">Follow @thecartpress</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</span>
		<span class="social facebook">
			<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fthecartpress.com%2F&amp;send=false&amp;layout=button_count&amp;width=200&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:21px;" allowTransparency="true"></iframe>
		</span>
	</p>
</div>
<p style="text-align:center;">
	<span>
		<a class="button" href="http://thecartpress.com" target="_blank" style="">TheCartPress Site</a>
	</span>
	<span>
		<a class="button" href="http://extend.thecartpress.com" target="_blank">Extend: Plugins & Themes</a>
	</span>
	<span>
		<a class="button" href="http://community.thecartpress.com" target="_blank">Support</a>
	</span>
</p>
<?php }

function bre_register_taxonomy_brand() {
	if ( function_exists( 'tcp_exist_custom_taxonomy' ) && ! tcp_exist_custom_taxonomy( 'tcp_product_brand' ) ) {
		$labels = array(
			'name'			=> _x( 'Brand', 'taxonomy general name', 'bre-bootstrap-ecommerce' ),
			'desc'			=> __( 'Brands for products', 'bre-bootstrap-ecommerce' ),
			'singular_name'	=> _x( 'Brand', 'taxonomy singular name', 'bre-bootstrap-ecommerce' ),
			'search_items'	=> __( 'Search Brands', 'bre-bootstrap-ecommerce' ),
			'all_items'		=> __( 'All Brands', 'bre-bootstrap-ecommerce' ),
			'parent_item'	=> __( 'Parent Brand', 'bre-bootstrap-ecommerce' ),
			'parent_item_colon'	=> __( 'Parent Brand', 'bre-bootstrap-ecommerce' ),
			'edit_item'		=> __( 'Edit Brand', 'bre-bootstrap-ecommerce' ), 
			'update_item'	=> __( 'Update Brand', 'bre-bootstrap-ecommerce' ),
			'add_new_item'	=> __( 'Add New Brand', 'bre-bootstrap-ecommerce' ),
			'new_item_name'	=> __( 'New Brand Name', 'bre-bootstrap-ecommerce' ),
		);
		$args = array(
			'labels' => $labels,
			'post_type'		=> TCP_PRODUCT_POST_TYPE,
			'hierarchical'	=> true,
			'query_var'		=> true, //'cat_prods',
			'label'			=> __( 'Brand', 'bre-bootstrap-ecommerce' ),
			'rewrite'		=> 'product_brand',
		);
		register_taxonomy( 'tcp_product_brand', array( TCP_PRODUCT_POST_TYPE ), $args );
	}
}
add_action( 'init', 'bre_register_taxonomy_brand' );

function bre_is_active_sidebar_and_empty( $sidebar_id ) {
	if ( ! is_active_sidebar( $sidebar_id ) ) return '';
	ob_start();
	dynamic_sidebar( $sidebar_id );
	$out = ob_get_clean();
	return trim( $out );
}

//
//to disable Compatibility settings
//
function bre_tcp_get_setting( $value, $setting_name, $default_value ) {
	if ( 'load_bootstrap_css' == $setting_name || 'load_bootstrap_responsive_css' == $setting_name || 'load_bootstrap_js' == $setting_name ) return false;
	if ( 'see_buy_button_in_content' == $setting_name || 'see_price_in_content' == $setting_name || 'see_image_in_content' == $setting_name ) return false;
	if ( 'use_default_loop' == $setting_name ) return 'only_settings';

	if ( 'load_default_buy_button_style' == $setting_name ) return true;
	if ( 'load_default_shopping_cart_checkout_style' == $setting_name ) return true;
	if ( 'load_default_loop_style' == $setting_name ) return true;
	return $value;
}
add_filter( 'tcp_get_setting', 'bre_tcp_get_setting', 10, 3 );

function bre_tcp_theme_compatibility_settings_page( $suffix, $thecartpress ) { ?>
<script>
	jQuery( '#use_default_loop_only' ).attr( 'disabled', true );
	jQuery( '#tcp_theme_compatibility_yes' ).attr( 'disabled', true );
	jQuery( '#use_default_loop_none' ).attr( 'disabled', true );
	jQuery( '#load_bootstrap_css' ).attr( 'disabled', true );
	jQuery( '#load_bootstrap_responsive_css' ).attr( 'disabled', true );
	jQuery( '#load_bootstrap_js' ).attr( 'disabled', true );
	jQuery( '#see_buy_button_in_content' ).attr( 'disabled', true );
	jQuery( '#align_buy_button_in_content' ).attr( 'disabled', true );
	jQuery( '#see_price_in_content' ).attr( 'disabled', true );
	jQuery( '#see_image_in_content' ).attr( 'disabled', true );
	jQuery( '#image_size_content' ).attr( 'disabled', true );
	jQuery( '#image_align_content' ).attr( 'disabled', true );
	jQuery( '#image_link_content' ).attr( 'disabled', true );
	jQuery( '#load_default_buy_button_style' ).attr( 'disabled', true );
	jQuery( '#load_default_shopping_cart_checkout_style' ).attr( 'disabled', true );
	jQuery( '#load_default_loop_style' ).attr( 'disabled', true );
</script>
<?php }
add_action( 'tcp_theme_compatibility_settings_page', 'bre_tcp_theme_compatibility_settings_page', 10, 2 );

function bre_string( $context, $name, $value ) {
	if ( function_exists( 'tcp_string' ) ) return tcp_string( $context, $name, $value );
	else return $value;
}

if ( ! function_exists( 'tcp_the_excerpt' ) ) {
/**
 * Returns the excerpt of the given post
 * @since 1.5.8
 */
function bre_the_excerpt( $post_id = 0, $length = 0 ) { // Max excerpt length. Length is set in characters
	if ( $post_id == 0 ) $post_id = get_the_ID();
	$post = get_post( $post_id );
	$text = $post->post_excerpt;
	$text = apply_filters( 'the_excerpt', $text );
	$see_points = false;
	if ( strlen( $text ) == 0 ) {
		$text = bre_get_the_content( $post_id );
		$text = strip_tags( $text, '<p><br><style>' ); // use ' $text = strip_tags($text,'&lt;p&gt;&lt;a&gt;'); ' if you want to keep some tags
		$see_points = true;
	}
	$text = strip_shortcodes( $text ); // optional, recommended

//	if ( $length > 0 ) $text = substr( $text, 0, $length );
	if ( $length > 0 ) {
		$initial_length = strlen( $text );
		$text = explode( ' ', $text );
		array_splice( $text, $length );
		$text = implode( ' ', $text );
		$see_points = $initial_length > strlen( $text );
	}
	if ( $see_points && strlen( $text ) ) {
		if ( function_exists( 'tcp_get_permalink' ) ) {
			$permalink = tcp_get_permalink( $post_id );
		} else {
			$permalink = get_permalink( $post_id );
		}
		$text .= sprintf( ' <a href="%s">[...]</a>', $permalink );
	}
	echo $text;
}

/**
 * Returns the content of the given post
 * @since 1.5.8
 */
function bre_get_the_content( $post_id = 0, $echo = false ) {
	$post = get_post( $post_id );
	$content = $post->post_content;
	$content = apply_filters( 'the_content', $content );
	$content = str_replace(']]>', ']]>', $content);
	if ( $echo ) echo $content;
	else return $content;
}

}//function_exists( 'tcp_the_excerpt' )
