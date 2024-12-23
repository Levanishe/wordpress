<?php get_header(); ?>

<div class="taxonomy-genre">
    <h1><?php single_term_title(); ?></h1>
    <p><?php echo term_description(); ?></p>

    <?php
    if (have_posts()) {
        echo '<ul>';
        while (have_posts()) {
            the_post();
            echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo '<p>Постов не найдено.</p>';
    }
    ?>
</div>

<?php get_footer(); ?>
