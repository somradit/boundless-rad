<?php
if ( have_posts() ) : 
    while ( have_posts() ) : the_post();?>
		<h2 style="font-size: 27px;">
		  <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a>
		</h2>
		<?php
        the_excerpt();
    endwhile;?>
<div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div> 
<div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>
<?php
else :
    _e( 'Sorry, no posts matched your criteria.', 'textdomain' );
endif;