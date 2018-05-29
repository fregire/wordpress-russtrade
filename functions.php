<?php 

	add_action("wp_enqueue_scripts", "russtrade_styles");
	add_action("wp_enqueue_scripts", "russtrade_scripts");
	add_action("after_setup_theme", "russtrade_setup");
	add_action("init", "russtrade_post_types");
	add_action("widgets_init", 'russtrade_widgets');
	global $globalV;
	//$globalV = CFS()->get('news-title', 228);
	function russtrade_styles(){
		wp_enqueue_style("fonts", get_template_directory_uri() . '/css/fonts.css');
		wp_enqueue_style("libs", get_template_directory_uri() . '/css/libs.min.css');
		wp_enqueue_style("main", get_stylesheet_uri());	
		wp_enqueue_style("media-russtrade", get_template_directory_uri() . '/css/media.css');
	}

	function russtrade_scripts(){
		wp_deregister_script("jquery");
		wp_register_script("jquery", get_template_directory_uri() . '/js/jquery.min.js', array(), null, true);
		wp_enqueue_script("jquery");
		wp_enqueue_script("slick", get_template_directory_uri() . '/js/slick.min.js', array("jquery"), null, true);
		wp_enqueue_script("main", get_template_directory_uri() . '/js/main.js', array("jquery"), null, true);
	}

	function russtrade_setup(){
		add_theme_support("custom-logo");
		add_theme_support("post-thumbnails");
		add_image_size("russtrade_thumb", 422, 188, false);
		add_image_size("clients_thumb", 436, 279, false);

		register_nav_menu("main_menu", "Меню сайта");
	}

	// Изменение кастомной формы на сайте
	add_filter( 'get_search_form', 'russtrade_form' );
	function russtrade_form( $form ) {

		$form = '
		<form  class="options__search options__search--closed" role="search" method="get" id="searchform" action="' . home_url( '/search/' ) . '" >
			<input class="options__search-form"  type="text" value="' . get_search_query() . '" name="s" id="s" />
			<input  class="options__search-btn" type="submit" id="searchsubmit" value="" />
			<a href="#" class="options__close"></a>
			<input type="hidden" name="post_types" value="page">
		</form>';

		return $form;
	}
	// Изменение страницы поиска
	function russtrade_search_page( $query ) {

	    $page_id = 209; 
	    $per_page = 10;
	    $id_404 = 223;

	    // Now we must edit only query on this one page
	    if ( !is_admin() && $query->is_main_query() && $query->queried_object->ID == $page_id  ) {
	        // I like to have additional class if it is special Query like for activity as you can see
	        add_filter( 'body_class', function( $classes ) {
	            $classes[] = 'search_page';
	            return $classes;
	        } );
	        $query->set( 'pagename', '' ); // we reset this one to empty!
	            $query->set( 'posts_per_page', $per_page ); // set post per page or dont ... :)
	            // 3 important steps (make sure to do it, and you not on archive page, 
	            // or just fails if it is archive, use e.g. Query monitor plugin )
	            $query->is_search = true; // We making WP think it is Search page 
	            $query->is_page = true; // disable unnecessary WP condition
	            $query->is_singular = false; // disable unnecessary WP condition
	        }
	}
	add_action( 'pre_get_posts', 'russtrade_search_page' );
	
	// Решистрация произвольных типов записей 
	function russtrade_post_types(){
		register_post_type('address', array(
			'label'  => null,
			'labels' => array(
				'name'               => 'Адрес', // основное название для типа записи
				'singular_name'      => 'Адрес', // название для одной записи этого типа
				'add_new'            => 'Добавить адрес', // для добавления новой записи
				'add_new_item'       => 'Добавление адреса', // заголовка у вновь создаваемой записи в админ-панели.
				'edit_item'          => 'Редактирование адреса', // для редактирования типа записи
				'new_item'           => 'Новый адрес', // текст новой записи
				'view_item'          => 'Смотреть адрес', // для просмотра записи этого типа.
				'search_items'       => 'Искать адрес', // для поиска по этим типам записи
				'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
				'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
				'parent_item_colon'  => '', // для родителей (у древовидных типов)
				'menu_name'          => 'Адрес', // название меню
			),
			'description'         => 'Добавьте адрес и контакты',
			'public'              => true,
			'menu_position'		  => 2,
			'menu_icon'           => 'dashicons-location', 
			'hierarchical'        => false,
			'supports'            => array('title'),
			'taxonomies'          => array(),
			'has_archive'         => false,
			'rewrite'             => true,
			'query_var'           => true,
		));
		register_post_type('paths', array(
			'label'  => null,
			'labels' => array(
				'name'               => 'Направления', // основное название для типа записи
				'singular_name'      => 'Направление', // название для одной записи этого типа
				'add_new'            => 'Добавить направление', // для добавления новой записи
				'add_new_item'       => 'Добавление направления', // заголовка у вновь создаваемой записи в админ-панели.
				'edit_item'          => 'Редактирование направления', // для редактирования типа записи
				'new_item'           => 'Новое направление', // текст новой записи
				'view_item'          => 'Смотреть направление', // для просмотра записи этого типа.
				'search_items'       => 'Искать направление', // для поиска по этим типам записи
				'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
				'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
				'parent_item_colon'  => '', // для родителей (у древовидных типов)
				'menu_name'          => 'Направления', // название меню
			),
			'description'         => 'Добавьте направление Вашей компании',
			'public'              => true,
			'menu_position'		  => 2,
			'menu_icon'           => 'dashicons-location-alt', 
			'hierarchical'        => false,
			'supports'            => array('title'),
			'taxonomies'          => array(),
			'has_archive'         => false,
			'rewrite'             => true,
			'query_var'           => true,
		));
		register_post_type('clients', array(
			'label'  => null,
			'labels' => array(
				'name'               => 'Клиенты', // основное название для типа записи
				'singular_name'      => 'Клиент', // название для одной записи этого типа
				'add_new'            => 'Добавить клиента', // для добавления новой записи
				'add_new_item'       => 'Добавление клиента', // заголовка у вновь создаваемой записи в админ-панели.
				'edit_item'          => 'Редактирование клиента', // для редактирования типа записи
				'new_item'           => 'Новый клиент', // текст новой записи
				'view_item'          => 'Смотреть клиента', // для просмотра записи этого типа.
				'search_items'       => 'Искать клиента', // для поиска по этим типам записи
				'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
				'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
				'parent_item_colon'  => '', // для родителей (у древовидных типов)
				'menu_name'          => 'Клиенты', // название меню
			),
			'description'         => 'Добавьте отзыв клиента о Вашей компании',
			'public'              => true,
			'menu_position'		  => 2,
			'menu_icon'           => 'dashicons-groups', 
			'hierarchical'        => false,
			'supports'            => array('title', 'editor', 'thumbnail'),
			'taxonomies'          => array(),
			'has_archive'         => false,
			'rewrite'             => true,
			'query_var'           => true,
		));
		register_post_type('social', array(
			'label'  => null,
			'labels' => array(
				'name'               => 'Социальные сети', // основное название для типа записи
				'singular_name'      => 'Социальная сеть', // название для одной записи этого типа
				'add_new'            => 'Добавить соцсеть', // для добавления новой записи
				'add_new_item'       => 'Добавление соцсети', // заголовка у вновь создаваемой записи в админ-панели.
				'edit_item'          => 'Редактирование соцсети', // для редактирования типа записи
				'new_item'           => 'Новая соцсеть', // текст новой записи
				'view_item'          => 'Смотреть соцсеть', // для просмотра записи этого типа.
				'search_items'       => 'Искать соцсеть', // для поиска по этим типам записи
				'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
				'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
				'parent_item_colon'  => '', // для родителей (у древовидных типов)
				'menu_name'          => 'Соцсети', // название меню
			),
			'description'         => 'Добавьте страницу компании в соц сетях',
			'public'              => true,
			'menu_position'		  => 2,
			'menu_icon'           => 'dashicons-thumbs-up', 
			'hierarchical'        => false,
			'supports'            => array('title'),
			'taxonomies'          => array(),
			'has_archive'         => false,
			'rewrite'             => true,
			'query_var'           => true,
		));
		register_post_type('elem', array(
			'label'  => null,
			'labels' => array(
				'name'               => 'Элемент', // основное название для типа записи
				'singular_name'      => 'Социальная сеть', // название для одной записи этого типа
				'add_new'            => 'Добавить элемент', // для добавления новой записи
				'add_new_item'       => 'Добавление соцсети', // заголовка у вновь создаваемой записи в админ-панели.
				'edit_item'          => 'Редактирование соцсети', // для редактирования типа записи
				'new_item'           => 'Новая соцсеть', // текст новой записи
				'view_item'          => 'Смотреть соцсеть', // для просмотра записи этого типа.
				'search_items'       => 'Искать соцсеть', // для поиска по этим типам записи
				'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
				'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
				'parent_item_colon'  => '', // для родителей (у древовидных типов)
				'menu_name'          => 'Элемент', // название меню
			),
			'description'         => 'Добавьте страницу компании в соц сетях',
			'public'              => true,
			'menu_position'		  => 2,
			'menu_icon'           => null, 
			'hierarchical'        => false,
			'supports'            => array('title'),
			'taxonomies'          => array(),
			'has_archive'         => false,
			'rewrite'             => true,
			'query_var'           => true,
		));
		// Таксономии для элемента
		register_taxonomy('taxonomy1', array('elem'), array(
			'label'                 => '', // определяется параметром $labels->name
			'labels'                => array(
				'name'              => 'Раздел Оборудования',
				'singular_name'     => 'Genre',
				'search_items'      => 'Search Genres',
				'all_items'         => 'All Genres',
				'view_item '        => 'View Genre',
				'parent_item'       => 'Parent Genre',
				'parent_item_colon' => 'Parent Genre:',
				'edit_item'         => 'Edit Genre',
				'update_item'       => 'Update Genre',
				'add_new_item'      => 'Add New Genre',
				'new_item_name'     => 'New Genre Name',
				'menu_name'         => 'Категория оборудования',
			),
			'description'           => '', // описание таксономии
			'public'                => true,
			'publicly_queryable'    => null, // равен аргументу public
			'show_in_nav_menus'     => true, // равен аргументу public
			'show_ui'               => true, // равен аргументу public
			'show_in_menu'          => true, // равен аргументу show_ui
			'show_tagcloud'         => true, // равен аргументу show_ui
			'show_in_rest'          => null, // добавить в REST API
			'rest_base'             => null, // $taxonomy
			'hierarchical'          => false,
			'update_count_callback' => '',
			'rewrite'               => true,
			//'query_var'             => $taxonomy, // название параметра запроса
			'capabilities'          => array(),
			'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
			'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
			'_builtin'              => false,
			'show_in_quick_edit'    => null, // по умолчанию значение show_ui
		) );
		register_post_type('news', array(
			'label'  => null,
			'labels' => array(
				'name'               => 'Новости', // основное название для типа записи
				'singular_name'      => 'Новость', // название для одной записи этого типа
				'add_new'            => 'Добавить новость', // для добавления новой записи
				'add_new_item'       => 'Добавление новости', // заголовка у вновь создаваемой записи в админ-панели.
				'edit_item'          => 'Редактирование новости', // для редактирования типа записи
				'new_item'           => 'Новая новость', // текст новой записи
				'view_item'          => 'Смотреть новость', // для просмотра записи этого типа.
				'search_items'       => 'Искать новость', // для поиска по этим типам записи
				'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
				'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
				'parent_item_colon'  => '', // для родителей (у древовидных типов)
				'menu_name'          => 'Новости', // название меню
			),
			'description'         => 'Добавьте новости Вашей компании',
			'public'              => true,
			'menu_position'		  => 2,
			'menu_icon'           => "dashicons-admin-site", 
			'hierarchical'        => false,
			'supports'            => array('title', 'editor'),
			'taxonomies'          => array(),
			'has_archive'         => false,
			'rewrite'             => true,
			'query_var'           => true,
		));
		register_post_type('footer-phones', array(
			'label'  => null,
			'labels' => array(
				'name'               => 'Номера в футере', // основное название для типа записи
				'singular_name'      => 'Номер', // название для одной записи этого типа
				'add_new'            => 'Добавить номер', // для добавления новой записи
				'add_new_item'       => 'Добавление номера', // заголовка у вновь создаваемой записи в админ-панели.
				'edit_item'          => 'Редактирование номера', // для редактирования типа записи
				'new_item'           => 'Новый номер', // текст новой записи
				'view_item'          => 'Смотреть номер', // для просмотра записи этого типа.
				'search_items'       => 'Искать номер', // для поиска по этим типам записи
				'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
				'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
				'parent_item_colon'  => '', // для родителей (у древовидных типов)
				'menu_name'          => 'Номера в футере', // название меню
			),
			'description'         => 'Добавьте номера Вашей компании для футера',
			'public'              => true,
			'menu_position'		  => 2,
			'menu_icon'           => "dashicons-phone", 
			'hierarchical'        => false,
			'supports'            => array('title'),
			'has_archive'         => false,
			'rewrite'             => true,
			'query_var'           => true,
		));
	}
	register_post_type('politics', array(
			'label'  => null,
			'labels' => array(
				'name'               => 'Политика конфиденциальности в футере',
				'edit_item'          => 'Редактирование политики', // для редактирования типа записи
				'menu_name'          => 'Полит. конф.(футер)', // название меню
			),
			'description'         => 'Добавьте номера Вашей компании для футера',
			'public'              => true,
			'menu_position'		  => 15,
			'menu_icon'           => "dashicons-media-text", 
			'hierarchical'        => false,
			'supports'            => array('title', 'editor'),
			'has_archive'         => false,
			'rewrite'             => true,
			'query_var'           => true,
	));


	// Регистрация токена для Google Maps
	function my_acf_google_map_api( $api ){
	
	$api['key'] = 'AIzaSyB2Ta0CvmTU3MtW-Nnt_Nas_zNjNINhm8g';
	
	return $api;
		
	}
	add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


	// Передача переменных из php в js
	add_action("wp_head", "russtrade_vars");
	function russtrade_vars(){
		$vars = array(
			'ajax_url' => admin_url("admin-ajax.php")
		);
		echo '<script>window.wp =' . json_encode($vars) . '</script>';
	}
	add_action('wp_ajax_russtrade', 'russtrade_ajax');
	add_action("wp_ajax_nopriv_russtrade", 'russtrade_ajax');
	// Ajax запрос на поиск записей

	function russtrade_ajax(){
		global $query;
		$args = array(
			'post_type'        => 'news',  
			's'                => $_GET['value'], 
			'posts_per_page'   => 10 
		);
		$i = 0;
		$query = new WP_Query( $args ); 
		relevanssi_do_query($query);
		if($query->have_posts()){ 
		while ($query->have_posts()) { $query->the_post(); $i++;?> 
		<div class="search__item" data-index="<?php echo $i; ?>">
					<h2 class="headline"><?php the_title(); ?></h2>
					<div class="search__text">
						<?php  
							the_excerpt(); 
						?>
					</div>
					<a href="<?php the_permalink();?>"><?php the_permalink(); ?></a>
				</div>
		<?php } }else{ ?>
			<div class="search__content">По Вашему запросу ничего не найдено</div>
		<?php } exit;

	}
	// Регистрация виджетов
	function russtrade_widgets(){
		register_sidebar(array(
			'name' => 'Сайдбар для языков',
			'id'   => 'lang-sidebar',
			'description' => 'Ничего не вставлять'
		));

	}
 ?>