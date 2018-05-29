<!-- 
	Template Name: Контакты
-->
<?php get_header(); ?>
			<section class="address">
				<div class="address__slider">
					<?php 
					$args = array(
						'numberposts' => 0,
						'category'    => 0,
						'orderby'     => 'date',
						'order'       => 'DESC',
						'post_type'   => 'address',
						'suppress_filters' => true,

					);
						$posts = get_posts($args);
						foreach($posts as $post){
							setup_postdata($post);
						$country = CFS()->get("country");
						$city = CFS()->get("city");
						$street = CFS()->get("street");
						$phone = CFS()->get("phone");
						$email = CFS()->get("email");
						$location = get_field("map");
						$lat = $location['lat'];
						$lng = $location['lng'];
					?>
					<div class="address__slide" data-lng="<?php echo $lng; ?>" data-lat="<?php echo $lat; ?>">
						<h2 class="address__city headline"><?php  echo $country; ?>, <?php echo $city; ?></h2>
						<address class="address__item"><?php echo $street; ?></address>
						<address class="address__item">Тел.: <?php echo $phone; ?></address>
						<address class="address__item">E-mail: <?php echo $email; ?></address>
					</div>
					<?php		
						}
						wp_reset_postdata();

					?>
				</div>
				<div class="address__map">
					<div class="address__header">
						<div class="address__wrapper">
							<?php 
								$posts = get_posts(array('numberposts' => 0, 'post_type' => 'address'));

								foreach ($posts as $post) {
									setup_postdata($post);
									$loc = get_field("map");
									$city = CFS()->get("city");
							?>
							<div class="address__item-city" data-lng="<?php echo $loc['lng']; ?>" data-lat="<?php echo $loc['lat']; ?>"><?php echo $city; ?></div>
							<?php		
								}
								wp_reset_postdata();
							?>
						</div>
					</div>
					<div class="address__map-main">
						
					</div>
				</div>
			</section>
<?php get_footer(); ?>