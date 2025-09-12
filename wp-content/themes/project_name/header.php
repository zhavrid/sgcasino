<?php
use App\Base\Bootstrap;

$header = get_field('header', 'options');
$general = get_field('general', 'options');
$login = $header['login'];
$register = $header['register'];

$sidebar = get_field('sidebar', 'options');
$help_centre = $header['help_centre'];
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <title><?php wp_title();?></title>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header>
    <nav class="header__nav">
        <div class="header__nav__logo">
            <button class="sidebar__toggle" id="sidebarToggle">⮜</button>
            <?php echo wp_get_attachment_image($header['header_logo'],'full'); ?>
        </div>
        <div class="header__nav__menu">
            <input type="text" placeholder="<?php the_field('slot_search_placeholder', 'option'); ?>" name="slot_search" id="slot-search">
            <?php
            if ($login) : ?>
                <a class="buttons" href="<?php echo esc_url($login['url']); ?>"
                   target="<?php echo esc_attr($login['target'] ? $login['target'] : '_self'); ?>"
                   title="<?php echo esc_html($login['title']); ?>">
                    <span><?php echo esc_html($login['title']); ?></span>
                </a>
            <?php endif;
            if ($register) : ?>
                <a class="buttons" href="<?php echo esc_url($register['url']); ?>"
                   target="<?php echo esc_attr($register['target'] ? $register['target'] : '_self'); ?>"
                   title="<?php echo esc_html($register['title']); ?>">
                    <span><?php echo esc_html($register['title']); ?></span>
                </a>
            <?php endif;?>
        </div>
    </nav>
</header>

<div class="sidebar" id="sidebar">
    <?php if ($sidebar) : ?>
            <?php foreach ($sidebar as $row) :
                $group = $row['group'];?>
                <ul class="sidebar__menu">
                <?php  if (!empty($group['link_block'])) :
                    foreach ($group['link_block'] as $link) :
                        $icon = $link['icon'];
                        $text_link = $link['text_link'];
                        ?>
                        <li>
                            <?php if ($text_link) : ?>
                                <a class="buttons" href="<?php echo esc_url($text_link['url']); ?>"
                                   target="<?php echo esc_attr($text_link['target'] ? $text_link['target'] : '_self'); ?>"
                                   title="<?php echo esc_html($text_link['title']); ?>">
                                    <?php echo wp_get_attachment_image($icon,'full'); ?>
                                    <span><?php echo esc_html($text_link['title']); ?></span>
                                </a>
                            <?php endif;?>
                        </li>
                    <?php endforeach;
                endif;?>
                </ul>
            <?php endforeach; ?>
    <?php endif; ?>

    <div class="header__lang-switcher">
        <?php echo do_shortcode('[language-switcher]'); ?>
    </div>

    <?php if ($help_centre) : ?>
    <a class="buttons" href="<?php echo esc_url($help_centre['url']); ?>"
       target="<?php echo esc_attr($help_centre['target'] ? $help_centre['target'] : '_self'); ?>"
       title="<?php echo esc_html($help_centre['title']); ?>">
        <span><?php echo esc_html($help_centre['title']); ?></span>
    </a>
    <?php endif;?>
</div>
