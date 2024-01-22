<?php get_header();?>
<section class="about">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="about_sec">
                        <div class="breadcrumb">
                            <ul>
                                <li><a href="<?= site_url();?>/how-to/">How-to</a></li>    
                               
                       
                   
                            </ul>
                        </div>
                        <div class="line wow slideInUp" data-wow-delay=".7s"></div>
                        <h1 class="h1 wow slideInUp"><?php echo single_cat_title();?></h1>
                        <div class="search">
                            <form class="search-form wow slideInUp">
                                <input class="form-control search_input" type="search" placeholder="Search in articles">
                                <button class="btn btn-search" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>

                            <div class="search-wrap">
                                <ul>
                                    <li><a href="search.html">Kundeklausuler indgået efter 1. januar 2016</a></li>
                                    <li><a href="search.html">Kundeklausuler for dummies</a></li>
                                    <li><a href="search.html">Professionelt salt og kundeservice</a></li>
                                    <li><a href="search.html">CX er det nye kundeservice</a></li>
                                    <li><a href="search.html">Styrk kundeoplevelsen med AI</a></li>
                                    <li><a href="search.html">AI er kommet for at blive i kunderelationer</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="category">
        <div class="container-fluid">
            <div class="row grid grid-1">
            <?php
               $post_id = get_the_ID();
                $cat_ids = array();
                $categories = get_the_category( $post_id );
                //print_r($categories);
                $category_name = 'demo'
                ?>
                <?php
    $catquery = new WP_Query( array( 'post_type' => 'epkb_post_type_1', 'category_name'=>$category_name,'posts_per_page' => -1 ) );
    while($catquery->have_posts()) : $catquery->the_post();
?>
                <div class="col-md-12">
                    <div class="category-box">
                        <div class="category-img">
                            <img src="assets/img/about-img1.png" alt="no-img" class="img-fluid">
                        </div>

                        <div class="content">
                            <div class="category-content">
                                <h3><?php the_title(); ?></h3>
                                <p><small>Edited J<?php get_the_date(); ?></small></p>
                                <p><?php $content = get_the_content();
                                        $content = strip_tags($content);
                                    echo substr($content, 0, 100);?></p>
                            </div>

                            <div class="category-btn">
                                <div class="user">
                                    <div class="user-info">
                                        <p><?php echo get_the_author();?> <span>IT consultant</span></p>
                                    </div>

                                    <div class="user-img">
                                        <img src="assets/img/user.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <a href="<?php echo the_permalink();?>" class="btn custom-btn">Go to article</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
           
            </div>
        </div>
    </section> 

<?php get_footer();?>