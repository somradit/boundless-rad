<?php get_header(); ?>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='main'>

    	<h2 class="uw-site-title"><?php get_uw_post_title();?></h2>
    	
    	 <?php if (is_front_page()) { get_template_part( 'menu', 'mobile' ); }?>

      <?php get_template_part( 'breadcrumbs' ); ?>
      <div id='main_content' class="uw-body-copy" tabindex="-1">
      <?php
      	      if (isset($wp_query->query_vars['name']))
      		{
      			print $wp_query->query_vars['name'];
      		}
      ?>
    </div>
    	<?php get_sidebar() ?>
  </div>
 
</div>

<?php get_footer(); ?>
