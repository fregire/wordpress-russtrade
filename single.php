<?php get_header(); ?>
	<?php the_post(); ?>
		<div class="main__inner">
			<section class="news-item">
				<h2 class="headline"><?php the_title(); ?></h2>
				<time class="news-item__date"><?php the_date(); ?></time>
				<div class="news-item__content">
					<?php the_content(); ?>
				</div>
			</section>
		</div>
<?php get_footer(); ?>