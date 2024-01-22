<?php $host = $_SERVER['HTTP_HOST'];
$uploads = wp_upload_dir();
$upload_path = $uploads['baseurl'];

?>
<footer class="footer">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="footer-logo">
                    <?php

                    if ($host == 'haply.life') { ?>
                        <a href="<?php if (ICL_LANGUAGE_CODE == 'en') {
                                        echo WP_HOME;
                                    } else if (ICL_LANGUAGE_CODE == 'da') {
                                        echo WP_HOME;
                                    } ?>" class="logo-text">
                            <img src="<?php echo get_theme_mod('footer_logo'); ?>" alt="footer_logo">
                        </a>
                    <?php } else { ?>
                        <a href="<?php echo site_url(); ?>"><img src="<?php echo $upload_path . FOOTER_LOGO; //get_theme_mod('second_logo');
                                                                        ?>"></a>
                    <?php } ?>


                    <ul>
                        <li><a href="#"><?php echo get_theme_mod('footer_address'); ?></a></li>
                        <li><a href="#"><?php esc_html_e('CVR-no', 'HaplyWP') ?>: <?php echo get_theme_mod('footer_cvr'); ?></a></li>
                        <li><a href="tel:<?php echo get_theme_mod('footer_tlf'); ?>"><?php esc_html_e('Tel', 'HaplyWP') ?>: <?php echo get_theme_mod('footer_tlf'); ?></a></li>
                        <li><a href="mailto:<?php echo get_theme_mod('footer_email'); ?>"><?php esc_html_e('E-mail', 'HaplyWP') ?>: <?php echo get_theme_mod('footer_email'); ?></a></li>
                        <li><a href="mailto:<?php echo get_theme_mod('footer_faktura'); ?>"><?php esc_html_e('Invoice', 'HaplyWP') ?>: <?php echo get_theme_mod('footer_faktura'); ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="footer-menu">
                    <?php $consult_menu = wp_nav_menu(
                        array(
                            'theme_location' => 'footer-menu',
                            'menu_id' => '1',
                            'menu_class' => '',
                            'echo' => false
                        )
                    );
                    $consult_menu = str_replace('menu-item', 'nav-item', $consult_menu);
                    echo $consult_menu;
                    ?>
                    <!--<ul>
                            <li><a href="#">GDPR</a></li>
                            <li><a href="#">Fjernsupport</a></li>
                            <li><a href="#">Filupload</a></li>
                            <li><a href="#">Forretningsbetingelser</a></li>
                            <li><a href="#">Cookie-indstillinger</a></li>
                        </ul>-->

                    <a href="<?php echo get_theme_mod('social_linkedin'); ?>" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://johannburkard.de/resources/Johann/jquery.highlight-4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script> -->

<script src="<?php echo bloginfo('template_url'); ?>/assets/js/custom.js"></script>


<?php wp_footer(); ?>

<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        $("body.search-no-results, body.search-results").removeClass("search");
    });


    /* catogery filter */
    $(function() {

        $("#how_keyword").on("click", function(a) {
            $("#how_to_datafetch").addClass("on");
            a.stopPropagation()
        });
        $(document).on("click", function(a) {
            if ($(a.target).is("#how_to_datafetch") === false) {
                $("#how_to_datafetch").removeClass("on");
            }
        });
    });

    $('#header_search form').addClass('search-form');

    /* gt select lang text replace */

    $(document).ready(function() {

        var i = 1;

        $('#detail-wrap>p').each(function() {

            $(this).attr('id', `test${i}`);
            i++;


        });





    });



    $(document).ready(function() {
        var i = 1;


        $('div#home-content-wrap p').each(function() {

            $(this).attr('id', `test${i}`);

            i++;

        });

        $('.show-more-button').click(function() {
            $('.text_content').toggleClass('show');



        });




    });
    /* Hide clear button (if present) and adjust the search input field */
    jQuery(document).ready(function($) {
        // Check if the search results are present on the page
        if ($('.search-results').length) {
            // Clear the search input field
            $('input.is-search-input').val('');
        }
    });
</script>

<?php if (ICL_LANGUAGE_CODE == 'en') { ?>
    <script>
        $('.is-search-input').attr('placeholder', 'What are you looking for?');
    </script>
<?php } ?>
</body>

</html>