<!-- 
	Template Name: Клиенты 
-->
<?php get_header(); ?>
		<div class="main__inner">
			<section class="clients">
				<div class="clients__main-block">
					<h2 class="headline">Наши клиенты</h2>
					<div class="clients__descr">
						<?php if(have_posts()):
								the_post();
								the_content();
							endif;
						 ?>
					</div>
				</div>
				<?php  
					$posts = get_posts(array('numberposts' => 0, 'post_type' => 'clients'));

					foreach($posts as $post){
						setup_postdata($post);

				?>

				<article class="clients__item">
					<?php the_post_thumbnail('clients_thumb', array('class'=> 'clients__image')); ?>
					<div class="clients__content">
						<h3 class="clients__headline item-headline"><?php the_title(); ?></h3>
						<div class="clients__text"><?php the_content(); ?> </div>
						<time class="clients__date"><?php echo CFS()->get("clients_year") ?>г</time>
					</div>
				</article>

				<?php		
					}
					wp_reset_postdata();
				?>
			</section>

			<section class="thanks">
				<div class="thanks__content">
					<h2 class="headline">Благодарные клиенты</h2>
					<div class="clients__descr">
						<?php echo CFS()->get('clients_descr'); ?>
					</div>
				</div>
				<div class="thanks__letters">
					<?php $posts = get_posts(array('numberposts' => 0, 'post_type'=> 'clients'));
						foreach($posts as $post){
					?>
					<img src="<?php echo CFS()->get('clients_letter'); ?>" alt="Благодарственное письмо">
					<?php
						}
						wp_reset_postdata();
					?>
				</div>
			</section>			
		</div>
<?php get_footer(); ?>