<?php
/**
  * Template Name:No Sidebar - Breadcrumbs
  */
?>

<?php get_header(); ?>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>
		<?php get_template_part( 'breadcrumbs' ); ?>
		<?php uw_site_title();?>
		<?php get_template_part( 'menu', 'mobile' ); ?>
		<div id='main_content' class="uw-body-copy" tabindex="-1">
		<h1 class="page-heading"><?php the_title(); ?></h1>
      
		<?php
          // Start the Loop.
          while ( have_posts() ) : the_post();

            the_content();

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
