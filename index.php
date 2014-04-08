<?php get_header() ?>
            
            
            <section class="container section intro">
                <div class="row">
                    
                    <div class="span12">
                        
                        <h1 class="intro-title">Plain. Website</h1>
                
                        <p>
                        A website repository of things I'm tired of repeating or layouts that could be recycled because they've been coded and tested to work. I've also curated some scripts that I use regularly on websites. I may not use all of the scripts on this site, but may do so on future projects.
                        </p>
                        
                        <p>
                        The organization of files and folders may not be optimal at the moment, but will improve over time. Copy at will.
                        </p>
                        
                    
                    </div><!-- END .span12 -->


                    
                </div> <!-- END .row -->
            </section><!-- END .container.section.intro -->
            
        
        
            <?php get_template_part( 'partials/home', 'gallery' ); ?>
        
                
      
            <section class="container section homepage-blog">
                <div class="row">
                    
                    <?php
                    $args = array( 'posts_per_page' => 3);
                    $wp_query = new WP_Query( $args );
                    
                    if ( $wp_query->have_posts() ) :
                        while ( $wp_query->have_posts() ) : $wp_query->the_post();
                    ?>
                    
                    <article class="span4 homepage-blog-entry">
                        <header>
                            <h2 class="homepage-blog-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
                            <p class="homepage-blog-date"><time pubdate=""><?php the_time('F jS, Y') ?></time></p>
                        </header>
                        <div class="homepage-blog-content">
                            <?php the_content('') ?>
                        </div>
                        <footer class="homepage-blog-footer">
                            <a class="homepage-read-more" href="<?php the_permalink() ?>">Continue Reading <i class="fa fa-angle-right"></i></a>
                        </footer>
                    </article><!-- END .span4.homepage-blog-entry -->
                    
                    <?php   
                        endwhile;
                        
                        wp_reset_postdata();
                    
                    endif; 
                    ?>

                </div> <!-- END .row -->
            </section><!-- END .container.section.homepage-news -->        
            
            
<?php get_footer() ?>