<?php get_header(); ?>

<?php get_template_part( 'header', 'image' ); ?>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>

      <?php uw_site_title(); ?>

      <?php get_template_part( 'breadcrumbs' ); ?>

      <div id='main_content' class="uw-body-copy" tabindex="-1">

		<?php
		$blogusers = get_users( 'blog_id=1&orderby=nicename&role=subscriber' );
		// Array of WP_User objects.
		foreach ( $blogusers as $user ) {
			echo '<span>' . esc_html( $user->ID ) . '</span><br>';
			echo get_user_meta($user->ID, 'classification', true);
		}?>
            </div><!-- #content -->
        </div><!-- #container -->
    </div>
</div>

<?php get_footer(); ?>
