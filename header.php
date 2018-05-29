<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title>Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
	<?php if(is_page(14)): ?>
		<!-- 14 - id страницы контактов -->
		<style>
				.header {
					height: auto;
					padding-bottom: 60px;
				}
		</style>
	<?php endif; ?>
	<!-- 	Подключение иконок для элементов -->
	<style>
		.slick-arrow {
			background-image: url(<?php echo get_template_directory_uri() . '/img/website_icons/arrow-left-icon_address.svg'; ?>);
		}
		.scheme-slider .slick-arrow,
		.header__link,
		.path-slider .slick-arrow {
			background-image: url(<?php echo get_template_directory_uri() . '/img/website_icons/arrow-left_icon.svg'; ?>);
		}
		.options__search-btn {
			background-image: url(<?php echo get_template_directory_uri() . '/img/website_icons/header_search-icon.png'; ?>);
		}
		.footer .options__search-btn {
			background-image: url(<?php echo get_template_directory_uri() . '/img/website_icons/footer_search-icon.png'; ?>);
		}
		.options__search-btn--opened {
			background-image: url(<?php echo get_template_directory_uri() . '/img/website_icons/search-icon_clicked.png'; ?>);
		}
		.options__close {
			background-image: url(<?php echo get_template_directory_uri() . '/img/website_icons/close_icon.svg'; ?>);
		}
		.menu__btn {
			background-image: url(<?php echo get_template_directory_uri() . '/img/website_icons/menu.svg'; ?>);
		}
	</style>
</head>
<body <?php body_class(); ?>>
	<?php 
	$url = $_SERVER['REQUEST_URI'];
	$id = url_to_postid($url);
	if(is_home()){
		$id = 7;
	} 
	?>
	<header class="header" style="background-image: url(<?php echo CFS()->get('main_bg', $id);?>)">
		<div class="header__main">
			<div class="header__top">
				<?php the_custom_logo(); ?>
				<div class="options">
					<button class="options__lang">EN</button>
					<button class="options__lang">CH</button>
					<?php echo get_search_form("header"); ?>
				</div>
			</div>
			<!--Если это страница контактов, то выводим формы, 
				иначе обычный заголовок -->
			<?php if(is_page(14)): ?>
			<div class="header__contacts contacts">
				<div class="contacts__phones">
					<address>
						<span>Поддержка для клиентов сервиса:</span>
						<p class="contacts__phone phone phone--header"><?php echo CFS()->get('users_num'); ?></p>
					</address>	
					<address>
						<span class="contacts__section-sell">Отдел продаж:</span>
						<p class="contacts__phone phone phone--header"><?php echo CFS()->get('user_sale'); ?></p>
					</address>
				</div>
				<?php echo do_shortcode('[contact-form-7 id="184" title="Контактная форма"]'); ?>
			</div>
			<?php else: ?>
			<div class="header__title">
				<h1 class="headline"><?php echo CFS()->get("main_title", $id); ?></h1>
				<p><?php echo CFS()->get('main_descr', $id); ; ?></p>
			
				<?php if(is_home() || is_search() || is_single()): ?>
				<a href="<?php bloginfo('url'); ?>" class="header__link">На главную</a>
				<?php endif; ?>	
			</div>
			<?php endif; ?>
		</div>
		<?php if(is_search() || is_home()): ?>
		<?php else: ?>
		<nav class="header__menu menu">
			<h2 class="menu__title">Меню сайта</h2>
			<button class="menu__btn"></button>
			<?php wp_nav_menu([
					'theme_location'  => 'main_menu',
					'menu'            => '', 
	                'container'       => false, 
	                'menu_class'      => 'header__menu-list menu__list', 
	                'menu_id'         => 'menu__list',
	                'echo'            => true,
	                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	                'depth'           => 0,
	                'walker'          => '',

			]); ?>
		</nav>	
		<?php endif; ?>
	</header>
	<main class="main">