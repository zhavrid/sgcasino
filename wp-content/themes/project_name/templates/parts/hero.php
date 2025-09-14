<?php
$hero_slide = get_field('hero_slide');
?>

<section class="hero">
    <div class="swiper heroSwiper">
        <div class="swiper-wrapper">
            <?php foreach ($hero_slide as $row) {
                $img = $row['img'];
                $subtitle = $row['subtitle'];
                $title = $row['title'];
                $button_text = $row['button_text'];
                $img_url = $img ? wp_get_attachment_image_url($img, 'full') : '';
                ?>
                <div class="swiper-slide">
                    <button class="hero__block" id="hero-popup"
                        <?php if ($img_url): ?>
                            style="background-image: url('<?php echo esc_url($img_url); ?>');"
                        <?php endif; ?>>
                        <div class="hero__block__text">
                            <div class="hero__block__top">
                                <?php if ($subtitle): ?>
                                    <p class="hero__block__top-subtitle"><?php echo $subtitle ?></p>
                                <?php endif ?>
                                <?php if ($title): ?>
                                    <h1 class="hero__block__top-title"><?php echo $title ?></h1>
                                <?php endif ?>
                            </div>
                            <?php if ($button_text): ?>
                                <div class="hero__block__bottom butt">
                                    <?php echo $button_text ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </button>
                </div>
                <?php
            } ?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="heroSwiper__buttons">
            <div class="swiper-button-next butt-slider"></div>
            <div class="swiper-button-prev butt-slider"></div>
        </div>
    </div>
</section>