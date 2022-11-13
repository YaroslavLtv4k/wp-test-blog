<?php

add_action( 'wp_enqueue_scripts', 'test_scripts' );
function test_scripts(){
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'newscript0', get_template_directory_uri() . '/js/agency.js');
	wp_enqueue_script( 'newscript1', get_template_directory_uri() . '/js/bootstrap.js');
	wp_enqueue_script( 'newscript2', get_template_directory_uri() . '/js/bootstrap.min.js');
	wp_enqueue_script( 'newscript3', get_template_directory_uri() . '/js/custom.js');
	wp_enqueue_script( 'newscript4', get_template_directory_uri() . '/js/jquery.countdown.min.js');
	wp_enqueue_script( 'newscript5', get_template_directory_uri() . '/js/jquery.easing.min.js');
	wp_enqueue_script( 'newscript6', get_template_directory_uri() . '/js/jquery.min.js');
	wp_enqueue_script( 'newscript7', get_template_directory_uri() . '/js/jquery.plugin.min.js');
	wp_enqueue_script( 'newscript8', get_template_directory_uri() . '/js/jquery_002.js');
	wp_enqueue_script( 'newscript9', get_template_directory_uri() . '/js/jquery_003.js');
	// css
	wp_enqueue_style( 'mainstyle', get_stylesheet_uri() );
	wp_enqueue_style( 'style1', get_template_directory_uri() . '/css/animate.min.css');
	wp_enqueue_style( 'style2', get_template_directory_uri() . '/css/bootstrap.css');
	wp_enqueue_style( 'style3', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style( 'style4', get_template_directory_uri() . '/css/font-awesome.min.css');
	wp_enqueue_style( 'style5', get_template_directory_uri() . '/css/style.css');
}

// Поддержка темой определенных функций

add_action('after_setup_theme', 'test_support');
function test_support(){
	
	load_theme_textdomain('test');

	//Добавить новый размер иконок для сайдбара
	add_image_size( 'thumbnails-of-recent-posts-sidebar', 87, 87, true );

	add_theme_support('title-tag');

	add_theme_support('custom-logo', array(
		'height' => 31, 
		'width' => 134, 
		'flex-height' => true
	));

	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(730,446);

	add_theme_support('html5', array(
		'search-form', 
		'comment-form', 
		'comment-list', 
		'gallery', 
		'caption'
	));

	add_theme_support('post-formats', array(
		'aside',
		'image',
		'video',
		'gallery',
	));

	register_nav_menu('primary', 'Primary menu');

}

add_filter('excerpt_more', function($more){
	return '...';
});


// breadcrumbs

function test_the_breadcrumb(){
	global $post;
	if(!is_home()){ 
	   echo '<li><a href="'.site_url().'"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li> <li> / </li> ';
		if(is_single()){ // posts
		the_category(', ');
		echo " <li> / </li> ";
		echo '<li>';
			the_title();
		echo '</li>';
		}
		elseif (is_page()) { // pages
			if ($post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) echo $crumb . '<li> / </li> ';
			}
			echo the_title();
		}
		elseif (is_category()) { // category
			global $wp_query;
			$obj_cat = $wp_query->get_queried_object();
			$current_cat = $obj_cat->term_id;
			$current_cat = get_category($current_cat);
			$parent_cat = get_category($current_cat->parent);
			if ($current_cat->parent != 0) 
				echo(get_category_parents($parent_cat, TRUE, ' <li> / </li> '));
			single_cat_title();
		}
		elseif (is_search()) { // search pages
			echo 'Search results "' . get_search_query() . '"';
		}
		elseif (is_tag()) { // tags
			echo single_tag_title('', false);
		}
		elseif (is_day()) { // archive (days)
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> <li> / </li> ';
			echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li> <li> / </li> ';
			echo get_the_time('d');
		}
		elseif (is_month()) { // archive (months)
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> <li> / </li>';
			echo get_the_time('F');
		}
		elseif (is_year()) { // archive (years)
			echo get_the_time('Y');
		}
		elseif (is_author()) { // authors
			global $author;
			$userdata = get_userdata($author);
			echo '<li>Posted ' . $userdata->display_name . '</li>';
		} elseif (is_404()) { // if page not found
			echo '<li>Error 404</li>';
		}
	 
		if (get_query_var('paged')) // number of page
			echo ' (' . get_query_var('paged').'- page)';
	 
	} else { // home
	   $pageNum=(get_query_var('paged')) ? get_query_var('paged') : 1;
	   if($pageNum>1)
	      echo '<li><a href="'.site_url().'"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li> <li> / </li> '.$pageNum.'- page</li>';
	   else
	      echo '<li><i class="fa fa-home" aria-hidden="true"></i>Home</li>';
	}
}

add_action( 'init', 'register_post_types' );
function register_post_types(){

	register_taxonomy('event_type', 'events', [
		'labels' => [
			'name'                     => 'События', // основное название во множественном числе
			'singular_name'            => 'Событие', // название единичного элемента таксономии
			'menu_name'                => 'Типы событий', // Название в меню. По умолчанию: name.
			'all_items'                => 'Все события',
			'edit_item'                => 'Изменить событие',
			'view_item'                => 'Просмотр события', // текст кнопки просмотра записи на сайте (если поддерживается типом)
			'update_item'              => 'Обновить событие',
			'add_new_item'             => 'Добавить новое событие',
			'new_item_name'            => 'Название нового события',
			'parent_item'              => 'Родительское событие', // только для таксономий с иерархией
			'parent_item_colon'        => 'Родительское событие:',
			'search_items'             => 'Искать события',
			'popular_items'            => 'Популярные события', // для таксономий без иерархий
			'separate_items_with_commas' => 'Разделяйте события запятыми',
			'add_or_remove_items'      => 'Добавить или удалить события',
			'choose_from_most_used'    => 'Выбрать из часто используемых событий',
			'not_found'                => 'Событий не найдено',
			'back_to_items'            => '← Назад к событиям',
		],
		'hierarchical' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => true,
	]);

	register_post_type( 'events', [
		'label'  => null,
		'labels' => [
			'name'               => 'События', // основное название для типа записи
			'singular_name'      => 'Событие', // название для одной записи этого типа
			'add_new'            => 'Добавить событие', // для добавления новой записи
			'add_new_item'       => 'Добавление события', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование события', // для редактирования типа записи
			'new_item'           => 'Новое событие', // текст новой записи
			'view_item'          => 'Смотреть событие', // для просмотра записи этого типа.
			'search_items'       => 'Искать события', // для поиска по этим типам записи
			'not_found'          => 'Не найдено событий', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'События', // название меню
		],
		'description'         => '',
		'public'              => true,
		// 'publicly_queryable'  => null, // зависит от public
		// 'exclude_from_search' => null, // зависит от public
		// 'show_ui'             => null, // зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'        => null, // показывать ли в меню адмнки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-calendar-alt',
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'thumbnail' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [], //можно выбрать 'category'
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	] );
}

// Вывести события на главный блог

function add_events_to_query( $query ) {
    if ( is_home() && $query->is_main_query() )
        $query->set( 'post_type', array( 'post', 'events' ) );
    return $query;
}
add_action( 'pre_get_posts', 'add_events_to_query' );


