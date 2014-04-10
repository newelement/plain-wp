<?php get_header() ?>
            
            <section class="hero">
                <div class="cycle-slideshow" data-cycle-slides=".slide" data-cycle-pager=".cycle-pager" data-cycle-pager-template="<li><a href='#hero-slide{{slideNum}}'>{{slideNum}}</a></li>" data-cycle-next=".cycle-next" data-cycle-prev=".cycle-prev" data-cycle-swipe="true">
                        <div id="hero-slide1" class="slide" style="background-image: url('<?php bloginfo('template_directory') ?>/images/plain.jpg');"></div>
                        <div id="hero-slide2" class="slide" style="background-image: url('<?php bloginfo('template_directory') ?>/images/plain2.jpg');"></div>
                        <div id="hero-slide2" class="slide" style="background-image: url('<?php bloginfo('template_directory') ?>/images/plain3.jpg');"></div>
                </div>
                    <a class="cycle-advance cycle-prev" href="#prev"><i class="fa fa-chevron-left"></i><span>Prev</span></a>
                    <a class="cycle-advance cycle-next" href="#next"><span>Next</span><i class="fa fa-chevron-right"></i></a>
                    <a class="button white-frame hero-button" href="/styles/">View Styles</a>
                    <ul class="cycle-pager align-center"></ul>
                </section><!-- END .hero -->
            </header><!-- END .header -->
            
            <?php get_template_part( 'partials/home', 'intro' ); ?>
        
        
            <?php get_template_part( 'partials/home', 'gallery' ); ?>
        
                
            <?php get_template_part( 'partials/home', 'news' ); ?>
      
            
            
<?php get_footer() ?>