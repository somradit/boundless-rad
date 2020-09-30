<?php
/**
  * Template Name: Rohrmann Endowment
  */
?>

<?php get_header(); ?>
<?php

    echo '<nav id="dawgdrops" aria-label="Main menu"><div class="dawgdrops-inner container" role="application">';
    echo  wp_nav_menu( array(
            'theme_location'  => 'endowment-menu',
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
	<div class="col-md-4" >
		<h4>CHARLES A. ROHRMANN, JR., MD</h4>
    	<img class="aligncenter size-full wp-image-15835" src="/wp-content/uploads/2018/11/Rohrmann-Pix-baseball-cap2-250x290.jpg" alt="" width="250" height="290">
		<h4><a href="https://rad.washington.edu/rohrmann-endowment/about-dr-rohrmann/" style="text-decoration:underline">ABOUT DR. ROHRMANN</a></h4>
		<h4><a href="https://online.gifts.washington.edu/peer2peer/Campaign/89e410c9-ab41-49fd-bdf3-9a9c23558e6b?mkt_tok=eyJpIjoiTVdGaU5HRXdOelJpTURrNCIsInQiOiJpXC84RnVHa0hlNm5lYjZiTTdhVWZBNFwvalNrRG9JQ1p4amRZNDV1SmZGRnVxXC9yZWhic2h6NDEyZFA2b25hS1Q3S01HdEFvdUM3UzhDN3RadFlQcjdKZz09In0%3D" target="_blank" style="text-decoration:underline">DONATE</a></h4>
		<h4><a href="https://rad.washington.edu/rohrmann-endowment/events/" style="text-decoration:underline">EVENTS</a></h4>
		<h4>NEWSLETTERS</h4>
		<?php wp_nav_menu( array( 'theme_location' => 'rohrmann-side' ) ); ?>
		<h4><a href="https://vimeo.com/50809305" target="_blank" style="text-decoration:underline">ENDOWMENT VIDEO</a></h4>
	</div>
		
  </div>
 
</div>

<?php get_footer(); ?>
