<?php
get_header();
?>
<style> 
	.is-hiddenn{display:none;}
</style>
<?php
$s=get_search_query();
$meta_query = array(
    array(
        'key'     => 'manage_theme',
        'value'   => THEME_NAME ? THEME_NAME : 'green', // THEME_NAME come form wp_config.php 
        'compare' => 'LIKE',
    )
);
$args = array(
    's' => $s,
    'post_type' => 'epkb_post_type_1',
    'meta_query' => $meta_query
);
// The Query
$the_query = new WP_Query( $args ); 
$count =  $the_query->post_count;

?>

<section class="about mb-64 notfound">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="about_sec">
                        <div class="line wow slideInUp" data-wow-delay=".7s"></div>
                    <?php    if ( $the_query->have_posts() ) {
                    _e("<h1 class='h1 wow slideInUp'> Din søgning på '".get_query_var('s')."' gav  $count resultater </h1>");
                    ?>
                        <div class="search" id="search-category">
                            <form class="search-form wow slideInUp">
                                <input class="form-control search_input"  id="myInput" type="text" placeholder="Search in articles">
                                <button class="btn btn-search" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>

                            <!-- <div class="search-wrap">
                                <ul>
                                    <li><a href="search.html">Kundeklausuler indgået efter 1. januar 2016</a></li>
                                    <li><a href="search.html">Kundeklausuler for dummies</a></li>
                                    <li><a href="search.html">Professionelt salt og kundeservice</a></li>
                                    <li><a href="search.html">CX er det nye kundeservice</a></li>
                                    <li><a href="search.html">Styrk kundeoplevelsen med AI</a></li>
                                    <li><a href="search.html">AI er kommet for at blive i kunderelationer</a></li>
                                </ul>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="category">
        <div class="container-fluid">
            <div class="row grid grid-2">
                <?php
           while ( $the_query->have_posts() ) {
           $the_query->the_post();
                 ?>
                   <div class="col-lg-6 box col-md-12">
                    <div class="category-box">
                        <div class="category-img">
                        <?php 
                        global $post;
                        $feat_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID));   ?>
                        <?php if ($feat_image) { ?>
                                <img src="<?php echo $feat_image; ?>" alt="no-img" class="img-fluid">
                            <?php } else {
                                $upload_dir   = wp_upload_dir();
                                echo '<img class="img-fluid" src="' . $upload_dir['baseurl'] . '/2023/06/about-img1.png"/>';
                            } ?>
                  
                        </div>

                        <div class="content">
                            <div class="category-content">
                                <p><small>How-to</small></p>
                                <h3 class="highlight-text"><?php the_title(); ?></h3>
								<?php $the_query->post_modified; ?>

                                <p><?php echo wp_trim_words( get_the_content(), 40, '...' );?></p>
                            </div>

                            <div class="category-btn">
                                <a href="<?php the_permalink(); ?>" class="btn custom-btn">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
        }
    
                }
    else{
?>
        <h2 style='font-weight:bold;color:#000'>Nothing Found</h2>
        <div class="alert alert-info">
          <p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
        </div>
<?php } ?>
            </div>
        </div>
    </section>
<script>

let cards = document.querySelectorAll('.box')
    
function liveSearch() {
    let search_query = document.getElementById("myInput").value;
    
    //Use innerText if all contents are visible
    //Use textContent for including hidden elements
    for (var i = 0; i < cards.length; i++) {
        if(cards[i].textContent.toLowerCase()
                .includes(search_query.toLowerCase())) {
            cards[i].classList.remove("is-hiddenn");
        } else {
            cards[i].classList.add("is-hiddenn");
        }
    }
}

//A little delay
let typingTimer;               
let typeInterval = 300;  
let searchInput = document.getElementById('myInput');

searchInput.addEventListener('keyup', () => {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(liveSearch, typeInterval);
});
</script>
<?php
get_footer();

?>
