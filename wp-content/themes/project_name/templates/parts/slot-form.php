<?php
$title = get_field('title');
?>

<section class="slots">
    <?php if ($title): ?>
        <h2 class="slots-title"><?php echo $title ?></h2>
    <?php endif ?>

    <div class="swiper slotsSwiper">
        <div class="swiper-wrapper">
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
                    <div class="swiper-slide slots__list__item" id="slot-<?php the_ID(); ?>">
                        <a class="slots__list__item-thumb" href="<?php echo esc_url($link); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                        <button class="slots__list__item-delete" data-id="<?php the_ID(); ?>"></button>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

        <div class="slotsSwiper__buttons">
            <div class="swiper-button-next butt-slider"></div>
            <div class="swiper-button-prev butt-slider"></div>
        </div>
        <div class="swiper-scrollbar"></div>
    </div>

    <?php if ( is_user_logged_in() ) : ?>
        <form class="slots__form" id="slot-form" method="post" enctype="multipart/form-data">
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
