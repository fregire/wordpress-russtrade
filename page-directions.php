<!-- 
	Template Name: Решения
-->
<?php get_header(); ?>
			<section class="paths">
				<div class="paths__main-text">
					<h2 class="headline">Наши направления</h2>
					<div>
						<?php if(have_posts):
								the_post();
								the_content();
							endif;
						 ?>
					</div>
				</div>
				<div class="paths__slider path-slider progress-slider">
					<?php 
					$posts = get_posts(array('numberposts' => 0, "post_type" => 'paths'));
					foreach($posts as $post){
						setup_postdata($post);
						$title = CFS()->get("paths_name");
						$present = CFS()->get("paths_pres");
						$pdf = CFS()->get("paths_pdf");
						$bg = CFS()->get("paths_bg");

					?>
					<div class="path-slider__slide" style="background-image: url(<?php echo $bg; ?>)">
						<div class="path-slider__wrapper">
							<div class="path-slider__img">
								<img src="<?php echo $present; ?>" alt="">
							</div>
							<div class="path-slider__content">
								<p class="path-slider__text">
									<?php echo $title; ?>
								</p>
								<a target="_blank" href="<?php echo $pdf ?>" class="path-slider__download btn">Скачать презентацию</a>
							</div>							
						</div>
					</div>

					<?php
					}
					wp_reset_postdata();

					?>
				</div>
				<div class="paths__our-ways">
					<?php 
					$posts = get_posts(array('numberposts' => 0, 'post_type' => 'paths'));

					foreach($posts as $post){
						setup_postdata($post);
						$logo = CFS()->get("paths_logo");
						$text = CFS()->get("paths_text");
					?>

					<div class="paths__our-ways-item">
						<div class="paths__our-ways-img">
							<img src="<?php echo $logo; ?>" alt="">
						</div>
						
						<p class="paths__our-ways-text">
							<?php echo $text; ?>
						</p>
					</div>

					<?php
					}

					?>
				</div>
			</section>
<?php get_footer(); ?>