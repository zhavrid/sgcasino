<section class="slots">
    <ul class="slots__list">
        <?php
        $slots = new WP_Query([
            'post_type'      => 'post',
            'posts_per_page' => 20,
        ]);

        if ($slots->have_posts()):
            while ($slots->have_posts()): $slots->the_post();

                $link = get_post_meta(get_the_ID(), '_slot_link', true);

                if (!$link) {
                    $link = get_permalink();
                }
                ?>

                <li class="slots__list__item" id="slot-<?php the_ID(); ?>">

                    <a class="slots__list__item-thumb" href="<?php echo esc_url($link); ?>">
<!--                        <h3>--><?php //the_title(); ?><!--</h3>-->
<!--                        <div class="slots__list__item-content">--><?php //the_excerpt(); ?><!--</div>-->
                        <?php the_post_thumbnail('medium'); ?>
                    </a>
                    <button class="slots__list__item-delete" data-id="<?php the_ID(); ?>"></button>
                </li>
            <?php endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </ul>

    <?php if ( is_user_logged_in() ) : ?>
        <form class="slots__form" id="slot-form" method="post" action="" enctype="multipart/form-data">
<!--            <label for="slot-title">Name:</label>-->
<!--            <input type="text" name="slot_title" id="slot-title" required>-->
<!---->
<!--            <label for="slot-content">Description:</label>-->
<!--            <textarea name="slot_content" id="slot-content"></textarea>-->

            <label for="slot-link">Link:</label>
            <input type="url" name="slot_link" id="slot-link" placeholder="https://example.com">

            <label for="slot-image">Image:</label>
            <input type="file" name="slot_image" id="slot-image" accept="image/*">

            <?php wp_nonce_field('add_slot_nonce', 'slot_nonce'); ?>
            <button type="submit" name="submit_slot">Add slot</button>
        </form>
    <?php else: ?>
        <p>To add a slot - <a href="<?php echo wp_login_url(); ?>">log in</a>.</p>
    <?php endif; ?>

</section>
