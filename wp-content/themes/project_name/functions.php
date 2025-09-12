<?php
define('TM_TEXTDOMAIN', 'project_name');

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * Initialize all the core classes of the theme
 */
if ( class_exists( 'App\\Init' ) ) {
	App\Init::register_services();
}

//добавление ссылки в постах

// Добавляем метабокс в правую колонку
function slot_add_custom_meta_box() {
    add_meta_box(
        'slot_link_meta',           // ID метабокса
        'Link',         // Заголовок
        'slot_link_meta_callback',  // Функция вывода
        'post',                     // Тип записи (можно заменить на 'slot', если будет отдельный CPT)
        'side',                     // Где показывать (side = правая колонка)
        'default'                   // Приоритет
    );
}
add_action('add_meta_boxes', 'slot_add_custom_meta_box');

// Вывод HTML для поля
function slot_link_meta_callback($post) {
    wp_nonce_field('slot_save_link', 'slot_link_nonce');

    $value = get_post_meta($post->ID, '_slot_link', true);

    echo '<label for="slot_link">Add Link:</label>';
    echo '<input type="url" id="slot_link" name="slot_link" value="' . esc_attr($value) . '" style="width:100%;">';
}


function slot_save_link_meta($post_id) {
    // Проверки безопасности
    if (!isset($_POST['slot_link_nonce']) || !wp_verify_nonce($_POST['slot_link_nonce'], 'slot_save_link')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['slot_link'])) {
        update_post_meta($post_id, '_slot_link', sanitize_text_field($_POST['slot_link']));
    }
}
add_action('save_post', 'slot_save_link_meta');






// Обработка формы добавления слотов
function sgcasino_handle_add_slot() {
    if ( isset($_POST['submit_slot']) ) {
        // Проверка nonce
        if ( !isset($_POST['slot_nonce']) || !wp_verify_nonce($_POST['slot_nonce'], 'add_slot_nonce') ) {
            return;
        }

        // Проверка прав
        if ( !is_user_logged_in() || !current_user_can('publish_posts') ) {
            return;
        }

        $title   = sanitize_text_field($_POST['slot_title']);
        $content = sanitize_textarea_field($_POST['slot_content']);

        // Создаём пост
        $post_id = wp_insert_post(array(
            'post_title'   => $title,
            'post_content' => $content,
            'post_status'  => 'publish',
            'post_type'    => 'post', // можно заменить на кастомный CPT slots
        ));

        if ($post_id && !is_wp_error($post_id)) {
            wp_safe_redirect(home_url()); // редиректим на главную
            exit;
        }
    }
}
add_action('template_redirect', 'sgcasino_handle_add_slot');




add_action('wp_ajax_delete_slot', 'sgcasino_ajax_delete_slot');
function sgcasino_ajax_delete_slot() {
    // проверяем nonce
    check_ajax_referer('delete_slot_nonce', 'nonce');

    $slot_id = isset($_POST['slot_id']) ? intval($_POST['slot_id']) : 0;
    if (!$slot_id) {
        wp_send_json_error('Неверный ID слота');
    }

    // проверяем права - current_user_can('delete_post', $slot_id)
    if (!current_user_can('delete_post', $slot_id)) {
        wp_send_json_error('У вас нет прав для удаления этого слота');
    }

    $deleted = wp_delete_post($slot_id, true); // true = безвозвратно
    if ($deleted) {
        wp_send_json_success();
    } else {
        wp_send_json_error('Не удалось удалить слот');
    }
}



function sgcasino_enqueue_slots_scripts() {
    // подключаем скрипт (положи файл assets/js/slots.js)
    wp_enqueue_script(
        'sgcasino-slots',
        get_template_directory_uri() . '/assets/js/slots.js',
        array('jquery'),
        null,
        true
    );

    // локализуем параметры для JS
    wp_localize_script('sgcasino-slots', 'sgcasino_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('delete_slot_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'sgcasino_enqueue_slots_scripts');
