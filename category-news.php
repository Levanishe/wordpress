<?php get_header(); ?>

<div class="category-container">
    <?php
    // Получаем текущую категорию
    $thisCat = get_category(get_query_var('cat'));
    ?>

    <h1><?php echo esc_html($thisCat->name); ?></h1>
    <p><?php echo esc_html($thisCat->description); ?></p>

    <div class="posts">
        <?php
        $args = array(
            'cat' => $thisCat->term_id,
            'posts_per_page' => -1,
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                ?>
                <div class="post-item">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php the_excerpt(); ?></p>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>Записей не найдено.</p>';
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>
