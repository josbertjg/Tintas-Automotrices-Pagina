<div id="comments">
    <div id="comments-header">
        <h3>
            <?php 
                if(! have_comments()){
                    echo "¡Sé el primero en comentar!";
                }else{
                    echo get_comments_number()." Comentarios";
                }
            ?>
        </h3>
    </div>
    <div id="comments-body">
        <?php
           wp_list_comments(
               array(
                   'avatar_size' => 80,
                   'style' => 'div',
               )
           );
    
        ?>
    </div>
</div>
<div id="replay-container">
       <?php
       
        if( comments_open() ){
            comment_form(
                array(
                    
                )
            );
        }

       ?>
</div>


