<?php

function register_my_menu() {
   register_nav_menu('header-menu',__( 'haply main menu' ));
	 //register_nav_menu('language-menu',__( 'Language Menu' ));
	 register_nav_menu('footer-menu',__( 'footer menu' ));
     
     register_nav_menu('header-menu-geonote',__( 'geonote main menu' ));	
	 //register_nav_menu('footer-menu-geonote',__( 'geonote footer menu' ));
}
add_action( 'init', 'register_my_menu' );

/**
 * Enqueue scripts and styles.
 */
function esf_scripts() {
	wp_enqueue_style( 'esf-style', get_stylesheet_uri(), array(), '' );
	wp_style_add_data( 'esf-style', 'rtl', 'replace' );

	//wp_enqueue_script( 'esf-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'esf_scripts' );

// function add_additional_class_on_li($classes, $item, $args) {
//     if(isset($args->add_li_class)) {
//         $classes[] = $args->add_li_class;
//     }
//     return $classes;
// }
// add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
  if (in_array('current-menu-item', $classes) ){
    $classes[] = 'active ';
  }
  return $classes;
}

// Our custom post type function
// function create_posttype() {
  
//     register_post_type( 'products',
//         array(
//             'labels' => array(
//                 'name' => __( 'Products' ),
//                 'singular_name' => __( 'Product' )
//             ),
//             'public'       => true,
//             'has_archive'  => true,
//             'rewrite'      => array('slug' => 'products'),
//             'show_in_rest' => true,
//             'taxonomies'   => array( 'category' ),
//                     // Features this CPT supports in Post Editor
//              'supports'    => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields','tags' ),
//              'tax_query' => array(
//                 array(
//                   'taxonomy' => 'product',
//                   'field' => 'slug',
//                   'terms' => 'board'
//                 ),
//                 ),
  
//         )
//     );
// }
// // Hooking up our function to theme setup
// add_action( 'init', 'create_posttype' );
add_theme_support('post-thumbnails');
add_theme_support( 'custom-logo' );
add_theme_support( 'block-templates' );


add_action('customize_register', 'transparent_logo_customize_register');
function transparent_logo_customize_register($wp_customize)
{

  $wp_customize->add_setting('footer_logo');
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo', array(
    'label'    => __('Footer Logo', 'HaplyWP'),
    'section'  => 'title_tagline',
    'settings' => 'footer_logo',
    'priority'       => 8,
  )));
}

add_action('customize_register', 'feb_logo_customize_register');
function feb_logo_customize_register($wp_customize)
{


$wp_customize->add_section( 'footer' , array(
  'title' => __( 'Footer', 'HaplyWP' ),
  'priority' => 105, // Before Widgets.
) );

 /* $wp_customize->add_setting('facebook_social');
  
  $wp_customize->add_control( 'social_facebook', array(
 'label'      => __('Facebook', 'dcs'),
 'section'    => 'footer',
 'settings'   => 'facebook_social',
 'type'       => 'text',
 ) );
 */
 
 $wp_customize->add_setting('social_linkedin');
  $wp_customize->add_control( 'social_linkedin', array(
 'label'      => __('linked in', 'dcs'),
 'section'    => 'footer',
 'settings'   => 'social_linkedin',
 'type'       => 'text',
 ) );
 
 
  $wp_customize->add_setting('footer_address');
  $wp_customize->add_control( 'footer_address', array(
 'label'      => __('Address', 'dcs'),
 'section'    => 'footer',
 'settings'   => 'footer_address',
 'type'       => 'text',
 ) );
 
  $wp_customize->add_setting('footer_cvr');
  $wp_customize->add_control( 'footer_cvr', array(
 'label'      => __('CVR-nr', 'dcs'),
 'section'    => 'footer',
 'settings'   => 'footer_cvr',
 'type'       => 'text',
 ) );
 $wp_customize->add_setting('footer_tlf');
  $wp_customize->add_control( 'footer_tlf', array(
 'label'      => __('Tlf', 'dcs'),
 'section'    => 'footer',
 'settings'   => 'footer_tlf',
 'type'       => 'text',
 ) );
 $wp_customize->add_setting('footer_email');
  $wp_customize->add_control( 'footer_email', array(
 'label'      => __('E-mail', 'dcs'),
 'section'    => 'footer',
 'settings'   => 'footer_email',
 'type'       => 'text',
 ) );
 $wp_customize->add_setting('footer_faktura');
  $wp_customize->add_control( 'footer_faktura', array(
 'label'      => __('Faktura', 'dcs'),
 'section'    => 'footer',
 'settings'   => 'footer_faktura',
 'type'       => 'text',
 ) );
 
 
 
 $wp_customize->add_section( 'header' , array(
  'title' => __( 'Header', 'HaplyWP' ),
  'priority' => 106, 
) );

  $wp_customize->add_setting('header_link_text_en');
 $wp_customize->add_control( 'header_link_text_en', array(
 'label'      => __('Header link text en', 'dcs'),
 'section'    => 'header',
 'settings'   => 'header_link_text_en',
 'type'       => 'text',
 ) );
 
 $wp_customize->add_setting('header_link_en');
 $wp_customize->add_control( 'header_link_en', array(
 'label'      => __('Header link en', 'dcs'),
 'section'    => 'header',
 'settings'   => 'header_link_en',
 'type'       => 'url',
 ) );
 
 $wp_customize->add_setting('header_link_text_de');
 $wp_customize->add_control( 'header_link_text_de', array(
 'label'      => __('Header link text de', 'dcs'),
 'section'    => 'header',
 'settings'   => 'header_link_text_de',
 'type'       => 'text',
 ) );
 
 $wp_customize->add_setting('header_link_de');
 $wp_customize->add_control( 'header_link_de', array(
 'label'      => __('Header link de', 'dcs'),
 'section'    => 'header',
 'settings'   => 'header_link_de',
 'type'       => 'url',
 ) );
 

 
 
  /*$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'feb_logo', array(
    'label'    => __('Linkedin url', 'store-front'),
    'section'  => 'footer',
    'settings' => 'footer_social',
    'priority'       => 4,
  )));*/
}

// $args = array(
//     'post_type' => 'custom_type', // Your custom post type
//     'posts_per_page' => '8', // Change the number to whatever you wish
//     'order_by' => 'date', // Some optional sorting
//     'order' => 'ASC', 
//     );
//     $new_query = new WP_Query ($args);
//     if ($new_query->have_posts()) {
//         while($new_query->have_posts()){
//             $new_query->the_post();
//             the_title();
//             the_post_thumbnail('thumbnail');
//             // Get a list of post's categories
//             $categories = get_the_category($post->ID);
//             foreach ($categories as $category) {
//                 echo $category->name;
//             }
//         }
//     }
//     wp_reset_postdata();
    
?>
<?php 
/*
 ==================
 Simple Ajax Search
======================   
*/
// add the ajax fetch js
add_action( 'wp_footer', 'fetch_ajax' );
function fetch_ajax() {
?>
<script type="text/javascript">
function fetch(){

    jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        data: { action: 'data_fetch',keyword: jQuery('#keyword').val() },
        success: function(data) {
            //console.log(data);
		
            jQuery('#datafetch').html(data);
				//exit();
        }
    });

}
</script>

<?php
}

// the ajax function
add_action('wp_ajax_data_fetch' , 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch','data_fetch');
function data_fetch(){

    $the_query = new WP_Query( array( 'posts_per_page' => -1, 's' => esc_attr( $_POST['keyword'] ), 'post_type' => 'epkb_post_type_1' ) );
    if( $the_query->have_posts() ) :?>
      <ul class="navbar-nav">
      <?php while( $the_query->have_posts() ): $the_query->the_post(); ?>
            <li><a href="<?php echo the_permalink(); ?>"><?php the_title();?></a></li>
        <?php endwhile; ?>
     </ul>

       <?php wp_reset_postdata();  
    endif;
    

    wp_die(); 
}
?>
<?php
/*
 ==================
 How To Page Simple Ajax Search
======================   
*/
// add the ajax fetch js
add_action( 'wp_footer', 'how_fetch_ajax' );
function how_fetch_ajax() {
$qobj = json_encode(get_queried_object());

?>

<script type="text/javascript">
function how_fetch(){

    jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        data: { action: 'how_data_fetch',keyword: jQuery('#how_keyword').val()},
        success: function(data) {
            //console.log(data);
		
            jQuery('#how_to_datafetch').html(data);
				exit();
        }
    });
}

function how_fetch_articles(evnt){

  jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        data: { action: 'how_data_fetch_articles',keyword: jQuery(evnt).val() ,'termObj': <?php echo $qobj;?>},
        success: function(data) {
        	console.log(data);		
            jQuery('#how_to_datafetch_article').html(data);
				
        }
    });
}

</script>

<?php
}

// the ajax function
add_action('wp_ajax_how_data_fetch' , 'how_data_fetch');
add_action('wp_ajax_nopriv_how_data_fetch','how_data_fetch');
function how_data_fetch(){
 $search_text=$_POST['keyword'];
$terms = get_terms(
  array(
         'taxonomy'   => 'epkb_post_type_1_category', // Custom Post Type Taxonomy Slug
         'hide_empty' => false,
         'order'	     => 'desc',
         'hierarchical' => true,
         'parent' => 0,
        'name__like'    => $search_text
     )
  );

  foreach( $terms as $category ) {  
         // vars
  $queried_object = get_queried_object(); 
  $taxonomy = $category->taxonomy;
  $term_id = $category->term_id; 

  ?>

      <a href="<?php echo get_category_link($category->term_id);?>" class="highlight-text"><?php echo  $category->name;?> </a>


 <?php }

  wp_die();

}


// the ajax function
add_action('wp_ajax_how_data_fetch_articles' , 'how_data_fetch_articles');
add_action('wp_ajax_nopriv_how_data_fetch_articles','how_data_fetch_articles');
/* Aitcle Archive page custom serch */
function how_data_fetch_articles(){
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
	$search=$_POST['keyword'];
     $qobj = $_POST['termObj'];
     //print_r($qobj); // debugging only
     
    $meta_query = array(
	array(
		'key'     => 'manage_theme',
		'value'   => THEME_NAME?THEME_NAME:'green', // THEME_NAME come form wp_config.php 
		'compare' => 'LIKE',
		)
	);
    // concatenate the query
    $args = array(
      'posts_per_page' => -1,
      'orderby' => 'rand',
      'public'   => true,
       's' => $search,
       'suppress_filters' => false,
      'tax_query' => array(
        array(
          'taxonomy' => $qobj['taxonomy'],
          'field' => 'id',
          'terms' => $qobj['term_id'],
   
        )
      ),
      'meta_query' => $meta_query,
    );
    
    $random_query = new WP_Query( $args );
    // var_dump($random_query); // debugging only

    if ($random_query->have_posts()) {
        while ($random_query->have_posts()) {
          $random_query->the_post();
          echo '<a href="'.get_the_permalink().'" class="highlight-text">'.get_the_title().'</a>';
        }
    }
    
    
}


/* Archive aritcle page seach end*/




/* svg  image */
add_filter( 'mime_types', 'cc_adding_mime_types_support', 99);

function cc_adding_mime_types_support( $mimes ) {

    if(!defined('ALLOW_UNFILTERED_UPLOADS')) {
        define('ALLOW_UNFILTERED_UPLOADS', true);
    }
    $mimes['svg']  = 'image/svg+xml';

  
    return $mimes;
}

function my_plugin_body_class($classes)
{
  $classes[] = BODY_CLASS;
  return $classes;
}

add_filter('body_class', 'my_plugin_body_class');

/**
 * Disable Multiple Plugin updates 
 */

add_filter( 'site_transient_update_plugins', 'disable_multiple_plugin_updates' );

 function disable_multiple_plugin_updates( $value ) {

    $pluginsToDisableUpdates = [
        'echo-knowledge-base/echo-knowledge-base.php',
        'add-search-to-menu/add-search-to-menu.php',
        'require-kb-category/require-kb-category.php',
    ];

    if ( isset($value) && is_object($value) ) {
        foreach ( $pluginsToDisableUpdates as $plugin) {
            if ( isset( $value->response[$plugin] ) ) {
                unset( $value->response[$plugin] );
            }
        }
    }
    return $value;
}

add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
    #nav-menu-header .menu-name,
    #nav-menu-header select {
      margin-left: 0px!important;
    } 
    
  </style>';
}
