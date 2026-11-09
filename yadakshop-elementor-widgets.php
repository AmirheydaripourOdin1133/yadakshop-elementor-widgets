<?php
/**
 * Plugin Name:       یدک شاپ المنتور ویجت
 * Plugin URI:        https://github.com/AmirheydaripourOdin1133/yadakshop-elementor-widgets
 * Description:       مجموعه ویجت‌های اختصاصی المنتور برند یدک شاپ؛ شامل کاروسل خدمات، گرید خدمات، تماس با ما، روش‌های مهاجرت، محتوای ویژه و لوگوی متحرک.
 * Version:           1.0.3
 * Requires at least: 5.9
 * Requires PHP:      7.4
 * Requires Plugins:  elementor
 * Author:            Amir Heydaripour
 * Author URI:        https://wp-amir.ir
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       yadakshop
 * Domain Path:       /languages
 * Elementor tested up to: 3.30.0
 * Elementor requires at least: 3.10.0
 */

defined( 'ABSPATH' ) || exit;

define( 'YADAKSHOP_VERSION', '1.0.1' );
define( 'YADAKSHOP_PLUGIN_FILE', __FILE__ );
define( 'YADAKSHOP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'YADAKSHOP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Load the Elementor integration once Elementor is available.
 *
 * Plugins load before themes, so `elementor/loaded` may already have fired
 * by the time this plugin boots. Register immediately when Elementor is
 * ready, otherwise hook it.
 *
 * @return void
 */
function yadakshop_elementor_widgets_load() {
	require_once YADAKSHOP_PLUGIN_DIR . 'includes/class-yadakshop-elementor.php';
	Yadakshop_Elementor::instance();
}

if ( did_action( 'elementor/loaded' ) ) {
	yadakshop_elementor_widgets_load();
} else {
	add_action( 'elementor/loaded', 'yadakshop_elementor_widgets_load' );
}

/**
 * Show an admin notice when Elementor is not active.
 *
 * @return void
 */
function yadakshop_elementor_widgets_missing_elementor() {
	// Elementor is active — nothing to report.
	if ( did_action( 'elementor/loaded' ) ) {
		return;
	}

	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}
	$message = esc_html__( 'افزونه «یدک شاپ المنتور ویجت» برای کار کردن به المنتور نیاز دارد. لطفاً ابتدا افزونه المنتور را نصب و فعال کنید.', 'yadakshop' );
	printf(
		'<div class="notice notice-error"><p>%s</p></div>',
		esc_html( $message )
	);
}
add_action( 'admin_notices', 'yadakshop_elementor_widgets_missing_elementor' );
