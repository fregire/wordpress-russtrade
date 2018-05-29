<?php get_header(); ?>
		<div class="main__inner">
			<section class="blog">
				<?php if(have_posts()): ?>
				<?php while(have_posts()): the_post(); ?>
					<article class="blog__item">
						<?php the_post_thumbnail('russtrade_thumb'); ?>
						<div class="blog__content">
							<h3 class="blog__headline"><?php the_title(); ?></h3>
							<p class="blog__intro"><?php echo CFS()->get("post_intro"); ?></p>
							<div class="blog__text hidden">
									<?php the_content(); ?>
							</div>
							<button class="blog__more">Показать все</button>
						</div>
					</article>
				<?php endwhile; ?>
				<?php else: ?>
					Записей нет!
				<?php endif; ?>
			</section>		
		</div>
<?php get_footer(); ?>