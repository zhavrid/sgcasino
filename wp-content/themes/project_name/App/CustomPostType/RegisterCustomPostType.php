<?php

namespace App\CustomPostType;

use App\Helpers\Init;

final class RegisterCustomPostType implements Init
{
    public static function init(): void
    {
        add_action( 'init', [self::class, 'registerProductType']);
    }

    private static function registerQuoteCPT(): void
    {
        register_post_type('custom_post_type', array(
            'labels' => array(
                'name' => 'Custom Post',
                'singular_name' => 'Post',
                'add_new' => 'Add new',
                'add_new_item' => 'Add new post',
                'edit_item' => 'Edit post',
                'new_item' => 'New post',
                'view_item' => 'View post',
                'search_items' => 'Search post',
                'not_found' => 'Post not found',
                'not_found_in_trash' => 'Not found post in trash',
                'parent_item_colon' => '',
                'menu_name' => 'Custom Post'

            ),
            'public' => false,
            'publicly_queryable' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'show_in_rest' => true,
            'menu_icon'     => 'dashicons-money-alt',
            'supports' => array('title', 'editor', 'author')
        ));
    }
}