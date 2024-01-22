<!DOCTYPE html>
<html lang="en">
<?php $host = $_SERVER['HTTP_HOST'];
$uploads = wp_upload_dir();
$upload_path = $uploads['baseurl'];
/*if($host == 'infotechdemos.co.in'){	
	header("Location: https://haply.life");exit;
}*/
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://infotechdemos.co.in/haply/wp-content/uploads/2023/08/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/assets/css/style.min.css">
    <link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/custom.css">
    <link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/assets/stylesheet/custom.css">
    <link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/assets/custom_css/custom2.css">
    <!-- <link rel="stylesheet" href="//<?php //echo bloginfo('template_url');
                                        ?>/plugins/echo-knowledge-base/custom_css/custom_style.css"> -->
    <title><?php wp_title() ?></title>
    <meta name="google" value="notranslate">
    <?php wp_head(); ?>
    <style>
        .otgs-development-site-front-end {
            background-color: white !important;
        }
    </style>

    <?php
    if ($host !== 'haply.life') { ?>

        <link rel="icon" href="<?php echo $upload_path . THEME_FEBICON; ?>" />


        <style>
            /* Black white theme */


            .body-black-theme .header .logo img {
                width: 72px;
                height: 72px;
            }

            .body-black-theme .header {
                background-color: <?php echo THEME_NAME == 'black' ? '#fff' : '#129E41' ?>;
            }

            .body-black-theme .header .search .custom-btn {
                background-color: <?php echo THEME_NAME == 'black' ? '#222' : '#fff' ?>;
                border: 2px solid <?php echo THEME_NAME == 'black' ? '#222' : '#fff' ?>;
                color: <?php echo THEME_NAME == 'black' ? '#fff' : THEME_BACKGROUND ?>;
            }

            body.body-black-theme .header .header-sec .search form input {
                border: 1px solid <?php echo THEME_NAME == 'black' ? '#222' : '#fff' ?> !important;
                color: <?php echo THEME_NAME == 'black' ? '#222' : '#fff' ?>;

            }

            body.body-black-theme .header .header-sec .search form.is-search-form.is-ajax-search.search-form {
                border: 1px solid <?php echo THEME_NAME == 'black' ? THEME_BACKGROUND : THEME_COLOR ?> !important;
                color: #222;
            }

            body.body-black-theme .header .header-sec .search form input::placeholder {
                color: <?php echo THEME_NAME == 'black' ? '#222' : '#fff' ?>;
            }

            body.body-black-theme .navbar-custom .navbar-toggler {
                color: <?php echo THEME_NAME == 'black' ? '#222' : '#fff' ?>;
            }

            body.body-black-theme .header .header-sec form.is-search-form.search-form button.is-search-submit span svg path {
                fill: <?php echo THEME_NAME == 'black' ? '#222' : '#fff' ?> !important;
            }

            body #header_search form.is-search-form.search-form input[type=search] {
                color: <?php echo THEME_NAME == 'black' ? '#222' : '#fff' ?>;
            }

            body.body-black-theme .custom-btn {
                background-color: <?= THEME_BACKGROUND ?>;
                border: 2px solid <?= THEME_BACKGROUND ?>;
                color: <?= THEME_COLOR ?>;
            }

            body.body-black-theme .hover-btn {
                color: <?= THEME_BACKGROUND ?>;
                border: 2px solid <?= THEME_BACKGROUND ?>;

            }

            body.body-black-theme .footer-logo a i,
            body.body-black-theme .footer-menu a i {
                color: <?= THEME_BACKGROUND ?>;
            }

            body.body-black-theme .footer ul li a,
            body.body-black-theme a,
            body.body-black-theme .footer-menu a i,
            body.body-black-theme .progress-wrap::after,
            .body-black-theme .header .language ul li a,
            .body-black-theme .header .navbar-nav li a {
                color: <?php echo THEME_NAME == 'black' ? '#222' : '#fff' ?>;
            }

            body.body-black-theme .footer ul li a {
                color: <?php echo  THEME_BACKGROUND ?>;
            }

            body.body-black-theme .progress-wrap svg.progress-circle path {
                stroke: <?= THEME_COLOR ?>;
            }

            body.body-black-theme .price-bx ul li img {
                filter: brightness(0);
            }

            .price-bx ul li:hover img {
                filter: brightness(1);
            }

            body.body-black-theme .custom-btn:hover {
                background-color: <?php echo THEME_BACKGROUND ?>;
                border: 2px solid <?php echo THEME_BACKGROUND ?>;
            }

            body.body-black-theme .hover-btn:hover {
                border: 2px solid <?php echo THEME_BACKGROUND ?>;
                /*color: #1d9d48;*/
            }

            @media (max-width:1199px) {
                body.body-black-theme nav.navbar-custom {
                    position: absolute;
                    border-top: 1px solid <?php echo THEME_BACKGROUND ?>;
                    border-bottom: 1px solid <?php echo THEME_BACKGROUND ?>;
                    height: 50px;
                    top: 100%;
                    background-color: <?php echo THEME_BACKGROUND ?>;
                }

                body.body-black-theme nav.navbar-custom ul li a {
                    color: #ffffff !important;
                }
            }

            @media (max-width:991px) {
                body.body-black-theme nav.navbar-custom {
                    height: inherit;
                    background-color: transparent;
                    border: none;
                }
            }

            body.body-black-theme .artical-related-bx:hover .img-style::before {
                background-color: <?php echo THEME_BACKGROUND ?>;
                opacity: 0.5;
            }

            .artical-related-bx:hover .content-style h5 {
                color: <?php echo THEME_BACKGROUND ?>;
            }

            .artical-related-bx:hover .content-style {
                border-color: <?php echo THEME_BACKGROUND ?>;
            }

            .hwto-social ul li a {
                color: <?php echo THEME_BACKGROUND ?>;
            }

            .language ul li.wpml-ls-current-language:after,
            .header .navbar-nav li a:after {
                background-color: <?php echo THEME_NAME == 'black' ? '#222' : '#fff' ?>;
            }


            .navbar-nav li.active a:after {
                background-color: <?php echo THEME_NAME == 'black' ? '#222' : '#fff' ?>;
                /* top:40px;		     */
            }

            div#is-ajax-search-result-553 .is-ajax-search-posts .is-ajax-search-post:hover,
            div#is-ajax-search-result-597 .is-ajax-search-posts .is-ajax-search-post:hover {
                border-bottom: 2px solid <?php echo THEME_BACKGROUND ?>;
                border-top: 2px solid <?php echo THEME_BACKGROUND ?>;
            }

            .price-bx ul li:hover,

            .price-bx .btn.hover-btn:hover {
                color: <?php echo THEME_BACKGROUND ?>;
                border-color: <?php echo THEME_BACKGROUND ?>;
            }

            .toltipBx {
                background-color: <?php echo THEME_BACKGROUND ?>;
            }

            .price-bx ul li:hover:before,
            .price-bx ul li:hover:after {
                background-color: <?php echo THEME_BACKGROUND ?>;
            }

            .price-bx ul li .toltipBx:after {
                border-top: 16px solid <?php echo THEME_BACKGROUND ?>;
            }

            #pre-loader .pre-loader span,
            .body-black-theme::-webkit-scrollbar-thumb,
            .body-black-theme .language ul li.wpml-ls-current-language a:after {
                background-color: #222;
            }
        </style>
        <script>
            $("body.body-black-theme header #header_search .is-search-form").keyup(function() {
                $(".search-form .is-search-submit").css({
                    "background-color": <?php echo THEME_NAME == 'black' ? '#222' : '#fff' ?>
                });
                $(".search-form .is-search-submit svg path").css({
                    "fill": <?php echo THEME_NAME == 'black' ? '#222' : '#fff' ?>!important
                });
                $(this).removeAttr('placeholder');
            });
        </script>
    <?php } else { ?>
        <script>
            $("header #header_search .is-search-form").keyup(function() {
                $(".search-form .is-search-submit").css({
                    "background-color": "#ffffff"
                });
                $(".search-form .is-search-submit svg path").css({
                    "fill": "#129e41"
                });
                $(this).removeAttr('placeholder');

            });


            $("#search-category").keyup(function() {
                $("#search-category button").css({
                    "background-color": "#000000",
                    'color': '#ffffff'
                });
                $("#search-category button svg path").css({
                    "fill": "#ffffff"
                });
                $(this).css({
                    "background-color": "#ffff",
                    "color": "#000000"
                });
                $("#search-category input").removeAttr('placeholder').css("border", "1px solid #000000");
            });
        </script>

        <style>
            .navbar-nav li.active a:after {
                background-color: <?php echo THEME_NAME == 'black' ? '#222' : '#fff' ?>;
                top: 40px;
            }

            .header .navbar-nav li a:after {
                background-color: #fff;
            }
        </style>

    <?php } ?>

</head>

<body <?php body_class(); ?>>

    <!-- preloader area start -->
    <div id="pre-loader">
        <div class="pre-loader">
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- preloader area end -->

    <!-- back to top start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- back to top end -->

    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="header-sec">
                        <div class="logo">
                            <?php

                            if ($host == 'haply.life') {
                                $custom_logo_id = get_theme_mod('custom_logo');
                                $image = wp_get_attachment_image_src($custom_logo_id, 'full'); ?>
                                <a href="<?php if (ICL_LANGUAGE_CODE == 'en') {
                                                echo site_url('en');
                                            } else if (ICL_LANGUAGE_CODE == 'da') {
                                                echo site_url();
                                            } ?>" class="logo-text"><img src="<?php echo $image[0]; ?>" alt=""></a>
                            <?php } else { ?>
                                <a href="<?php echo site_url(); ?>"><img src="<?php echo $upload_path . THEME_LOGO; ?>" width="100" height="100"></a>
                            <?php } ?>

                        </div>

                        <nav class="navbar navbar-expand-lg navbar-custom">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fa-solid fa-bars"></i>
                            </button>

                            <div class="collapse navbar-collapse" id="navbar">
                                <?php
                                $consult_menu = wp_nav_menu(
                                    array(
                                        'theme_location' => 'header-menu',
                                        'menu_id' => '1',
                                        'menu_class' => 'navbar-nav m-auto',
                                        'echo' => false
                                    )
                                );
                                $consult_menu = str_replace('menu-item', 'nav-item', $consult_menu);
                                echo $consult_menu;
                                ?>
                                <!-- <ul class="navbar-nav">
                                    <li><a href="product.html">produkter</a></li>
                                    <li><a href="solutions.html">løsninger</a></li>
                                    <li><a href="prices.html">priser</a></li>
                                    <li><a href="howto.html">how-to</a></li>
                                    <li><a href="contact.html">kontakt</a></li>
                                </ul> -->

                            </div>
                        </nav>

                        <div class="search" id="header_search">
                            <?php echo do_shortcode('[ivory-search id="553" title="AJAX Search Form"]'); ?>
                            <!-- <form class="search-form" method="get" id="searchform" action="<?php //echo esc_url( home_url( '/' ) ); 
                                                                                                ?>">
                                <input type="text" value="<?php //echo get_search_query(); 
                                                            ?>" name="s" class="form-control input_search" id="keyword" onkeyup="fetch()" placeholder="Hvad søger du?">
                                <span class="btn btn-search"> <input type="hidden" id="searchsubmit" value="submit" /> <i class="fa fa-search"></i></span>
                            </form> -->


                            <div id="datafetch"></div>
                            <?php if (ICL_LANGUAGE_CODE == 'en') { ?>
                                <a href="<?php echo get_theme_mod('header_link_en'); ?>" class="btn custom-btn"><?php echo get_theme_mod('header_link_text_en'); ?></a><!--duch Gratis prøveperiode-->
                            <?php } else { ?>
                                <?php // if(ICL_LANGUAGE_CODE=='de'){ 
                                ?>
                                <a href="<?php echo get_theme_mod('header_link_de'); ?>" class="btn custom-btn"><?php echo get_theme_mod('header_link_text_de'); ?></a><!--duch Gratis prøveperiode-->
                            <?php } ?>
                        </div>


                        <div class="language">

                            <?php echo do_shortcode('[wpml_language_switcher type="footer" flags=1 native=1 translated=1][/wpml_language_switcher]'); ?>
                            <?php //echo do_shortcode('[google-translator]'); 
                            ?>
                            <!-- <ul>
                                <li class="active"><a href="#">dansk</a></li>
                                <li>/</li>
                                <li><a href="#">engelsk</a></li>
                            </ul> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>