<section class="form">
    <ul class="slots-list">
        <?php
        $slots = new WP_Query([
            'post_type'      => 'post',
            'posts_per_page' => 20,
        ]);

        if ($slots->have_posts()):
            while ($slots->have_posts()): $slots->the_post();

                // Берем кастомную ссылку
                $link = get_post_meta(get_the_ID(), '_slot_link', true);

                if (!$link) {
                    $link = get_permalink(); // если ссылки нет — fallback
                }
                ?>

                <li class="slot-item" id="slot-<?php the_ID(); ?>">

                    <a class="slot-thumb" href="<?php echo esc_url($link); ?>">
                        <h3><?php the_title(); ?></h3>
                        <?php the_post_thumbnail('medium'); ?>
                        <div class="slot-content"><?php the_excerpt(); ?></div>
                    </a>


                    <button class="delete-slot" data-id="<?php the_ID(); ?>">Удалить</button>
                </li>
            <?php endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </ul>

    <?php if ( is_user_logged_in() ) : ?>
        <form id="slot-form" method="post" action="">
            <label for="slot-title">Название слота:</label>
            <input type="text" name="slot_title" id="slot-title" required>

            <label for="slot-content">Описание:</label>
            <textarea name="slot_content" id="slot-content"></textarea>

            <?php wp_nonce_field('add_slot_nonce', 'slot_nonce'); ?>
            <button type="submit" name="submit_slot">Добавить слот</button>
        </form>
    <?php else: ?>
        <p>Чтобы добавить слот — <a href="<?php echo wp_login_url(); ?>">войдите</a>.</p>
    <?php endif; ?>
</section>
