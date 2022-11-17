<div class="meta mb-3" id="content-header">
    <span class="date"><?php the_date(); ?></span>
    <?php 
        the_tags('<span class="tag"><i class="fa fa-tag"></i>','</span><span class="tag"><i class="fa fa-tag"></i>','</span>');
    ?>
    <span class="comment"><a href="#comments"><i class='fa fa-comment'></i> <?php comments_number(); ?></a></span>
</div>

<div id="content-body">
    <?php
        the_content();
    ?>
</div>

<?php
    comments_template();
?>