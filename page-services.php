<!-- 
	Template Name: Услуги 
-->
<?php get_header(); ?>
			<section class="services">
				<div class="services__inner">
					<!-- adv - advantages - преимущества -->
					<article class="adv">
						<h2 class="adv__headline visually-hidden">Преимущества нашей компании</h2>
						<?php 
							$advs = CFS()->get('adv');
							foreach($advs as $adv){
								$title = $adv['adv_headline'];
								$icon = $adv["adv_icon"];
								$text = $adv["adv_text"];
						?>
							<div class="adv__item">
								<img class="adv__icon" src="<?php echo $icon; ?>" alt="">
								<h3 class="adv__headline item-headline"><?php echo $title; ?></h3>
								<p class="adv__content"><?php echo $text; ?></p>
							</div>
						<?php
							}
						?>
					</article>
					<!-- scheme - схема -->
					<article class="services__scheme scheme">
						<h2 class="headline">Схема работы</h2>
						<h3 class="scheme__headline item-headline"><?php echo CFS()->get("scheme_headline"); ?></h3>
						<div class="scheme__content">
							<?php if(have_posts):
								the_post();
								the_content();
							endif;
						 	?>
						</div>
						
						<div class="scheme__slider">
							<!-- Таксономия на посте - taxonomy1 -->
							<!-- Тип поста - elem -->
							<?php 
								$terms = get_terms("taxonomy1");

								foreach($terms as $term){
							?>
							<div class="scheme__group">
								<?php 
									$posts = get_posts(array(
										'numberposts' => 0,
										'post_type' => 'elem',
										'tax_query' => array(
											array(
												'taxonomy' => 'taxonomy1',
												'field' => 'slug',
												'terms' => $term->slug
											)
										)
									));
									foreach($posts as $post){
										setup_postdata($post);
										$icon = CFS()->get('icon');
										$name = $post->post_title;
								?>
									<div class="scheme__item">
										<img src="<?php echo $icon; ?>" alt="">
										<p class="scheme__item-name"><?php echo $name; ?></p>
									</div>
								<?php		
									}
									wp_reset_postdata();
								?>
							</div>

							<?php		
								}
							?>
						</div>
						<div class="scheme__tabs">
							<?php 
								$i = 0;
								$terms = get_terms('taxonomy1');
								foreach($terms as $term){
							?>
							<div class="scheme__tab" data-index="<?php echo $i; ?>"><?php echo $term->name ?></div>
							<?php
								$i++;
								}
							?>
							<div class="scheme__tab-underline"></div>
						</div>
					</article>
					<article class="main-scheme">
						<h2 class="headline">Схема работы</h2>
						<ol class="main-scheme__scheme">
							<?php $steps = CFS()->get('scheme'); ?>
							<?php $i = 1; ?>
							<?php foreach($steps as $step): ?>
							<li class="main-scheme__item">
								<div class="main-scheme__num"><?php echo $i; ?></div>
								<h3 class="main-scheme__headline item-headline"><?php echo $step['scheme_title']; ?></h3>
								<p class="main-scheme__text"><?php echo $step['scheme_step']; ?></p>
							</li>
							<?php $i++; ?>
						<?php endforeach; ?>
						</ol>
					</article>	
				</div>
				<!-- descr - description - описание -->
				<article class="scheme-slider progress-slider">
					<?php $slides = CFS()->get("scheme-slider"); ?>
					<?php foreach($slides as $slide): ?>
						<div class="scheme-slider__slide" style="background-image: url(<?php echo $slide['scheme-slider_bg'] ;?>);">
							<div class="scheme-slider__content">
								<h2 class="scheme-slider__headline headline"><?php echo $slide['scheme-slider_title']; ?></h2>
								<p class="scheme-slider__descr"><?php echo $slide['scheme-slider__text']; ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</article>
				<article class="news">
					<div class="news__inner">
						<h3 class="news__headline">Новости компании</h3>
						<ul class="news__list">
							<?php 
								$posts = get_posts(array('numberposts' => 3, 'post_type' => 'news'));
								foreach ($posts as $post) {
									setup_postdata($post);
									$day = get_the_date("j");
									$month = get_the_date("F");
									$title = get_the_title();
									$link = get_the_permalink();
							?>
							<li class="news__item">
								<div class="news__date">
									<span class="news__day"><?php echo $day; ?></span>
									<p class="news__month"><?php echo $month; ?></p>
								</div>
								<a class="news__title" href="<?php echo $link; ?>"><?php echo $title; ?></a>
							</li>
							<?php
								}
								wp_reset_postdata();
							?>
						</ul>
					</div>
				</article>
			</section>
<?php get_footer(); ?>