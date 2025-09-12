<?php

namespace App\Base;

final class Enqueue {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ self::class, 'enqueueStyles' ] );
		add_action( 'wp_enqueue_scripts', [ self::class, 'enqueueScripts' ] );
	}

	public static function enqueueStyles() {
		wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/main.min.css', array(), filemtime(get_template_directory() . '/assets/css/main.min.css'));
	}

	public static function enqueueScripts() {
		wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/main.min.js', array(), filemtime(get_template_directory() . '/assets/js/main.min.js'), true );
	}
}