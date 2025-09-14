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
            <button class="header__nav-sidebar desk" id="sidebarToggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 16 16" fill="none">\n' + '\n' + '<g fill="#deefff">\n' + '\n' + '<path d="M11.726 5.263a.7.7 0 10-.952-1.026l-3.5 3.25a.7.7 0 000 1.026l3.5 3.25a.7.7 0 00.952-1.026L8.78 8l2.947-2.737z"/>\n' + '\n' + '<path fill-rule="evenodd" d="M1 3.25A2.25 2.25 0 013.25 1h9.5A2.25 2.25 0 0115 3.25v9.5A2.25 2.25 0 0112.75 15h-9.5A2.25 2.25 0 011 12.75v-9.5zm2.25-.75a.75.75 0 00-.75.75v9.5c0 .414.336.75.75.75h1.3v-11h-1.3zm9.5 11h-6.8v-11h6.8a.75.75 0 01.75.75v9.5a.75.75 0 01-.75.75z" clip-rule="evenodd"/>\n' + '\n' + '</g>\n' + '\n' + '</svg>
            </button>
            <button class="header__nav-sidebar mobile" id="sidebarToggleMobile">
                <svg xmlns="http://www.w3.org/2000/svg" width="28px" height="28px" viewBox="0 0 24 24" fill="none">
                    <path d="M4 18L20 18" stroke="#deefff" stroke-width="2" stroke-linecap="round"/>
                    <path d="M4 12L20 12" stroke="#deefff" stroke-width="2" stroke-linecap="round"/>
                    <path d="M4 6L20 6" stroke="#deefff" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
            <?php echo wp_get_attachment_image($header['header_logo'],'full'); ?>
        </div>
        <div class="header__nav__menu">
            <button type="button" class="search">
                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15 10.5C15 12.9853 12.9853 15 10.5 15C8.01472 15 6 12.9853 6 10.5C6 8.01472 8.01472 6 10.5 6C12.9853 6 15 8.01472 15 10.5ZM14.1793 15.2399C13.1632 16.0297 11.8865 16.5 10.5 16.5C7.18629 16.5 4.5 13.8137 4.5 10.5C4.5 7.18629 7.18629 4.5 10.5 4.5C13.8137 4.5 16.5 7.18629 16.5 10.5C16.5 11.8865 16.0297 13.1632 15.2399 14.1792L20.0304 18.9697L18.9697 20.0303L14.1793 15.2399Z" fill="#7abfff"/>
                </svg>
                <span class="search__text">Games, Categories, Providers</span>
            </button>
            <?php
            if ($login) : ?>
                <a class="header__nav__menu-login butt" href="<?php echo esc_url($login['url']); ?>"
                   target="<?php echo esc_attr($login['target'] ? $login['target'] : '_self'); ?>"
                   title="<?php echo esc_html($login['title']); ?>">
                    <span><?php echo esc_html($login['title']); ?></span>
                </a>
            <?php endif;
            if ($register) : ?>
                <a class="header__nav__menu-login butt" href="<?php echo esc_url($register['url']); ?>"
                   target="<?php echo esc_attr($register['target'] ? $register['target'] : '_self'); ?>"
                   title="<?php echo esc_html($register['title']); ?>">
                    <span><?php echo esc_html($register['title']); ?></span>
                </a>
            <?php endif;?>
        </div>
    </nav>
</header>

<div id="overlay"></div>

<div class="sidebar" id="sidebar">
    <div class="sidebar__top">
        <button type="button" class="search mobile">
            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M15 10.5C15 12.9853 12.9853 15 10.5 15C8.01472 15 6 12.9853 6 10.5C6 8.01472 8.01472 6 10.5 6C12.9853 6 15 8.01472 15 10.5ZM14.1793 15.2399C13.1632 16.0297 11.8865 16.5 10.5 16.5C7.18629 16.5 4.5 13.8137 4.5 10.5C4.5 7.18629 7.18629 4.5 10.5 4.5C13.8137 4.5 16.5 7.18629 16.5 10.5C16.5 11.8865 16.0297 13.1632 15.2399 14.1792L20.0304 18.9697L18.9697 20.0303L14.1793 15.2399Z" fill="#7abfff"/>
            </svg>
            <span class="search__text">Games, Categories, Providers</span>
        </button>

    <?php if ($sidebar) : ?>
            <?php foreach ($sidebar as $row) :
                $group = $row['group'];?>
                <ul class="sidebar__menu">
                <?php  if (!empty($group['link_block'])) :
                    foreach ($group['link_block'] as $link) :
                        $icon = $link['icon'];
                        $text_link = $link['text_link'];
                        ?>
                        <li class="sidebar__menu__block">
                            <?php if ($text_link) : ?>
                                <a class="sidebar__menu__block-link" href="<?php echo esc_url($text_link['url']); ?>"
                                   target="<?php echo esc_attr($text_link['target'] ? $text_link['target'] : '_self'); ?>"
                                   title="<?php echo esc_html($text_link['title']); ?>">
                                    <div class="content">
                                        <?php if ($icon) { echo $icon; } ?>
                                        <span><?php echo esc_html($text_link['title']); ?></span>
                                    </div>
                                </a>
                            <?php endif;?>
                        </li>
                    <?php endforeach;
                endif;?>
                </ul>
            <?php endforeach; ?>
    <?php endif; ?>
    </div>
    <div class="sidebar__bottom">
        <div class="sidebar__bottom-button butt">
            <?php echo do_shortcode('[language-switcher]'); ?>
        </div>
        <?php if ($help_centre) : ?>
            <a class="sidebar__bottom-button butt help-butt" href="<?php echo esc_url($help_centre['url']); ?>"
               target="<?php echo esc_attr($help_centre['target'] ? $help_centre['target'] : '_self'); ?>"
               title="<?php echo esc_html($help_centre['title']); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.5" d="M12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22Z" fill="#deefff"/>
                    <path d="M12 7.75C11.3787 7.75 10.875 8.25368 10.875 8.875C10.875 9.28921 10.5392 9.625 10.125 9.625C9.71079 9.625 9.375 9.28921 9.375 8.875C9.375 7.42525 10.5503 6.25 12 6.25C13.4497 6.25 14.625 7.42525 14.625 8.875C14.625 9.58584 14.3415 10.232 13.883 10.704C13.7907 10.7989 13.7027 10.8869 13.6187 10.9708C13.4029 11.1864 13.2138 11.3753 13.0479 11.5885C12.8289 11.8699 12.75 12.0768 12.75 12.25V13C12.75 13.4142 12.4142 13.75 12 13.75C11.5858 13.75 11.25 13.4142 11.25 13V12.25C11.25 11.5948 11.555 11.0644 11.8642 10.6672C12.0929 10.3733 12.3804 10.0863 12.6138 9.85346C12.6842 9.78321 12.7496 9.71789 12.807 9.65877C13.0046 9.45543 13.125 9.18004 13.125 8.875C13.125 8.25368 12.6213 7.75 12 7.75Z" fill="#2b62a7"/>
                    <path d="M12 17C12.5523 17 13 16.5523 13 16C13 15.4477 12.5523 15 12 15C11.4477 15 11 15.4477 11 16C11 16.5523 11.4477 17 12 17Z" fill="#2b62a7"/>
                </svg>
                <span><?php echo esc_html($help_centre['title']); ?></span>
            </a>
        <?php endif;?>
    </div>
</div>