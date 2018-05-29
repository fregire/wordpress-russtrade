	</main>	
	<footer class="footer">
		<div class="footer__top">
			<?php the_custom_logo(); ?>
			</a>
			<nav class="footer__menu menu">
				<?php wp_nav_menu([
					'theme_location'  => 'main_menu',
					'menu'            => '', 
	                'container'       => false, 
	                'menu_class'      => 'menu__list', 
	                'menu_id'         => 'menu__list',
	                'echo'            => true,
	                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	                'depth'           => 0,
	                'walker'          => '',

				]); ?>
			</nav>
			<div class="options">
					<button class="options__lang options__lang--footer">EN</button>
					<button class="options__lang options__lang--footer">CH</button>
					<?php get_search_form(); ?>
			</div>
		</div>
		<div class="footer__bottom">
			<div class="footer__phones">
				<?php $posts = get_posts(array('post_type'=>'footer-phones')); ?>
				<?php foreach ($posts as $post) {
					setup_postdata($post);
					$phone = CFS()->get("footer_phone");
				?>
				<h4 class="footer__headline"><?php the_title(); ?></h4>
				<a href="tel:<?php echo $phone;?>" class="phone"><?php echo $phone; ?></a>
				<?php
				} 
				wp_reset_postdata();
				?>
				<a href="<?php echo get_permalink(14); ?>" class="footer__faq">Задать вопрос</a>
			</div>
			<div class="footer__politics">
				<?php $post = get_posts(array("numberposts" => 1, 'post_type' => 'politics')); ?>
				<?php echo $post[0]->post_content; ?>
				
				<h4 class="footer__headline"><?php echo $post[0]->post_title; ?></h4>
			</div>
			<div class="footer__directions">
				<h4 class="footer__headline">Наши направления</h4>
				<div class="footer__wrapper">
					<?php 
						$posts = get_posts(array('numberposts' => 0, 'post_type' => 'paths')); 
						foreach ($posts as $post) {
							setup_postdata($post);
							$logo = CFS()->get("paths_logo");
							$present = CFS()->get("paths_pdf");
							if(strlen($logo) != 0):
						?>
							<a target="_blank" href="<?php echo $present; ?>"><img src="<?php echo $logo; ?>" alt="Логотип направления компании"></a>

						<?php
							endif;
							}
							wp_reset_postdata();
						?>
				</div>
			</div>
			<div class="footer__social social">
				<h4 class="footer__headline">Мы в соцсетях</h4>	
				<?php 
					$posts = get_posts(array('numberposts' => 0, 'post_type' => 'social')); 

					foreach ($posts as $post) {
						setup_postdata($post);
						$link = CFS()->get("social_link");
						$icon = CFS()->get("social_icon");
				?>
				<a target="_blank" href="<?php echo $link; ?>" class="social__item">
					<span>
						<img src="<?php echo $icon; ?>" alt="">
					</span>
					<?php the_title(); ?>
				</a>

				<?php
					}
					wp_reset_postdata();
				?>
			</div>
		</div>
	</footer>
 	
	<?php 	wp_footer(); ?>
	

	<!-- Если это страница контактов, то подключаем гугл карты -->
	<?php if(is_page(14)): ?>

	<!-- Google maps -->
	<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAk58GUG0LK9LhJc16PkD78Nib1qry0N4&callback=initMap">
 	</script>
	<script defer>
 		//// Google карта  ////
	var slides = document.querySelectorAll(".address__slide");
	function initMap() {
	    var uluru = {lat: parseFloat(slides[0].getAttribute('data-lat')), lng: parseFloat(slides[0].getAttribute('data-lng'))};
	    var zoom = 16;
	    var icon = '<?php echo get_template_directory_uri() . '/img/website_icons/geo-icon.png' ;?>';
	    var map = new google.maps.Map(document.querySelector('.address__map-main'), {
	      zoom: zoom,
	      center: uluru
	    });
	    var marker = new google.maps.Marker({
	      position: uluru,
	      map: map,
	      icon: icon
	    });
	    console.dir(marker);
	    var cities = document.querySelectorAll(".address__item-city");
		for(var i = 0; i < cities.length; i++){
			cities[i].addEventListener("click", function(){
				var lat = parseFloat(this.getAttribute('data-lat'));
				var lng = parseFloat(this.getAttribute('data-lng'));
				map = new google.maps.Map(document.querySelector('.address__map-main'), {
			      zoom: zoom,
			      center: {lat: lat, lng: lng}
			    });
			    marker = new google.maps.Marker({
			      position: {lat: lat, lng: lng},
			      map: map,
			      icon: icon
			    });
			});
		}
		$(".address__slider").on("afterChange", function(slick, currentSlide){
			var currentSlide = $('.slick-current').find(".address__slide")[0];
			var lat = $(currentSlide).attr("data-lat");
			var lng = $(currentSlide).attr("data-lng");
			console.log(lng);
			map = new google.maps.Map(document.querySelector('.address__map-main'), {
			      zoom: zoom,
			      center: {lat: parseFloat(lat), lng: parseFloat(lng)}
			    });
		    marker = new google.maps.Marker({
		      position: {lat: parseFloat(lat), lng: parseFloat(lng)},
		      map: map,
		      icon: icon
		    });
		});

	}
 	</script>

 	<?php endif; ?>
 	<?php if(is_search()): ?>
 	<script>
 		////  Чекбокс для поиска в новостях ////
 	var checked = true;
 	var container = document.querySelector(".search__content").cloneNode(true);
 	var nums = document.querySelector(".counter").textContent;
	$(".checkbox-field").submit(function(e){
		var url = window.wp.ajax_url;
		e.preventDefault();
		$(".search__content").html("");
		var requestValue = $($(this).children("input[type='text']")[0]).val();
		if(checked === true){
			$(this).addClass("checkbox-field--checked");
			checked = false;
			var data = {
				action: 'russtrade',
				checked: checked,
				value: requestValue
			};
			$.ajax({
				url: url,
				type: 'GET',
				data: data,
				success: function(result){
					$(".search__content").html(result);	
					var last = $(".search__item").last().attr("data-index") || 0;
					$(".counter").html(parseInt(last));
				}
			});
		} else {
			checked = true;
			$(this).removeClass("checkbox-field--checked");
			$(".search__content").html(container);
			$(".counter").html(parseInt(nums));
		}

	});
 	</script>
 	<?php endif; ?>
</body>
</html>