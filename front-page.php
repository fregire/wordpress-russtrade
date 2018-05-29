<!-- 
	Template Name: Главная страница
-->
<?php get_header(); ?>
			<section class="company">
				<div class="company__about">
					<h2 class="headline headline--company">О компании</h2>
					<p class="company__important">Товарищи! консееультация с широким активом требуют от нас анализа новых. </p>
					<div class="company__text">
						<?php if(have_posts):
								the_post();
								the_content();
							endif;
						 ?>
					 </div>
				</div>
				<div class="company__statistics" style="background-image: url(<?php echo CFS()->get("company_bg"); ?>)">
					<div class="company__numbers">
						<!-- Получение произвольных полей статистики для страницы 
						компании  и вывод их -->
						<?php $company_blocks = CFS()->get("company_stats");
							foreach($company_blocks as $company_block){
						?>
							<div class="company__num">
								<span><?php echo $company_block['company_num']; ?></span>
								<p><?php echo $company_block['company_text']; ?></p>
							</div>
						<?php
							}
						?>
					</div>
				</div>
				<div class="news">
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
				</div>
			</section>	
<?php get_footer(); ?>