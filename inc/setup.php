<?php
function move_utility_files(){

    $template_path = get_template_directory();
    $webroot = ABSPATH;
    
    if( is_writable($webroot) ){
    
        copy($template_path.'/inc/crossdomain.xml', $webroot.'/crossdomain.xml');
        copy($template_path.'/inc/humans.txt', $webroot.'/humans.txt');
        copy($template_path.'/inc/robots.txt', $webroot.'/robots.txt');
    
    } else {
        add_action('admin_notices', create_function('', "echo '<div class=\"error\"><p>Cannot move files. Please copy these files from the theme's /utility/ folder to your web root. crossdomain.xml, humans.txt and robots.txt </p></div>';") );   
    }
    
}

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
        $filename = get_template_directory() . '/inc/.h5bp-htaccess';
        return insert_with_markers($htaccess_file, 'HTML5 Boilerplate', extract_from_markers($filename, 'HTML5 Boilerplate'));
      }
    }
  }

  return $content;
}


// Page sections CPT
function page_sections_cpt() {
	register_post_type( 'page_sections',
		array(
			'labels' => array(
				'name' => __( 'Page Sections' ),
				'singular_name' => __( 'Page Section' ),
				'menu_name' => 'Page Sections',
				'add_new'       => _x( 'Add New', 'page section' ),
        		'add_new_item'  => __( 'Add New Page Section' ),
        		'edit_item'     => __( 'Edit Page Section' ),
        		'new_item'      => __( 'New Page Section' ),
        		'all_items'     => __( 'All Page Sections' ),
        		'view_item'     => __( 'View Page Section' ),
        		'search_items'  => __( 'Search Page Sections' ),
				'not_found' => __( 'No sections found' ),
			),
		'public' => true,
		'menu_icon' => 'dashicons-exerpt-view',
		'has_archive' => false,
		'post_type' => 'page',
		'menu_position' => 20,
		'supports'      => array( 'title', 'editor', 'thumbnail' ),
		'rewrite' => array('slug' => 'sections')
		)
	);
}
add_action( 'init', 'page_sections_cpt' );


// This creates a sample page of default theme styles
if ( is_admin() && isset($_GET['activated'] ) && $pagenow === "themes.php" ) {

    // Sample page
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
    
    
    // Sample articles
    $article_check1 = get_page_by_title('Roswell That Ends Well', OBJECT, 'post' );
    $article_check2 = get_page_by_title('The Cyber House Rules', OBJECT, 'post' );
    $article_check3 = get_page_by_title('A Clone of My Own', OBJECT, 'post' );
    
    if($article_check1){
        $article_check1_id = $article_check1->ID;
    }
    if($article_check2){
        $article_check2_id = $article_check2->ID;
    }
    if($article_check3){
        $article_check3_id = $article_check3->ID;
    }
    
    $new_page1 = array(
        'post_type' => 'post',
        'post_title' => 'Roswell That Ends Well',
        'post_status' => 'publish',
        'post_author' => 1,
        'post_date' => date('Y-m-d H:i:s', strtotime('-24 hour')), 
        'post_date_gmt' => date('Y-m-d H:i:s', strtotime('-20 hour')),
        'post_content' => '<p>Hey, what kinda party is this? Please, Don-Bot look into your hard drive, and open your mercy file! I don\'t need to drink. Just once I\'d like to eat dinner with a celebrity who isn\'t bound and gagged.</p><!--more--><p>Hey, what kinda party is this? Please, Don-Bot look into your hard drive, and open your mercy file! I don\'t need to drink. Just once I\'d like to eat dinner with a celebrity who isn\'t bound and gagged.</p>'
    );
    
    $new_page2 = array(
        'post_type' => 'post',
        'post_title' => 'The Cyber House Rules',
        'post_status' => 'publish',
        'post_author' => 1,
        'post_date' => date('Y-m-d H:i:s', strtotime('-24 hour')), 
        'post_date_gmt' => date('Y-m-d H:i:s', strtotime('-20 hour')),
        'post_content' => '<p>Why would a robot need to drink? And then the battle\'s not so bad? Morbo can\'t understand his teleprompter because he forgot how you say that letter that\'s shaped like a man wearing a hat.</p><!--more--><p>Why would a robot need to drink? And then the battle\'s not so bad? Morbo can\'t understand his teleprompter because he forgot how you say that letter that\'s shaped like a man wearing a hat.</p>'
    );
    
    $new_page3 = array(
        'post_type' => 'post',
        'post_title' => 'A Clone of My Own',
        'post_status' => 'publish',
        'post_author' => 1,
        'post_date' => date('Y-m-d H:i:s', strtotime('-24 hour')), 
        'post_date_gmt' => date('Y-m-d H:i:s', strtotime('-20 hour')),
        'post_content' => '<p>Large bet on myself in round one. Ooh, name it after me. Anyhoo, your net-suits will allow you to experience Fry\'s worm infested bowels as if you were actually wriggling through them.</p><!--more--><p>Large bet on myself in round one. Ooh, name it after me. Anyhoo, your net-suits will allow you to experience Fry\'s worm infested bowels as if you were actually wriggling through them.</p>'
    );
    
    if(!isset($article_check1_id)){
        wp_insert_post($new_page1);
    }
    if(!isset($article_check2_id)){
        wp_insert_post($new_page2);
    }
    if(!isset($article_check3_id)){
        wp_insert_post($new_page3);
    }
    
    
    // Page intro samle
    $page_section1 = get_page_by_title( 'home intro' );
    
    if($page_section1){
        $page_section1_id = $page_section1->ID;
    }
    
    $new_section1 = array(
        'post_type' => 'page_sections',
        'post_title' => 'home intro',
        'post_status' => 'publish',
        'post_author' => 1,
        'post_content' => '<h1 class="intro-title">Plain. Website</h1><p>A website repository of things I\'m tired of repeating or layouts that could be recycled because they\'ve been coded and tested to work. I\'ve also curated some scripts that I use regularly on websites. I may not use all of the scripts on this site, but may do so on future projects.</p><p>The organization of files and folders may not be optimal at the moment, but will improve over time. Copy at will.</p>'
    );
    
    if(!isset($page_section1_id)){
        wp_insert_post($new_section1);
    }
    
}




add_action( 'after_setup_theme', 'theme_setup' );
add_action( 'admin_init', 'htaccess_writable' );
add_action( 'generate_rewrite_rules', 'add_h5bp_htaccess' );
?>