<?php
/*
Template Name: search_page
*/
?>
<?php get_header(); ?>


<?php
global $query_string; // получение строк запроса вида СЕТ
if (isset($query_string)) {
  wp_parse_str($query_string, $search_query); // парсин строки запроса в переменную search_query
  $search_query['post_type'] = 'page'; // указания типа запроса
  $search = new WP_Query($search_query); // запуск запроса
  $wp_query = $search; // присвоения нового запроса стандартному
}
?>
<div class="wrap">
  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
      <?php get_search_form(); // получение шаблона формы поска
      ?>
    </main>
  </div>
</div>

<?php if (have_posts()) {
  while (have_posts()) {
    the_post(); ?>
    <?php the_title() ?>

  <?php }
} else { ?>
  <p>Записей нет.</p>
<?php } ?>

<?php get_footer() ?>