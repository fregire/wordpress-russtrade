<!-- 
	Template Name: Страница поиска
 -->
<?php get_header(); ?>
<div class="main__inner">
	<section class="search">
		<div class="search__header">
			<div class="search__count-news">
				<?php 	
					$request = $_GET['s'];
					$numberRes = (int)$wp_query->found_posts;
					if($numberRes % 10 == 1)
					{
						$resultWord = 'результат';
					} else if(($numberRes % 10 == 2) || ($numberRes % 10 == 3) || ($numberRes % 10 == 4))
					{
						$resultWord = 'результата';
					} else {
						$resultWord = 'результатов';
					}
					if($numberRes == 1){
						$wordFind = 'найден';
					} else {
						$wordFind = 'найдено';
					}
				?>
				По запросу <span class="search__count-res">&laquo;<?php echo $request; ?>&raquo;</span> 
				<?php echo $wordFind; ?> <span class="counter"><?php echo $numberRes; ?></span> <?php echo $resultWord; ?>
			</div>
			<div class="search__find-news">
				<label class="search__label" for="checkbox-field">Искать в новостях</label>
				<form class="checkbox-field" role="search" method="get" id="searchform">
					<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" />
					<input class="checkbox-field__checkbox" id="searchsubmit"  type="submit" id="checkbox-field" value="">
					<input type="hidden" value="news" name="post_type" />
				</form>
			</div>
		</div>
		<div class="search__content">
			<?php if(have_posts()): while(have_posts()): the_post(); ?>
				<?php $content = get_the_content(); ?>
			<div class="search__item">
				<h2 class="headline"><?php the_title(); ?></h2>
				<div class="search__text">
					<?php  
						the_excerpt(); 
					?>
				</div>
				<a href="<?php the_permalink();?>"><?php the_permalink(); ?></a>
			</div>
			<?php endwhile; ?>
			<?php else: ?>
				Ничего не найдено
			<?php endif; ?>
		</div>
	</section>
</div>
<?php get_footer(); ?>