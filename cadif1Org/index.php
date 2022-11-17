<?php 
    get_header();
?>
<div id="post-title">
    <span>Nuestras Noticias</span>
</div>
<article id="post-container">

    <?php
        //query_posts("category_name='noticia'");
        if(have_posts()){
            $i=1;
            while(have_posts()){
                the_post();
                if(get_the_category()[0]->name == 'noticia'){
                    // if($i<=3){
                    //     $i++;
                    //     continue;
                    // }else{
                        get_template_part('template-parts/content','archive');
                    //}
                }
            }
        }
    ?>

    <?php
        the_posts_pagination();
    ?>

</article>

<?php 
    get_footer();
?>