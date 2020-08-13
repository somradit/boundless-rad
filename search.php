<?php get_header(); ?>

<div class="container uw-body">

  <div class="row">

    <div <?php uw_content_class(); ?> role='main'>


      <?php get_template_part('menu', 'mobile'); ?>

      <?php get_template_part( 'breadcrumbs' ); ?>

      <div id='main_content' class="uw-body-copy" tabindex="-1">


        <?php
          if ( have_posts() ) :
            while ( have_posts() ) : the_post();
              get_template_part( 'content', 'archive' );
            endwhile;
          else :
            echo '<h3 class=\'no-results\'>Sorry, no results matched your criteria.</h3>';
          endif;
        ?>


        <?php posts_nav_link(' '); ?>

      </div>

    </div>

  </div>

</div>

<?php get_footer(); ?>
