<?php

/*

* Template Name: Single post page

* Template Post Type: epkb_post_type_1

*/

get_header();

$my_taxo ='epkb_post_type_1_category';


$my_post= get_the_terms(get_the_ID(), $my_taxo);

$term = $my_post[0];

$term_url = get_term_link($term);








?>

<section class="hwto artical">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="artical">
                    <div class="artical-img">
                        <?php if ( has_post_thumbnail() ) {
								the_post_thumbnail();
							}
							else {							
								$upload_dir   = wp_upload_dir();
        							echo '<img class="img-fluid" src="' . $upload_dir['baseurl'] . '/2023/06/about-img1.png"/>';
							} ?>


                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-10">
                <div class="breadcrumb">
                    <ul>

                        <li><a href="<?= site_url();?>/how-to/>"><?php if(ICL_LANGUAGE_CODE=='en'){ echo 'How-to'; } 
else if(ICL_LANGUAGE_CODE=='da'){ echo 'hvordan man';}?></a></li>

                        <?php if(have_posts()) : the_post();  
                                    $post_type = get_post_type(get_the_ID());   
                                    $taxonomies = get_object_taxonomies($post_type);   
                                    $taxonomy_names = wp_get_object_terms(get_the_ID(), $taxonomies,  array("fields" => "names")); 
                                    if(!empty($taxonomy_names)) :
                                    foreach($taxonomy_names as $tax_name) :?>
                        <li><a href="<?php echo $term_url;?>"><?php echo $tax_name;?></a></li>
                        <?php endforeach;
                                    endif;
                                endif;  ?>

                        <li><?= get_the_title();?></li>

                    </ul>
                </div>

                <h2 class="wow slideInUp"><?= get_the_title();?></h2>
                <div class="date wow slideInUp">
                    <p>Edited <?= get_the_date();?></p>
                </div>

                <div class="hwto-user">
                    <div class="img-user wow slideInUp">
                        <?php $theAuthorId = get_the_author_meta('ID'); ?>
                        <?php echo get_avatar($theAuthorId);?>

                    </div>

                    <div class="user-info">
                        <p><?php echo get_the_author(); ?>
                            <span><?php echo get_the_author_meta('description'); ?></span>
                        </p>
                    </div>
                </div>

                <div class="divider"></div>

                <div class="translate wow slideInUp">
                    <div id='google_translate_element'></div>
                    <?php echo do_shortcode('[google-translator]'); ?>
                    <!-- <img src="https://infotechdemos.co.in/haply/wp-content/themes/haply_wp/assets/img/googleT.png" alt="user" class="img-fluid"> -->
                </div>


                <div class="article-content" id="detail-wrap"><?php the_content();?></div>


                <?php
							$tip_content = get_field('tip_heading');
if ($tip_content) {
    ?>
                <div class="tip">
                    <h3><i class="fa-solid fa-lightbulb"></i> <?php echo get_field('tip_heading'); ?> </h3>
                    <?php echo get_field('tip_para'); ?>
                </div>
                <?php
} else {
    // Alternative code here if the condition is not met
}
?>
            </div>



            <div class="col-md-2">
                <div class="hwto-social">
                    <p>Share this article</p>
                    <ul>
                        <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink();?>"
                                target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                        </li>
                        <li><a href="https://www.facebook.com/sharer.php?u=<?php the_permalink();?>" target="_blank"><i
                                    class="fa-brands fa-facebook"></i></a></li>
                        <li><a class="clipboard" target="_blank"><i class="fa-solid fa-link"></i></a> </li>
                        <li>
                            <p class="copy"></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<hr>

<section class="artical artical_related">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="wow slideInUp">Related articles</h1>
            </div>
        </div>
        <div class="row">

            <?php
      
$tes_art = get_field('related_art');

if (!empty($tes_art)) {
            // $tes_art is not empty
            // Your code here if $tes_art is not empty
            // echo '<pre>';
            // print_r($tes_art);
            ?>

            <?php
              global $post; ?>
            <?php foreach( $tes_art as $post): // variable must be called $post (IMPORTANT) ?>
            <?php setup_postdata($post); ?>
             
                
            <div class="col-lg-3 col-md-6">
                    <a href="<?php the_permalink(); ?>">
                        <div class="artical-related-bx wow slideInUp">
                            <div class="img-style">
                            <?php echo get_the_post_thumbnail( $post->ID ); ?>
                            </div>
                            <div class="content-style">
                                <div class="date">
                                    <p><?php the_author(); ?></p>
                                    <p><?php echo get_the_date(); ?></p>
                                </div>
                                <h5><?php echo $post->post_name ?></h5>
                            </div>
                        </div>
                    </a>
                </div>



              
                <?php endforeach; ?>
                <?php wp_reset_postdata();?>
                <?php
                
            } else {
            // $tes_art is empty
            // Default arguments for related posts from the same category
            $args = array(
            'posts_per_page' => 8,
            'post__not_in' => array(get_the_ID()),
            'no_found_rows' => true,
            'post_type' => 'epkb_post_type_1',
            );

            // Check for current post category and add tax_query to the query arguments
            $cats = wp_get_post_terms(get_the_ID(), 'category');
            $cats_ids = array();
            foreach ($cats as $wpex_related_cat) {
            $cats_ids[] = $wpex_related_cat->term_id;
            }
            if (!empty($cats_ids)) {
            $args['category__in'] = $cats_ids;
            }

            $related_cats_post = new WP_Query($args);

            if ($related_cats_post->have_posts()) {
            while ($related_cats_post->have_posts()) {
            $related_cats_post->the_post();
            // Your code for displaying related posts from the same category
            // This is the same code as you had before
            ?>
                <div class="col-lg-3 col-md-6">
                    <a href="<?php the_permalink(); ?>">
                        <div class="artical-related-bx wow slideInUp">
                            <div class="img-style">
                                <?php if ( has_post_thumbnail() ) {
					the_post_thumbnail();
				}
				else {							
					$upload_dir   = wp_upload_dir();
					echo '<img class="img-fluid" src="' . $upload_dir['baseurl'] . '/2023/06/about-img1.png"/>';
				} ?>
                            </div>
                            <div class="content-style">
                                <div class="date">
                                    <p><?php the_author(); ?></p>
                                    <p><?php echo get_the_date(); ?></p>
                                </div>
                                <h5><?php echo wp_trim_words(get_the_excerpt(), 10, '...') ?></h5>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
        }
    }
}
?>



            </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
var $temp = $("<input>");
var $url = $(location).attr('href');
$('.clipboard').on('click', function() {
    $("body").append($temp);
    $temp.val($url).select();
    document.execCommand("copy");
    $temp.remove();
    $(".copy").text("URL copied!");
})
</script>

<script>
	jQuery(document).ready(function(){
    jQuery(".navbar ul li a").each(function(){
    var urla = window.location.pathname;
    console.log(jQuery(this)[0].innerText);
    if(jQuery(this)[0].innerText=='hvordan man' || jQuery(this)[0].innerText=='How to'){
      jQuery(this).parent().addClass("active");
    }
        /*if(jQuery(this).attr("href")=="www.xyz.com/other/link1")
            jQuery(this).addClass("active");*/
    })
})
	</script>
<?php get_footer();?>
