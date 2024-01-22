<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wavedesign
 */

get_header();
?>

	<main id="primary" class="site-main" style="min-height:calc(100vh - 100px)">
	<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h2><?php the_title();?></h2>
			<p><?php the_content();?></p>
		</div>
	</div>
</div>

	</main><!-- #main -->

<?php

get_footer();
