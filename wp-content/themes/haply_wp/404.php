<?php


get_header();
?>
<div class="container">
	<section class="page_404">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-5">
					<div class="text-center">
						<div class="four_zero_four_bg">
						<?php if(THEME_NAME=='green'){?>
							<img src="<?php echo bloginfo('template_url');?>/assets/img/404-img.png" alt="404" class="img-fluid">
							<?php }else{?>
							<img src="<?php echo bloginfo('template_url');?>/assets/img/notfound.png" alt="404" class="img-fluid">
							<?php }?>
							<h5 class="text-center ">404-fejl</h5>
						</div>
						<div class="contant_box_404">
							<h3 class="h2">Siden blev ikke fundet...</h3>
							<p>Siden du har forsøgt at åbne er midlertidigt nede. Opdater siden eller prøv igen om lidt.
							</p>
							<a href="javascript:history.back();" class="btn custom-btn">Gå tilbage</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php
get_footer();
