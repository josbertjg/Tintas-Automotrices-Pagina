<a href="<?php the_permalink(); ?>">
    <img src="<?php the_post_thumbnail_url(); ?>" alt="productos anjotintas">
    <hr class="border-danger border-2">
    <div>
        <h1><?php the_title(); ?></h1>
        <span>Producto</span>
        <span><?php echo $_SESSION["marca"] ?></span>
    </div>
</a>
