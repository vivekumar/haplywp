<?php /*Template Name: Home*/
get_header();
?>
<section class="about1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="about_sec">
                    <div class="line "></div>
                    <h1 class="h1">
                        <?php echo get_field('home-section')['text']; ?>

                    </h1>

                    <div class="inline_btn">
                        <a href="<?php print_r(get_field('home-section')['free_url1']['url']); ?>" class="btn custom-btn"><?php esc_html_e(get_field('home-section')['free_url1']['title'], 'HaplyWP') ?></a>
                        <a href="<?php echo get_field('home-section')['demo_url1']['url']; ?>" class="btn hover-btn "><?php esc_html_e(get_field('home-section')['demo_url1']['title'], 'HaplyWP') ?></a> <!--Prøv vores demo-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

$mid_section = get_field('home-sec');


?>

<section class="leftImg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="leftImg img ">
                    <div class="leftImg_style">
                        <img src="<?php echo $mid_section['image']['url']; ?>" alt="<?php echo $mid_section['image']['title']; ?>" class="img-fluid">
                        <!--<p class="digit">3:2</p>-->
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-6">
                <div class="leftImg content lg-pl-34">
                    <div class="heading position-relative" id="home-content-wrap">

                        <h3><?php echo  $mid_section['heading']; ?></h3>
                        <div class="text_content">
                            <?php //echo $mid_section['content'];
                            //echo mb_strimwidth($mid_section['content'], 0, 1100, "...");                                
                            ?>

                        </div>
                        <!--<button class="show-more-button">...</button>-->

                    </div>

                    <a href="<?php echo get_field('home-sec')['home_sec2_url']['url']; ?>" class="btn custom-btn"><?php esc_html_e(get_field('home-sec')['home_sec2_url']['title'], 'HaplyWP') ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about heading-noly">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="about_sec">
                    <div class="line"></div>
                    <h2 class="h2"><?php echo get_field('heading'); ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
//echo "<pre>";
$third_section = get_field('home-third');
//print_r( get_field('home-section'));

?>
<section class="leftImg right-img">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="leftImg content pr-34">
                    <div class="heading">
                        <h3><?php echo $third_section['heading']; ?></h3>
                        <?php
                        //echo mb_strimwidth($third_section['text'], 0, 1100, "...");
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-6">
                <div class="leftImg img">
                    <div class="leftImg_style">
                        <img src="<?php echo $third_section['image']['url']; ?>" alt="" class="img-fluid">
                        <!--<p class="digit">3:2</p>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <section class="about">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="about_sec">
                        <div class="line"></div>
                        <h1 class="h1">Featured guides to haply <br> products</h1>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

<section class="feature">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="about_sec">
                    <div class="line"></div>
                    <h1 class="h1"><?php echo get_field('related_article_heading'); ?></h1>

                </div>
            </div>
        </div>
        <div class="row">
            <?php

            $meta_query = array(
                array(
                    'key'     => 'manage_theme',
                    'value'   => THEME_NAME ? THEME_NAME : 'green', // THEME_NAME come form wp_config.php 
                    'compare' => 'LIKE',
                )
            );


            $args = array(
                'post_type' => 'epkb_post_type_1', // Your custom post type
                'posts_per_page' => '3', // Change the number to whatever you wish
                'meta_query' => $meta_query,
            );
            $new_query = new WP_Query($args);
            if ($new_query->have_posts()) :
                while ($new_query->have_posts()) :
                    $new_query->the_post();
            ?>
                    <div class="col-lg-4">
                        <div class="feature-box">
                            <div class="img-style">
                                <?php if (has_post_thumbnail()) {
                                    the_post_thumbnail();
                                } else {
                                    $upload_dir   = wp_upload_dir();
                                    echo '<img class="img-fluid" src="' . $upload_dir['baseurl'] . '/2023/06/about-img1.png"/>';
                                } ?>

                            </div>

                            <div class="content-style">
                                <h2><?php the_title(); ?></h2>
                                <h4><?php echo wp_trim_words(get_the_excerpt(), '10', '...'); ?></h4>


                                <div class="user">
                                    <div class="user-img">
                                        <?php $theAuthorId = get_the_author_meta('ID'); ?>
                                        <?php echo get_avatar($theAuthorId); ?>
                                    </div>

                                    <div class="user-info">
                                        <h4><?php echo get_author_name(); ?></h4>
                                        <h4><?php echo get_the_date(); ?></h4>
                                    </div>
                                </div>

                                <a href="<?php echo get_post_permalink(); ?>" class="btn custom-btn"><?php esc_html_e('Read more', 'HaplyWP') ?></a>
                            </div>
                        </div>
                    </div>
            <?php endwhile;
                wp_reset_postdata();
            endif ?>

            <div class="col-lg-12">
                <div class="text-center">
                    <a href="<?php echo get_field('related_article_button')['url'];  ?>" class="btn hover-btn featureBtn"><?php echo get_field('related_article_button')['title'] ? get_field('related_article_button')['title'] : 'See all how-to articles'; //esc_html_e( 'See all how-to articles', 'HaplyWP' )
                                                                                                                            ?> </a>

                </div>

            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>