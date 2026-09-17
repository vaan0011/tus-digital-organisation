<?php
/**
 * Plugin Name: Verein Turnierplaner
 * Description: Turnier-, Event- und Helferplanung für Fußballvereine: Turniere, Spielpläne, Ergebnisse, QR-Code, Sportfest-Ablauf, Bewirtung und Schichtpläne.
 * Version: 3.8.7
 * Author: TuS 1901 Mingolsheim e.V.
 * Author URI: https://tus-mingolsheim.de
 * Text Domain: verein-turnierplaner
 */
if (!defined('ABSPATH')) exit;
define('VTP_VERSION', '3.8.7');
define('VTP_FILE', __FILE__);
define('VTP_DIR', plugin_dir_path(__FILE__));
define('VTP_URL', plugin_dir_url(__FILE__));
require_once VTP_DIR.'includes/class-vtp-db.php';
require_once VTP_DIR.'includes/class-vtp-plugin.php';
require_once VTP_DIR.'includes/class-vtp-public.php';
require_once VTP_DIR.'includes/class-vtp-dashboard.php';
require_once VTP_DIR.'includes/class-vtp-dashboard-history.php';
require_once VTP_DIR.'includes/class-vtp-event-create-ui.php';
require_once VTP_DIR.'includes/class-vtp-event-edit-ui.php';
require_once VTP_DIR.'includes/class-vtp-events-overview.php';
require_once VTP_DIR.'includes/class-vtp-url-input.php';
require_once VTP_DIR.'includes/event-date-picker.php';
register_activation_hook(__FILE__, ['VTP_DB','activate']);
add_action('plugins_loaded', function(){
 VTP_DB::maybe_upgrade();
 VTP_Plugin::instance();
 VTP_Public::instance();
 VTP_Dashboard::init();
 VTP_Dashboard_History::init();
 VTP_Event_Create_UI::init();
 VTP_Event_Edit_UI::init();
 VTP_Events_Overview::init();
 VTP_URL_Input::init();
});
