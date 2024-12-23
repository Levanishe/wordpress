<?php
/*
Template Name: search_germon
*/
?>
<?php get_header(); ?>

<?php
global $query_string; // Получение строки запроса
if (isset($query_string)) {
    wp_parse_str($query_string, $search_query); // Парсинг строки запроса в переменную search_query

    // Проверяем, есть ли в запросе значение для поиска по жанрам
    if (!empty($search_query['s'])) {
        $search_query['post_type'] = 'post'; 
        $search_query['tax_query'] = array(
            array(
                'taxonomy' => 'genre',
                'field'    => 'name',
                'terms'    => $search_query['s'],
            ),
        );
        $search = new WP_Query($search_query);
        $wp_query = $search;
    }
}
?>

<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php get_search_form(); ?>

            <?php if (have_posts()) : ?>
                <h2>Результаты поиска по жанрам:</h2>
                <ul>
                    <?php while (have_posts()) : the_post(); ?>
                        <li>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else : ?>
                <p>Записей не найдено.</p>
            <?php endif; ?>
        </main>
    </div>
</div>

<?php 
// Сброс глобальных переменных поста
if (isset($search)) {
    wp_reset_postdata();
}
get_footer(); 
?>
