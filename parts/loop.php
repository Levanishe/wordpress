<?php
if (have_posts()) {
    while (have_posts()) {
        the_post();
        // Вывод заголовка поста с ссылкой
        echo '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';

        // Получаем категории поста
        $categories = get_the_category();
        if (!empty($categories)) {
            // Выводим первую категорию с ссылкой
            echo '<h3><a href="' . get_category_link($categories[0]->term_id) . '">' . esc_html($categories[0]->name) . '</a></h3>';
        }

        // Выводим краткое содержание поста
        echo get_the_excerpt();
    }
} else {
    // Если записей не найдено
    echo '<p>Записей нет...</p>';
}
?>
