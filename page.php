<?php get_header() ?>
            
            <div class="secondary-page-hero">
                <div class="container">
                    <h1 class="page-title"><?php echo get_the_title() ?></h1>
                </div>
            </div>
            
            <section class="container section">
                <div class="row">
                    
                    <div class="span7">

                
                        <?php
                            $post = get_post();
                            echo page_content($post->post_content);
                        ?>
                        
                    
                    </div><!-- END .span7 -->
                    
                    <?php get_sidebar() ?>
                    
                </div> <!-- END .row -->
            </section><!-- // END .container.section -->
            
<?php get_footer() ?>