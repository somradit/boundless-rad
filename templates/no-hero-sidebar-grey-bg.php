<?php
/**
  * Template Name: Teaching Case with Grey Background
  */
?>

<?php get_header(); ?>
<style type="text/css">
#uw-container div#uw-container-inner, .uw-body.container, .uw-breadcrumbs, .uw-breadcrumbs li:before{
	background-color:lightgrey;
}
.uw-breadcrumbs li:before{
	background-image:none;
}
</style>

<div class="container uw-body grey-background">

  <div class="row">

    <div class="col-md-8 uw-content" role='main'>

    	<h2 class="uw-site-title"><?php get_uw_post_title();?></h2>
    	
    	 

      <?php get_template_part( 'breadcrumbs' ); ?>
      <div id='main_content' class="uw-body-copy" tabindex="-1">
      		
        <?php
          // Start the Loop.
          while ( have_posts() ) : the_post();

            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
            get_template_part( 'content', 'page' );

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
              comments_template();
            }

          endwhile;
        ?>

      </div>
      	
    </div>
    
  </div>
 
</div>

<?php get_footer(); ?>
