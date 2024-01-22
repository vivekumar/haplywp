<?php /* Template Name: Pro Page12 */
get_header();?>


<?php 
    $mid_section = get_field('mid_section');

?>
    <section class="about1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="about_sec">
						
                        <div class="line"></div>
                        <h1 class="h1"><?php echo $mid_section['heading'];?></h1>

                        <div class="inline_btn">
                            <a href="<?php echo $mid_section['url_first']['url'];?>" class="btn custom-btn "><?php echo $mid_section['url_first']['title']?$mid_section['url_first']['title']:'Gratis  prøveperiode';?></a>
                            <a href="<?php echo $mid_section['url_sec']['url'];?>" class="btn hover-btn "><?php echo $mid_section['url_sec']['title']?$mid_section['url_sec']['title']:'Prøv vores demo';?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php $i=1; foreach($mid_section['first_divisoin'] as $value){
    //print_r($value);
        if($i%2!=0) { ?>
        <?php $heading_line = $value['sub_heading']?>

        <?php if(!empty($heading_line) ):?>
            <section class="about">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="about_sec">
						<?php $heading_line = $value['sub_heading']?>
						
                        <div class="line"></div>
						
                        <h2 class="h2"><?php echo $value['sub_heading'];?></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php  endif;?>


    <section class="leftImg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="leftImg img">
                        <div class="leftImg_style">
                            <img src="<?php echo $value['image'];?>" alt="" class="img-fluid">
                            <!--<p class="digit">3:2</p>-->
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="leftImg content lg-pl-34">
                        <div class="heading ">
                            <h3 ><?php echo $value['heading'];?></h3>
                            <p>
                            	<?php echo mb_strimwidth($value['content'], 0, 1000, "..."); ?>
                            </p>
                        </div>
                        <a href="<?php echo $value['link']['url'];?>" class="btn custom-btn"><?php echo $value['link']['title']?$value['link']['title']:'Free trial period'; ?></a> <!--Free trial period-->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php }else{ ?>
        <?php $sub_head_line = $mid_section['sub_heading'];?>

	<?php if(empty($heading_line) ):?>
            <section class="about product<?php echo $i;?>">
		<div class="container-fluid">
		    <div class="row">
		        <div class="col-lg-8">
		            <div class="about_sec">
				<?php $heading_line = $value['sub_heading']?>
							
		                <div class="line"></div>
							
		                <h2 class="h2"><?php echo $value['sub_heading'];?></h2>
		            </div>
		        </div>
		    </div>
		</div>
	    </section>
	    <?php  endif;?>
	    <?php if(!empty($sub_head_line) ):?>

	    <section class="about">
		<div class="container-fluid">
		    <div class="row">
		        <div class="col-lg-8">
		            <div class="about_sec">
					
					
		                <div class="line"></div>
			
		                <h2 class="h2"><?php echo $sub_head_line;?></h2>
		            </div>
		        </div>
		    </div>
		</div>
	    </section>

	    <?php endif;?>



	    <section class="leftImg">
		<div class="container-fluid">
		    <div class="row">
		        <div class="col-md-6">
		            <div class="leftImg content pr-34">
		                <div class="heading">
		                    <h3><?php echo $value['heading'];?></h3>
		                    <p><?php echo mb_strimwidth($value['content'], 0, 1000, "..."); ?></p>
		                    <?php if($value['link']['url']){?>
		                     <a href="<?php echo $value['link']['url'];?>" class="btn custom-btn"><?php echo $value['link']['title']?></a>
		                    <?php }?>
		                </div>
		            </div>
		        </div>

		        <div class="col-md-6">
		            <div class="leftImg img">
		                <div class="leftImg_style">
		                    <img src="<?php echo $value['image'];?>" alt="" class="img-fluid">
		                    <!--<p class="digit">3:2</p>-->
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	    </section>


    <?php } $i++; } ?>


    
<?php get_footer();?>
