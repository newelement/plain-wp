<?php
if ( ! function_exists( 'theme_setup' ) ) :
function theme_setup() {

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
    
    register_nav_menus( array(
		'primary' => __( 'Primary Menu' )
	) );
	
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );
	
	move_utility_files();
	
}
endif;


function theme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}


function move_utility_files(){

    $template_path = get_template_directory();
    $webroot = ABSPATH;
    
    if( is_writable($webroot) ){
    
        copy($template_path.'/utility/crossdomain.xml', $webroot.'/crossdomain.xml');
        copy($template_path.'/utility/humans.txt', $webroot.'/humans.txt');
        copy($template_path.'/utility/robots.txt', $webroot.'/robots.txt');
    
    } else {
        add_action('admin_notices', create_function('', "echo '<div class=\"error\"><p>Cannot move files. Please copy these files from the theme's /utility/ folder to your web root. crossdomain.xml, humans.txt and robots.txt </p></div>';") );   
    }
    
}


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

// This creates a sample page of default theme styles
if ( is_admin() && isset($_GET['activated'] ) && $pagenow === "themes.php" ) {

    $page_check = get_page_by_title('Styles');
    $page_check_id = $page_check->ID;
    
    $new_page = array(
        'post_type' => 'page',
        'post_title' => 'Styles',
        'post_status' => 'publish',
        'post_author' => 1
    );
    
    if(!isset($page_check_id)){
        wp_insert_post($new_page);
    }
    
}

function htaccess_writable() {
  if (!is_writable(get_home_path() . '.htaccess')) {
    if (current_user_can('administrator')) {
      add_action('admin_notices', create_function('', "echo '<div class=\"error\"><p>Please make sure your .htaccess file is writable</p></div>';") );
    }
  }
}

//Add HTML5 Boilerplate's .htaccess via WordPress
function add_h5bp_htaccess($content) {
  global $wp_rewrite;
  $home_path = function_exists('get_home_path') ? get_home_path() : ABSPATH;
  $htaccess_file = $home_path . '.htaccess';
  $mod_rewrite_enabled = function_exists('got_mod_rewrite') ? got_mod_rewrite() : false;

  if ((!file_exists($htaccess_file) && is_writable($home_path) && $wp_rewrite->using_mod_rewrite_permalinks()) || is_writable($htaccess_file)) {
    if ($mod_rewrite_enabled) {
      $h5bp_rules = extract_from_markers($htaccess_file, 'HTML5 Boilerplate');
      if ($h5bp_rules === array()) {
        $filename = get_template_directory() . '/utility/.h5bp-htaccess';
        return insert_with_markers($htaccess_file, 'HTML5 Boilerplate', extract_from_markers($filename, 'HTML5 Boilerplate'));
      }
    }
  }

  return $content;
}




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



// Actions and filters execution
add_action( 'after_setup_theme', 'theme_setup' );
add_action( 'widgets_init', 'theme_widgets_init' );
add_action( 'wp_enqueue_scripts', 'theme_scripts' );
add_filter( 'wp_title', 'theme_wp_title', 10, 2 );
add_action( 'admin_init', 'htaccess_writable' );
add_action( 'generate_rewrite_rules', 'add_h5bp_htaccess' );





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