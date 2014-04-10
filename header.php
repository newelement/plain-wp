<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <title><?php wp_title( '|', true, 'right' ); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>

    </head>
    <body <?php body_class(); ?>>
        
        <div id="site-body">
           
            <header class="header">
                <div class="mobile-main-nav-wrap">
                    <a class="offcanvas-toggle mobile-nav-button" href="#mobile-nav">
                        <i class="fa fa-bars"></i><span>Menu</span>
                    </a>
                    <!-- LOGO -->
                    <div class="logo">
                        <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>">Plain.</a></h1>
                    </div>
                    <nav class="main-nav">
                        <!--<ul>
                            <li><a href="/">Home</a></li>
                            <li><a href="#">Pages <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="blog.php">Blog</a></li>
                                    <li><a href="video.php">Video</a></li>
                                    <li><a href="#">Page Type 3</a></li>
                                </ul>
                            </li>
                            <li><a href="/styles/">Styles</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Contact <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="#">Directions</a></li>
                                    <li><a href="#">Departments</a></li>
                                </ul>
                            </li>
                        </ul>-->
                        <?php wp_nav_menu( array( "container" => false ) ); ?>
                        <?php //wp_nav_menu( array( "theme_location" => "primary", "container" => false ) ); ?>
                    </nav><!-- END .main-nav -->
                </div><!-- END .mobile-main-nav-wrap -->