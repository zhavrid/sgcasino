<?php
define('TM_TEXTDOMAIN', 'project_name');

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * Initialize all the core classes of the theme
 */
if ( class_exists( 'App\\Init' ) ) {
	App\Init::register_services();
}

function slot_add_custom_meta_box() {
    add_meta_box(
        'slot_link_meta',
        'Link',
        'slot_link_meta_callback',
        'post',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'slot_add_custom_meta_box');

function slot_link_meta_callback($post) {
    wp_nonce_field('slot_save_link', 'slot_link_nonce');

    $value = get_post_meta($post->ID, '_slot_link', true);

    echo '<label for="slot_link">Add Link:</label>';
    echo '<input type="url" id="slot_link" name="slot_link" value="' . esc_attr($value) . '" style="width:100%;">';
}

function slot_save_link_meta($post_id) {
    if (!isset($_POST['slot_link_nonce']) || !wp_verify_nonce($_POST['slot_link_nonce'], 'slot_save_link')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['slot_link'])) {
        update_post_meta($post_id, '_slot_link', sanitize_text_field($_POST['slot_link']));
    }
}
add_action('save_post', 'slot_save_link_meta');

add_action('template_redirect', function() {
    if (
        isset($_POST['submit_slot']) &&
        isset($_POST['slot_nonce']) &&
        wp_verify_nonce($_POST['slot_nonce'], 'add_slot_nonce')
    ) {
        if ( !is_user_logged_in() || !current_user_can('edit_posts') ) {
            wp_die('You do not have permission to add slots.');
        }

        $link = esc_url_raw($_POST['slot_link']);

        // создаём пост без title/content
        $post_id = wp_insert_post([
            'post_title'   => 'Slot ' . current_time('Y-m-d H:i:s'),
            'post_type'    => 'post',
            'post_status'  => 'publish',
        ]);

        if ($post_id && !is_wp_error($post_id)) {
            if ($link) {
                update_post_meta($post_id, '_slot_link', $link);
            }

            if (!empty($_FILES['slot_image']['name'])) {
                require_once(ABSPATH . 'wp-admin/includes/file.php');
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                require_once(ABSPATH . 'wp-admin/includes/media.php');

                $attachment_id = media_handle_upload('slot_image', $post_id);
                if (!is_wp_error($attachment_id)) {
                    set_post_thumbnail($post_id, $attachment_id);
                }
            }
        }

        wp_safe_redirect(home_url());
        exit;
    }
});


add_action('wp_ajax_delete_slot', 'sgcasino_ajax_delete_slot');
function sgcasino_ajax_delete_slot() {
    check_ajax_referer('delete_slot_nonce', 'nonce');

    $slot_id = isset($_POST['slot_id']) ? intval($_POST['slot_id']) : 0;
    if (!$slot_id) {
        wp_send_json_error('Invalid slot ID');
    }

    if (!current_user_can('delete_post', $slot_id)) {
        wp_send_json_error('You do not have the rights to delete this slot.');
    }

    $deleted = wp_delete_post($slot_id, true);
    if ($deleted) {
        wp_send_json_success();
    } else {
        wp_send_json_error('Couldont delete slot');
    }
}

function sgcasino_enqueue_slots_scripts() {
    wp_enqueue_script(
        'sgcasino-slots',
        get_template_directory_uri() . '/assets/js/slots.js',
        array('jquery'),
        null,
        true
    );

    wp_localize_script('sgcasino-slots', 'sgcasino_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('delete_slot_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'sgcasino_enqueue_slots_scripts');