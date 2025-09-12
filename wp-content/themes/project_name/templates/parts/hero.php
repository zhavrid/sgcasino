<?php
$hero_slide = get_field('hero_slide');
?>

<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <?php foreach ($hero_slide as $row) {
            $img = $row['img'];
            $title = $row['title'];
            $description = $row['description'];
            $button_text = $row['button_text'];
            $img_url = $img ? wp_get_attachment_image_url($img, 'full') : '';
            ?>

            <button class="swiper-slide" id="hero-popup"
                <?php if ($img_url): ?>
                    style="background-image: url('<?php echo esc_url($img_url); ?>');"
                <?php endif; ?>>
                <?php if($title):  ?>
                    <h1 class="platform-content_title"><?php echo $title?></h1>
                <?php endif ?>
                <?php if($description):  ?>
                    <p class="platform-content_description"><?php echo $description?></p>
                <?php endif ?>
                <?php if($button_text):  ?>
                    <div class="button">
                        <p class="platform-content_description"><?php echo $button_text?></p>
                    </div>
                <?php endif ?>
            </button>
            <?php
        }
        ?>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>