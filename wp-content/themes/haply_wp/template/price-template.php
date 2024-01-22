<?php /*Template Name: Price Page */
get_header();
get_header(); ?>


<section class="price">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="about_sec">
                    <div class="line"></div>
                    <h1 class="h1"><?php echo the_field('heading'); ?></h1>

                    <h4><?php echo the_field('text'); ?></h4>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            // Check rows existexists.
            if (have_rows('price')) :
                // Loop through rows.
                while (have_rows('price')) : the_row();
                    $color = get_sub_field('color');
            ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="price-bx">
                            <div class="top-border" style="border-radius: 6px 6px 0 0; border: 7px solid <?php echo $color; ?> "></div>
                            <div class="price-pd">
                                <div class="line"></div>
                                <h3><?php echo get_sub_field('heading'); ?></h3>
                                <h4><?php echo get_sub_field('sub_heading'); ?></h4>
                                <p><?php echo get_sub_field('text'); ?></p>
                                <a href="<?php print_r(get_sub_field('price_url')['url']); ?>" class="btn hover-btn"><?php echo get_sub_field('price_url')['title'] ? get_sub_field('price_url')['title'] : 'Gratis prøveperiode'; ?></a><!--Gratis prøveperiode-->
                                <a href="<?php echo get_sub_field('price_url_sec')['url']; ?>" class="btn custom-btn"><?php echo get_sub_field('price_url_sec')['title'] ? get_sub_field('price_url_sec')['title'] : 'Bestil haply together'; ?></a><!-- Bestil haply together-->
                            </div>

                            <div class="price-bx-info">
                                <p><?php echo get_sub_field('textarea'); ?> </p>
                                <!-- <span class="slide-accordian"><i class="fa-solid fa-magnifying-glass"></i></span> -->
                            </div>

                            <ul>
                                <?php
                                if (have_rows('tool')) :
                                    // Loop through rows.
                                    while (have_rows('tool')) : the_row();
                                ?>
                                        <li>
                                            <p><?php echo get_sub_field('heading'); ?>
                                                <span class="toltip">
                                                    <img src="<?php echo get_sub_field('image')['url'] ?>" alt="i" class="img-fluid img-info">
                                                    <?php $tooltip = get_sub_field('message');
                                                    if ($tooltip !== '') :
                                                    ?>
                                                        <span class="toltipBx">
                                                            <?php echo $tooltip ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </span>
                                            </p>



                                        </li>
                                <?php endwhile;
                                endif; ?>
                            </ul>
                        </div>
                    </div>
            <?php
                endwhile;
            endif; ?>
            <div class="custom-hideShow">
                <a href="javascript:;" class="btn custom-btn showHeight ">Show more features</a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>