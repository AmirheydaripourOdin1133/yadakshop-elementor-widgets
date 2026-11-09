<?php
/**
 * Elementor integration bootstrap.
 *
 * Registers the یدک شاپ widgets category, widget classes and assets.
 *
 * @package Yadakshop
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Elements_Manager;
use Elementor\Widgets_Manager;

/**
 * Registers Elementor widgets, categories, and assets.
 */
final class Yadakshop_Elementor {

	/**
	 * Singleton instance.
	 *
	 * @var Yadakshop_Elementor|null
	 */
	private static $instance = null;

	/**
	 * Get singleton instance.
	 *
	 * @return Yadakshop_Elementor
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Whether widgets have been registered.
	 *
	 * @var bool
	 */
	private $widgets_registered = false;

	/**
	 * Constructor.
	 */
	private function __construct() {
		add_action( 'elementor/elements/categories_registered', array( $this, 'register_categories' ) );
		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ) );
		add_action( 'elementor/init', array( $this, 'register_assets' ) );

		// Localize strings.
		add_action( 'init', array( $this, 'load_textdomain' ) );
	}

	/**
	 * Load plugin translations.
	 *
	 * @return void
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'yadakshop', false, dirname( plugin_basename( YADAKSHOP_PLUGIN_FILE ) ) . '/languages' );
	}

	/**
	 * Register custom Elementor category.
	 *
	 * @param Elements_Manager $elements_manager Elementor elements manager.
	 */
	public function register_categories( $elements_manager ) {
		$elements_manager->add_category(
			'yadakshop',
			array(
				'title' => esc_html__( 'یدک شاپ', 'yadakshop' ),
				'icon'  => 'fa fa-plug',
			)
		);
	}

	/**
	 * Register widget classes.
	 *
	 * @param Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {
		if ( $this->widgets_registered ) {
			return;
		}

		$this->widgets_registered = true;

		$widgets = array(
			'class-yadakshop-services-carousel.php'     => 'Yadakshop_Services_Carousel',
			'class-yadakshop-special-content.php'       => 'Yadakshop_Special_Content',
			'class-yadakshop-contact-us.php'            => 'Yadakshop_Contact_Us',
			'class-yadakshop-immigration-methods.php'   => 'Yadakshop_Immigration_Methods',
			'class-yadakshop-services-grid.php'         => 'Yadakshop_Services_Grid',
			'class-yadakshop-logo-loop.php'             => 'Yadakshop_Logo_Loop',
		);

		foreach ( $widgets as $filename => $class_name ) {
			require_once YADAKSHOP_PLUGIN_DIR . 'widgets/' . $filename;

			$widget = new $class_name();

			if ( method_exists( $widgets_manager, 'register' ) ) {
				$widgets_manager->register( $widget );
			} else {
				$widgets_manager->register_widget_type( $widget );
			}
		}
	}

	/**
	 * Register widget styles and scripts (loaded only when widget is present).
	 */
	public function register_assets() {
		wp_register_style(
			'yadakshop-services-carousel',
			YADAKSHOP_PLUGIN_URL . 'assets/css/services-carousel.css',
			array(),
			YADAKSHOP_VERSION
		);

		wp_register_script(
			'yadakshop-services-carousel',
			YADAKSHOP_PLUGIN_URL . 'assets/js/services-carousel.js',
			array( 'jquery', 'elementor-frontend', 'swiper' ),
			YADAKSHOP_VERSION,
			true
		);

		wp_register_style(
			'yadakshop-special-content',
			YADAKSHOP_PLUGIN_URL . 'assets/css/special-content.css',
			array(),
			YADAKSHOP_VERSION
		);

		wp_register_style(
			'yadakshop-contact-us',
			YADAKSHOP_PLUGIN_URL . 'assets/css/contact-us.css',
			array(),
			YADAKSHOP_VERSION
		);

		wp_register_style(
			'yadakshop-immigration-methods',
			YADAKSHOP_PLUGIN_URL . 'assets/css/yadakshop-immigration-methods.css',
			array(),
			YADAKSHOP_VERSION
		);

		wp_register_style(
			'yadakshop-services-grid',
			YADAKSHOP_PLUGIN_URL . 'assets/css/yadakshop-services-grid.css',
			array(),
			YADAKSHOP_VERSION
		);

		wp_register_style(
			'yadakshop-logo-loop',
			YADAKSHOP_PLUGIN_URL . 'assets/css/logo-loop.css',
			array(),
			YADAKSHOP_VERSION
		);

		wp_register_script(
			'yadakshop-logo-loop',
			YADAKSHOP_PLUGIN_URL . 'assets/js/logo-loop.js',
			array( 'jquery', 'elementor-frontend' ),
			YADAKSHOP_VERSION,
			true
		);
	}
}
