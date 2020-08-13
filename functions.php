<?php
global $post;
function get_uw_post_title(){
	$url = get_permalink();
	$parts = explode("/", $url);
	$title = ucwords(str_replace("-"," ",$parts[3]));
	echo $title;
}

function color_parent_section(){
	$url = get_permalink();
	$parts = explode("/", $url);
	if($parts[3] == "patient-care"){
		wp_enqueue_style( 'patient-care', 'https://rad.washington.edu/wp-content/themes/boundless-rad/css/patient-care.css' );
	}
	if($parts[3] == "research"){
		wp_enqueue_style( 'research', 'https://rad.washington.edu/wp-content/themes/boundless-rad/css/research.css' );
	}
	if($parts[3] == "education"){
		wp_enqueue_style( 'education', 'https://rad.washington.edu/wp-content/themes/boundless-rad/css/education.css' );
	}
	if($parts[3] == "about-us"){
		wp_enqueue_style( 'about-us', 'https://rad.washington.edu/wp-content/themes/boundless-rad/css/about-us.css' );
	}
	if($parts[3] == "news"){
		wp_enqueue_style( 'news', 'https://rad.washington.edu/wp-content/themes/boundless-rad/css/news.css' );
	}
	if($parts[3] == "employee-wellness"){
		wp_enqueue_style( 'employee-wellness', 'https://rad.washington.edu/wp-content/themes/boundless-rad/css/employee-wellness.css' );
	}
}
function twitter_script(){
    if(is_page( 'Home' )) {
		wp_register_script( 'twitter-script', '//platform.twitter.com/widgets.js' ); // by default script will load to head
        wp_enqueue_script('twitter-script');
    }
}
add_action( 'wp_enqueue_scripts', 'twitter_script' );

//Function to modify a person page title to the person's full name
function wpse144041_modify_title($title) {
    if ( isset( $post->ID ) ){
        if ( empty( $_POST['post_title'] ) && 'person' == get_post_type( $post->ID ) ){
            $title = get_field('netid');
        }
    }
    return $title;
}
add_filter('title_save_pre','wpse144041_modify_title');

function add_query_vars($aVars) {
$aVars[] = "faculty"; // represents the name of the product category as shown in the URL
return $aVars;
}

// hook add_query_vars function into query_vars
add_filter('query_vars', 'add_query_vars');

/*** Remove Query String from Static Resources ***/
function remove_cssjs_ver( $src ) {
 if( strpos( $src, '?ver=' ) )
 $src = remove_query_arg( 'ver', $src );
 return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );



function children_only_style() {
	if ( is_page_template( 'no-hero-children-only-sidebar.php' ) ) {
		wp_enqueue_style( 'children-only', '/wp-content/themes/boundless-rad/css/children-only.css' );
	}
}
// Implement enqueued scripts
add_action( 'wp_enqueue_scripts', 'children_only_style' );

//Add Categories and Tags to Pages
function add_taxonomies_to_pages() {
 register_taxonomy_for_object_type( 'post_tag', 'page' );
 register_taxonomy_for_object_type( 'category', 'page' );
 }
add_action( 'init', 'add_taxonomies_to_pages' );
//Add Categories and Tags to News
function add_taxonomies_to_news() {
 register_taxonomy_for_object_type( 'post_tag', 'news' );
 register_taxonomy_for_object_type( 'category', 'news' );
 }
add_action( 'init', 'add_taxonomies_to_news' );

add_action( 'amp_init', 'news_add_amp' );
function news_add_amp() {
    add_post_type_support( 'news', AMP_QUERY_VAR );
}

//Make Metaslider Admin Only
function metaslider_permissions($capability) {
$capability = 'administrator';
return $capability;
}
add_filter( "metaslider_capability", "metaslider_permissions" );

/**
 * Enable ACF 5 early access
 * Requires at least version ACF 4.4.12 to work
 */
define('ACF_EARLY_ACCESS', '5');
//Disable emoji scripts
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );


//Add api hook to get all pages (so that we don't have to paginate for Power BI)
  function list_radiology_pages_api( $data ) {
  $pages = get_posts( array(
    'post_type' => 'page',
	'posts_per_page' => -1,
	'post_status'	=> array('publish'),
  ) );
	foreach ($pages as $key => $page) {
			$pages[$key]->page_title = get_the_title($page->ID);
			$pages[$key]->url = get_permalink($page->ID);
			$pages[$key]->redirect = get_field('_pprredirect_active', $page->ID);
			$pages[$key]->auto = get_field('automatically_maintained', $page->ID);
			unset($pages[$key]->filter);
			unset($pages[$key]->to_ping);
			unset($pages[$key]->pinged);
			unset($pages[$key]->ping_status);
			unset($pages[$key]->post_password);
			unset($pages[$key]->post_status);
			unset($pages[$key]->comment_status);
			unset($pages[$key]->post_excerpt);
			unset($pages[$key]->post_mime_type);
			unset($pages[$key]->post_content);
			unset($pages[$key]->post_content_filtered);
			unset($pages[$key]->post_modified_gmt);
			unset($pages[$key]->post_date_gmt);
			unset($pages[$key]->guid);

	}
  if ( empty( $pages ) ) {
    return null;
  }
 
  return $pages;
}
add_action( 'rest_api_init', function () {
  register_rest_route( 'pages/v1', '/all/', array(
    'methods' => 'GET',
    'callback' => 'list_radiology_pages_api',
  ) );
} );

//Add api hook to get all news stories (so that we don't have to paginate for Power BI)
  function list_radiology_news_api( $data ) {
  $news = get_posts( array(
    'post_type' => 'news',
	'posts_per_page' => -1,
	'post_status'	=> array('publish'),
  ) );
	$fields = array('fields' => 'names');
	foreach ($news as $key => $story) {
			$news[$key]->page_title = get_the_title($story->ID);
			$news[$key]->url = get_permalink($story->ID);
			$news[$key]->categories = wp_get_post_categories($story->ID, $fields);
			unset($news[$key]->filter);
			unset($news[$key]->to_ping);
			unset($news[$key]->pinged);
			unset($news[$key]->ping_status);
			unset($news[$key]->post_password);
			unset($news[$key]->post_status);
			unset($news[$key]->comment_status);
			unset($news[$key]->post_excerpt);
			unset($news[$key]->post_mime_type);
			unset($news[$key]->post_content);
			unset($news[$key]->post_content_filtered);
			unset($news[$key]->post_modified_gmt);
			unset($news[$key]->post_date_gmt);
			unset($news[$key]->guid);

	}
  if ( empty( $news ) ) {
    return null;
  }
 
  return $news;
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'news/v1', '/all/', array(
    'methods' => 'GET',
    'callback' => 'list_radiology_news_api',
  ) );
} );

