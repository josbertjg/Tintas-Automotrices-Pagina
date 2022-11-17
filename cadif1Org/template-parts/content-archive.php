<article id="blog-container">
    <div class="post">
        <img src="<?php the_post_thumbnail_url(); ?>" alt="post-image">
        <div>
            <h3>
                <?php
                    the_title();
                ?>
            </h3>
            <div class="meta mb-3" id="content-header">
                <span class="date">
                    <?php
                        the_date();
                    ?>
                </span>
                <span class="comment"><a href="#comments"><i class='fa fa-comment'></i>
                    <?php
                        comments_number();
                    ?>
                </a></span>
            </div>
            <p>
            <?php
                the_excerpt();
            ?>
            </p>
            <a href="<?php the_permalink(); ?>" class="btn btn-primary rounded">¡Ver Más!</a>
        </div>
    </div>
</article>