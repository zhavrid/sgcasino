<?php

namespace App\Base;

final class TemplatesFolder {
	public static array $types = [
		'404',
		'archive',
		'author',
		'category',
		'tag',
		'taxonomy',
		'date',
		'embed',
		'home',
		'frontpage',
		'privacypolicy',
		'paged',
		'search',
		'page',
		'single',
		'singular',
	];

	public function __construct() {
		foreach( self::$types as $type ){
			add_filter( "{$type}_template_hierarchy", [$this, 'changeTemplatesFolder'], 20 );
		}
	}

	public function changeTemplateFolder($templates): array {
		$subfolder = 'templates';

		$type = str_replace( '_template_hierarchy', '', current_filter() );

		// add `taxonomy.php` file after last `category.php` and `tag.php` element.
		if( in_array( $type, [ 'category', 'tag' ] ) ){
			$templates[] = 'taxonomy.php';
		}

		// add global prefix `self::$basedir/` ex: `tpl/`.
		foreach( $templates as $index => $relpath ){

			if( ! str_starts_with( $relpath, "$subfolder/" ) ){
				$templates[ $index ] = "$subfolder/$relpath";
			}
		}

		return $templates;
	}
}