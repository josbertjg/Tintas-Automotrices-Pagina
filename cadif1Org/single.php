<?php 
    get_header();
?>
<div id="post-title">
    <span><?php the_title(); ?></span>
</div>
<article id="post-container">

    <?php
        if(have_posts()){

            while(have_posts()){

                the_post();

                get_template_part('template-parts/content','article');
                
            }
        }
    ?>

</article>

<?php 
    get_footer();
?>