<?php
/**
  * Template Name: McGoodwin Endowment
  */
?>

<?php get_header(); ?>
<?php

    echo '<nav id="dawgdrops" aria-label="Main menu"><div class="dawgdrops-inner container" role="application">';
    echo  wp_nav_menu( array(
            'theme_location'  => 'mcgoodwin-endowment-menu',
            'container'       => false,
            //'container_class' => 'dawgdrops-inner container',
            'menu_class'      => 'dawgdrops-nav',
            'fallback_cb'     => '',
            'walker'          => new UW_Dropdowns_Walker_Menu()
          ) );
    echo '</div></nav>';

 ?>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='main'>
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
		<?php get_sidebar() ?>
		
  </div>
 
</div>

<?php get_footer(); ?>
