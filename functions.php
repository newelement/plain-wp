<?php
require get_template_directory() . '/inc/setup.php';

function theme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'theme_widgets_init' );


function theme_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}
	
	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $sep " . sprintf( __( 'Page %s' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'theme_wp_title', 10, 2 );







/* YOUR SCRIPTS AND STYLES
*
* This theme uses CodeKit to compile scripts and styles.
* 
*
*/

function theme_scripts() {

    // Load concatenated and minified stylesheet
	wp_enqueue_style( 'main-style', get_stylesheet_uri() );
	// Modernizr has to load in the <head>
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/vendor/modernizr/modernizr-2.7.1.min.js', array(), '20140311' );
	// Load all other concatenated and minified scripts in the footer
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.min.js', array(), '20120204', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );







/*
*
* Theme helper functions
*
*
*/

if ( ! function_exists( 'theme_paging_nav' ) ) :
function theme_paging_nav() {

	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;


if ( ! function_exists( 'theme_post_nav' ) ) :
function theme_post_nav() {

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'kirkpatrickprice' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'kirkpatrickprice' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'kirkpatrickprice' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

// Formats the page content
if ( ! function_exists( 'page_content' ) ) :
function page_content($content){
    
    return apply_filters('the_content', $content);
    
}
endif;




function theme_category_transient_flusher() {
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'theme_category_transient_flusher' );
add_action( 'save_post',     'theme_category_transient_flusher' );
?>