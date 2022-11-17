<?php 
    get_header();
?>

<article id="post-container">

    <?php
        if(have_posts()){

            while(have_posts()){

                the_post();

                get_template_part('template-parts/content','archive');
                
            }
        }
    ?>

</article>

<?php 
    get_footer();
?>