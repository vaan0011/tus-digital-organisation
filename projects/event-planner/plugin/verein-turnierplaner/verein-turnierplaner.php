<?php
/**
 * Plugin Name: Verein Turnierplaner
 * Description: Turnier-, Event- und Helferplanung für Fußballvereine: Turniere, Spielpläne, Ergebnisse, QR-Code, Sportfest-Ablauf, Bewirtung und Schichtpläne.
 * Version: 3.8.44
 * Author: TuS 1901 Mingolsheim e.V.
 * Author URI: https://tus-mingolsheim.de
 * Text Domain: verein-turnierplaner
 */
if (!defined('ABSPATH')) exit;
define('VTP_VERSION', '3.8.44');
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
require_once VTP_DIR.'includes/class-vtp-event-linked-tournaments.php';
require_once VTP_DIR.'includes/class-vtp-event-day-planner.php';
require_once VTP_DIR.'includes/class-vtp-event-day-direct-edit.php';
require_once VTP_DIR.'includes/class-vtp-event-program-section.php';
require_once VTP_DIR.'includes/class-vtp-event-tasks.php';
require_once VTP_DIR.'includes/class-vtp-event-shifts.php';
require_once VTP_DIR.'includes/class-vtp-event-shift-program-days.php';
require_once VTP_DIR.'includes/class-vtp-event-shift-operations.php';
require_once VTP_DIR.'includes/class-vtp-event-catering.php';
require_once VTP_DIR.'includes/class-vtp-event-finalize.php';
require_once VTP_DIR.'includes/class-vtp-event-template-workflow.php';
require_once VTP_DIR.'includes/class-vtp-event-public-worklists.php';
require_once VTP_DIR.'includes/class-vtp-event-worklist-access.php';
require_once VTP_DIR.'includes/class-vtp-event-worklist-admin-actions.php';
require_once VTP_DIR.'includes/class-vtp-event-shift-attendance.php';
require_once VTP_DIR.'includes/event-public-worklist-admin.php';
require_once VTP_DIR.'includes/class-vtp-events-overview.php';
require_once VTP_DIR.'includes/class-vtp-url-input.php';
require_once VTP_DIR.'includes/event-date-picker.php';
register_activation_hook(__FILE__, ['VTP_DB','activate']);
add_action('plugins_loaded', function(){
 VTP_DB::maybe_upgrade();
 VTP_Plugin::instance();
 VTP_Public::instance();
 VTP_Dashboard::init();
 // Die Eventhistorie wird explizit in VTP_Dashboard::render() ausgegeben.
 // Kein separater Dashboard-Hook, sonst wird der Block doppelt gerendert.
 VTP_Event_Create_UI::init();
 VTP_Event_Edit_UI::init();
 VTP_Event_Linked_Tournaments::init();
 VTP_Event_Day_Planner::init();
 VTP_Event_Day_Direct_Edit::init();
 VTP_Event_Program_Section::init();
 VTP_Event_Tasks::init();
 VTP_Event_Shifts::init();
 VTP_Event_Shift_Program_Days::init();
 VTP_Event_Shift_Operations::init();
 VTP_Event_Catering::init();
 VTP_Event_Finalize::init();
 VTP_Event_Template_Workflow::init();
 VTP_Event_Public_Worklists::init();
 VTP_Event_Worklist_Access::init();
 VTP_Event_Worklist_Admin_Actions::init();
 VTP_Event_Shift_Attendance::init();
 VTP_Events_Overview::init();
 VTP_URL_Input::init();
});
