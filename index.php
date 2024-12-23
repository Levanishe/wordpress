<?php get_header(); ?>

<?php
wp_nav_menu( array(
    'theme_location' => 'header-menu',
    'menu_class'     => 'header-menu-class', // CSS класс для стилизации меню
) );
?>

<div class="middle">
  <?php get_template_part('parts/loop'); ?>
</div>


<?php wp_footer();  get_footer()?>