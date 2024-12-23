<?php get_header(); ?>

<?php
the_post(); // Получаем текущий пост
?>

<h1><?php the_title(); ?></h1>
<p></p>

<?php
the_content(); // Выводим содержание поста
?>

<?php
// Получаем жанр поста
$terms = get_the_terms($post->ID, 'genre');
if ($terms && !is_wp_error($terms)) {
    $term = $terms[0]; // Предполагаем, что мы берем первый жанр
    echo 'Жанр: ' . esc_html($term->name) . '<br>';
    echo 'ID: ' . esc_html($term->term_id) . '<br>';
    echo 'Количество постов: ' . esc_html($term->count) . '<br>';
    echo 'Таксономия: ' . esc_html($term->taxonomy) . '<br>';
}

// Запрос постов с тем же жанром
if ($term) {
    $args = [
        'post_type' => 'post',
        'tax_query' => [
            [
                'taxonomy' => 'genre',
                'field'    => 'term_id',
                'terms'    => $term->term_id,
            ],
        ],
        'post__not_in' => array($post->ID), // Исключаем текущий пост
    ];

    $wp_query = new WP_Query($args); // Создаем новый объект WP_Query

    // Вывод постов
    if ($wp_query->have_posts()) {
        echo '<h2>Посты с таким же жанром:</h2>';
        echo '<ul>';
        while ($wp_query->have_posts()) {
            $wp_query->the_post();
            echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo '<p>Постов не найдено.</p>';
    }

    // Сбрасываем данные запроса
    wp_reset_postdata();
}
?>

<?php
// Вывод первой категории и ссылки на неё
$category = get_the_category();
if (!empty($category)) {
    $cat_id = $category[0]->term_id;
    $cat_name = $category[0]->name;
    $link = get_category_link($cat_id);
    echo '<p>Первая категория: <a href="' . esc_url($link) . '">' . esc_html($cat_name) . '</a></p>';
}
?>

<div class="footer-ava">
    <?php get_post(); ?>
</div>

<?php get_footer(); ?>
