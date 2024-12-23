<?
// Функция для создания таксономии "жанр"
function create_genre_taxonomy() {
    // Массив меток для таксономии
    $labels = array(
        'name'              => _x('Жанры', 'taxonomy general name'),
        'singular_name'     => _x('Жанр', 'taxonomy singular name'),
        'search_items'      => __('Поиск жанров'),
        'all_items'         => __('Все жанры'),
        'parent_item'       => __('Родительский жанр'),
        'parent_item_colon' => __('Родительский жанр:'),
        'edit_item'         => __('Редактировать жанр'),
        'update_item'       => __('Обновить жанр'),
        'add_new_item'      => __('Добавить новый жанр'),
        'new_item_name'     => __('Новое имя жанра'),
        'menu_name'         => __('Жанры'),
    );

    // Массив аргументов для регистрации таксономии
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'genre'),
    );

    // Регистрация таксономии
    register_taxonomy('genre', array('post'), $args);
}

// Хук для инициализации таксономии при загрузке WordPress
add_action('init', 'create_genre_taxonomy');

function register_my_menus() {
    register_nav_menus(
        array(
            'header-menu' => __( 'Меню в заголовке' ),
            'footer-menu' => __( 'Меню в подвале' )
        )
    );
}
add_action( 'init', 'register_my_menus' );