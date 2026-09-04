<?php
if (!defined('ABSPATH')) exit;

add_action('admin_enqueue_scripts', function($hook){
    if (strpos((string)$hook, 'vtp') === false && strpos((string)$hook, 'turnierplaner') === false) return;

    $page = sanitize_key($_GET['page'] ?? '');
    if ($page !== 'vtp-events') return;

    wp_enqueue_script(
        'vtp-event-dates',
        VTP_URL . 'assets/event-dates.js',
        [],
        VTP_VERSION,
        true
    );
});
