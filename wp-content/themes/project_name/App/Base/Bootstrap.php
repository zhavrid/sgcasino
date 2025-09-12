<?php

namespace App\Base;

final class Bootstrap {

	public const MENUS = [
		'header' => 'header-menu',
		'footer' => 'footer-menu',
		'privacy' => 'privacy-menu',
	];

	public function __construct() {
		add_theme_support( 'menus' );
        add_theme_support( 'post-thumbnails' );
		add_action( 'init', [self::class, 'registerMenus'] );
		add_filter('upload_mimes', [self::class, 'allowUploadSvg']);
	}

	public static function registerMenus() {
		register_nav_menus(
			array(
				self::MENUS['header'] => __( 'Header Menu', TM_TEXTDOMAIN ),
				self::MENUS['footer'] => __( 'Footer Menu', TM_TEXTDOMAIN ),
				self::MENUS['privacy'] => __( 'Privacy Menu', TM_TEXTDOMAIN ),
			)
		);
	}

	public static function bootstrap_main_menu() {
		wp_nav_menu( array(
			'theme_location' => self::MENUS['header']
		) );
	}

	public static function bootstrap_footer_menu() {
		wp_nav_menu( array(
			'theme_location' => self::MENUS['footer']
		) );
	}

	public static function bootstrap_privacy_menu() {
		wp_nav_menu( array(
			'theme_location' => self::MENUS['privacy']
		) );
	}
    public static function allowUploadSvg($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
}