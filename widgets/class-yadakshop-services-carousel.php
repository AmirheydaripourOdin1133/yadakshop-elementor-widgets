<?php
/**
 * Services Carousel Elementor widget.
 *
 * @package Yadakshop
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

/**
 * Services Carousel widget class.
 */
class Yadakshop_Services_Carousel extends Widget_Base {

	/**
	 * Widget slug.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'yadakshop-services-carousel';
	}

	/**
	 * Widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'کاروسل خدمات', 'yadakshop' );
	}

	/**
	 * Widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-slides';
	}

	/**
	 * Widget categories.
	 *
	 * @return array
	 */
	public function get_categories() {
		return array( 'yadakshop' );
	}

	/**
	 * Widget keywords.
	 *
	 * @return array
	 */
	public function get_keywords() {
		return array( 'services', 'carousel', 'slider', 'swiper', 'yadakshop' );
	}

	/**
	 * Script dependencies.
	 *
	 * @return array
	 */
	public function get_script_depends() {
		return array( 'swiper', 'yadakshop-services-carousel' );
	}

	/**
	 * Style dependencies.
	 *
	 * @return array
	 */
	public function get_style_depends() {
		return array( 'e-swiper', 'yadakshop-services-carousel' );
	}

	/**
	 * Register widget controls.
	 */
	protected function register_controls() {
		$this->register_content_controls();
		$this->register_carousel_controls();
		$this->register_style_controls();
	}

	/**
	 * Content tab controls.
	 */
	private function register_content_controls() {
		$this->start_controls_section(
			'section_header',
			array(
				'label' => esc_html__( 'سربرگ بخش', 'yadakshop' ),
			)
		);

		$this->add_control(
			'show_header',
			array(
				'label'        => esc_html__( 'نمایش سربرگ', 'yadakshop' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'بله', 'yadakshop' ),
				'label_off'    => esc_html__( 'خیر', 'yadakshop' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'       => esc_html__( 'زیرعنوان', 'yadakshop' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '— آخرین خدمات —', 'yadakshop' ),
				'label_block' => true,
				'condition'   => array(
					'show_header' => 'yes',
				),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => esc_html__( 'عنوان', 'yadakshop' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'خدمات مطمئن برای', 'yadakshop' ),
				'label_block' => true,
				'condition'   => array(
					'show_header' => 'yes',
				),
			)
		);

		$this->add_control(
			'title_highlight',
			array(
				'label'       => esc_html__( 'عنوان برجسته', 'yadakshop' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'هر خودرویی', 'yadakshop' ),
				'label_block' => true,
				'condition'   => array(
					'show_header' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_items',
			array(
				'label' => esc_html__( 'آیتم‌های خدمات', 'yadakshop' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			array(
				'label' => esc_html__( 'تصویر', 'yadakshop' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);

		$repeater->add_control(
			'number',
			array(
				'label'       => esc_html__( 'شماره سرویس', 'yadakshop' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '01',
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'       => esc_html__( 'عنوان', 'yadakshop' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'عنوان سرویس', 'yadakshop' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'description',
			array(
				'label'   => esc_html__( 'توضیحات', 'yadakshop' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'توضیحات سرویس خود را اینجا وارد کنید.', 'yadakshop' ),
				'rows'    => 4,
			)
		);

		$repeater->add_control(
			'icon',
			array(
				'label'   => esc_html__( 'آیکون', 'yadakshop' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-wrench',
					'library' => 'fa-solid',
				),
			)
		);

		$repeater->add_control(
			'button_text',
			array(
				'label'       => esc_html__( 'متن دکمه', 'yadakshop' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'ادامه مطلب', 'yadakshop' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'button_link',
			array(
				'label'       => esc_html__( 'لینک دکمه', 'yadakshop' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://example.com', 'yadakshop' ),
				'default'     => array(
					'url' => '#',
				),
			)
		);

		$repeater->add_control(
			'enable_overlay',
			array(
				'label'        => esc_html__( 'فعال‌سازی اورلی تصویر', 'yadakshop' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'بله', 'yadakshop' ),
				'label_off'    => esc_html__( 'خیر', 'yadakshop' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'items',
			array(
				'label'       => esc_html__( 'آیتم‌ها', 'yadakshop' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'number'      => '01',
						'title'       => esc_html__( 'تعویض روغن', 'yadakshop' ),
						'description' => esc_html__( 'موتور خودروی خود را با سرویس حرفه‌ای تعویض روغن ما روان نگه دارید.', 'yadakshop' ),
					),
					array(
						'number'      => '02',
						'title'       => esc_html__( 'تعمیر ترمز', 'yadakshop' ),
						'description' => esc_html__( 'بازرسی و تعمیر تخصصی ترمز برای ایمنی بیشتر در جاده.', 'yadakshop' ),
					),
					array(
						'number'      => '03',
						'title'       => esc_html__( 'سرویس باتری', 'yadakshop' ),
						'description' => esc_html__( 'تست و تعویض سریع باتری برای بازگشت آسان به جاده.', 'yadakshop' ),
					),
				),
				'title_field' => '{{{ title }}}',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Carousel settings controls.
	 */
	private function register_carousel_controls() {
		$this->start_controls_section(
			'section_carousel',
			array(
				'label' => esc_html__( 'تنظیمات کاروسل', 'yadakshop' ),
			)
		);

		$this->add_responsive_control(
			'slides_per_view',
			array(
				'label'              => esc_html__( 'تعداد اسلاید در نما', 'yadakshop' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 1,
				'max'                => 10,
				'step'               => 1,
				'default'            => 3,
				'tablet_default'     => 2,
				'mobile_default'     => 1,
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'space_between',
			array(
				'label'              => esc_html__( 'فاصله بین آیتم‌ها (px)', 'yadakshop' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 0,
				'max'                => 100,
				'step'               => 1,
				'default'            => 30,
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'loop',
			array(
				'label'              => esc_html__( 'حلقه (Loop)', 'yadakshop' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'بله', 'yadakshop' ),
				'label_off'          => esc_html__( 'خیر', 'yadakshop' ),
				'return_value'       => 'yes',
				'default'            => '',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'autoplay',
			array(
				'label'              => esc_html__( 'پخش خودکار', 'yadakshop' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'بله', 'yadakshop' ),
				'label_off'          => esc_html__( 'خیر', 'yadakshop' ),
				'return_value'       => 'yes',
				'default'            => '',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'autoplay_speed',
			array(
				'label'              => esc_html__( 'سرعت پخش خودکار (ms)', 'yadakshop' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 500,
				'max'                => 15000,
				'step'               => 100,
				'default'            => 5000,
				'condition'          => array(
					'autoplay' => 'yes',
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'transition_speed',
			array(
				'label'              => esc_html__( 'سرعت انتقال (ms)', 'yadakshop' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 100,
				'max'                => 3000,
				'step'               => 100,
				'default'            => 500,
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'pause_on_hover',
			array(
				'label'              => esc_html__( 'توقف با هاور', 'yadakshop' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'بله', 'yadakshop' ),
				'label_off'          => esc_html__( 'خیر', 'yadakshop' ),
				'return_value'       => 'yes',
				'default'            => 'yes',
				'condition'          => array(
					'autoplay' => 'yes',
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'center_mode',
			array(
				'label'              => esc_html__( 'حالت مرکزی', 'yadakshop' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'بله', 'yadakshop' ),
				'label_off'          => esc_html__( 'خیر', 'yadakshop' ),
				'return_value'       => 'yes',
				'default'            => '',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'infinite',
			array(
				'label'              => esc_html__( 'بی‌نهایت', 'yadakshop' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'بله', 'yadakshop' ),
				'label_off'          => esc_html__( 'خیر', 'yadakshop' ),
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'navigation',
			array(
				'label'   => esc_html__( 'ناوبری', 'yadakshop' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'both',
				'options' => array(
					'arrows' => esc_html__( 'فلش‌ها', 'yadakshop' ),
					'dots'   => esc_html__( 'نقطه‌ها', 'yadakshop' ),
					'both'   => esc_html__( 'هر دو', 'yadakshop' ),
					'none'   => esc_html__( 'هیچکدام', 'yadakshop' ),
				),
			)
		);

		$this->add_responsive_control(
			'slider_side_spacing',
			array(
				'label'      => esc_html__( 'فاصله کناری (فلش‌ها)', 'yadakshop' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 120,
					),
				),
				'default'    => array(
					'size' => 48,
				),
				'selectors'  => array(
					'{{WRAPPER}} .yadakshop-services-carousel__slider' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'dots_gap',
			array(
				'label'      => esc_html__( 'فاصله نقطه‌ها از کاروسل', 'yadakshop' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 80,
					),
				),
				'default'    => array(
					'size' => 20,
				),
				'selectors'  => array(
					'{{WRAPPER}} .yadakshop-services-carousel__pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'navigation' => array( 'dots', 'both' ),
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Style tab controls.
	 */
	private function register_style_controls() {
		$this->register_header_style_controls();
		$this->register_card_style_controls();
		$this->register_image_style_controls();
		$this->register_badge_style_controls();
		$this->register_icon_style_controls();
		$this->register_title_style_controls();
		$this->register_description_style_controls();
		$this->register_button_style_controls();
		$this->register_navigation_style_controls();
		$this->register_dots_style_controls();
	}

	/**
	 * Header style controls.
	 */
	private function register_header_style_controls() {
		$this->start_controls_section(
			'section_header_style',
			array(
				'label'     => esc_html__( 'سربرگ بخش', 'yadakshop' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_header' => 'yes',
				),
			)
		);

		$this->add_control(
			'subtitle_color',
			array(
				'label'     => esc_html__( 'رنگ زیرعنوان', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-services-carousel__subtitle' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .yadakshop-services-carousel__subtitle',
			)
		);

		$this->add_control(
			'heading_title_style',
			array(
				'label'     => esc_html__( 'عنوان', 'yadakshop' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'header_title_color',
			array(
				'label'     => esc_html__( 'رنگ عنوان', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-services-carousel__title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'header_title_highlight_color',
			array(
				'label'     => esc_html__( 'رنگ عنوان برجسته', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-services-carousel__title-highlight' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'header_title_typography',
				'selector' => '{{WRAPPER}} .yadakshop-services-carousel__title',
			)
		);

		$this->add_responsive_control(
			'header_spacing',
			array(
				'label'      => esc_html__( 'فاصله پایین', 'yadakshop' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 120,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .yadakshop-services-carousel__header' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Card style controls.
	 */
	private function register_card_style_controls() {
		$this->start_controls_section(
			'section_card_style',
			array(
				'label' => esc_html__( 'کارت', 'yadakshop' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'card_background',
				'selector' => '{{WRAPPER}} .yadakshop-service-card',
				'fields_options' => array(
					'background' => array(
						'default' => 'classic',
					),
					'color'      => array(
						'default' => '#ffffff',
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'card_border',
				'label'    => esc_html__( 'حاشیه', 'yadakshop' ),
				'selector' => '{{WRAPPER}} .yadakshop-service-card',
			)
		);

		$this->add_responsive_control(
			'card_radius',
			array(
				'label'      => esc_html__( 'شعاع گوشه', 'yadakshop' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => '16',
					'right'  => '16',
					'bottom' => '16',
					'left'   => '16',
					'unit'   => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .yadakshop-service-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .yadakshop-service-card__inner' => 'border-radius: inherit;',
					'{{WRAPPER}} .yadakshop-service-card__image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
					'{{WRAPPER}} .yadakshop-service-card__image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
					'{{WRAPPER}} .yadakshop-service-card__overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'card_shadow',
				'selector' => '{{WRAPPER}} .yadakshop-service-card',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'card_shadow_hover',
				'label'    => esc_html__( 'سایه در هاور', 'yadakshop' ),
				'selector' => '{{WRAPPER}} .yadakshop-service-card:hover',
			)
		);

		$this->add_responsive_control(
			'card_outer_spacing',
			array(
				'label'       => esc_html__( 'فضای عمودی بیرونی کارت', 'yadakshop' ),
				'description' => esc_html__( 'فقط بالا و پایین کارت اعمال می‌شود (برای سایه و هاور). فاصله افقی بین آیتم‌ها از «فاصله بین آیتم‌ها» کنترل می‌شود.', 'yadakshop' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min' => 0,
						'max' => 80,
					),
				),
				'default'     => array(
					'size' => 16,
				),
				'selectors'   => array(
					'{{WRAPPER}}' => '--yadakshop-card-outer-spacing: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'card_padding',
			array(
				'label'      => esc_html__( 'فاصله داخلی محتوا', 'yadakshop' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .yadakshop-service-card__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'card_hover_lift',
			array(
				'label'      => esc_html__( 'بلند شدن در هاور (px)', 'yadakshop' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 30,
					),
				),
				'default'    => array(
					'size' => 10,
				),
				'selectors'  => array(
					'{{WRAPPER}}' => '--yadakshop-card-hover-lift: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Image style controls.
	 */
	private function register_image_style_controls() {
		$this->start_controls_section(
			'section_image_style',
			array(
				'label' => esc_html__( 'تصویر', 'yadakshop' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'image_height',
			array(
				'label'      => esc_html__( 'ارتفاع', 'yadakshop' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'range'      => array(
					'px' => array(
						'min' => 100,
						'max' => 500,
					),
				),
				'default'    => array(
					'size' => 220,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .yadakshop-service-card__image' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_radius',
			array(
				'label'      => esc_html__( 'شعاع گوشه', 'yadakshop' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .yadakshop-service-card__image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .yadakshop-service-card__image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .yadakshop-service-card__overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'overlay_color',
			array(
				'label'     => esc_html__( 'رنگ اورلی', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-service-card__overlay' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'overlay_opacity',
			array(
				'label'      => esc_html__( 'شفافیت اورلی', 'yadakshop' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'custom' ),
				'range'      => array(
					'custom' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.05,
					),
				),
				'default'    => array(
					'size' => 0.4,
				),
				'selectors'  => array(
					'{{WRAPPER}}' => '--yadakshop-overlay-opacity: {{SIZE}};',
				),
			)
		);

		$this->add_control(
			'image_zoom',
			array(
				'label'      => esc_html__( 'مقیاس زوم در هاور', 'yadakshop' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'custom' ),
				'range'      => array(
					'custom' => array(
						'min'  => 1,
						'max'  => 1.5,
						'step' => 0.05,
					),
				),
				'default'    => array(
					'size' => 1.1,
				),
				'selectors'  => array(
					'{{WRAPPER}}' => '--yadakshop-image-zoom: {{SIZE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Number badge style controls.
	 */
	private function register_badge_style_controls() {
		$this->start_controls_section(
			'section_badge_style',
			array(
				'label' => esc_html__( 'نشان شماره', 'yadakshop' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'badge_color',
			array(
				'label'     => esc_html__( 'رنگ', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-service-card__number' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'badge_background',
			array(
				'label'     => esc_html__( 'پس‌زمینه', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-service-card__number' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'badge_typography',
				'selector' => '{{WRAPPER}} .yadakshop-service-card__number',
			)
		);

		$this->add_responsive_control(
			'badge_size',
			array(
				'label'      => esc_html__( 'اندازه', 'yadakshop' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 30,
						'max' => 100,
					),
				),
				'default'    => array(
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .yadakshop-service-card__number' => 'min-width: {{SIZE}}{{UNIT}}; min-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'badge_corner',
			array(
				'label'   => esc_html__( 'موقعیت', 'yadakshop' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top-left',
				'options' => array(
					'top-left'  => esc_html__( 'بالا چپ', 'yadakshop' ),
					'top-right' => esc_html__( 'بالا راست', 'yadakshop' ),
				),
				'prefix_class' => 'yadakshop-badge-pos--',
			)
		);

		$this->add_responsive_control(
			'badge_offset',
			array(
				'label'      => esc_html__( 'فاصله از لبه', 'yadakshop' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 40,
					),
				),
				'default'    => array(
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}}' => '--yadakshop-badge-offset: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Icon style controls.
	 */
	private function register_icon_style_controls() {
		$this->start_controls_section(
			'section_icon_style',
			array(
				'label' => esc_html__( 'آیکون', 'yadakshop' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'      => esc_html__( 'اندازه', 'yadakshop' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 30,
						'max' => 120,
					),
				),
				'default'    => array(
					'size' => 60,
				),
				'selectors'  => array(
					'{{WRAPPER}} .yadakshop-service-card__icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .yadakshop-service-card__icon i' => 'font-size: calc({{SIZE}}{{UNIT}} * 0.4);',
					'{{WRAPPER}} .yadakshop-service-card__icon svg' => 'width: calc({{SIZE}}{{UNIT}} * 0.4); height: calc({{SIZE}}{{UNIT}} * 0.4);',
				),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'رنگ', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-service-card__icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .yadakshop-service-card__icon svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_background',
			array(
				'label'     => esc_html__( 'پس‌زمینه', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-service-card__icon' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'icon_border',
				'selector' => '{{WRAPPER}} .yadakshop-service-card__icon',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'icon_shadow',
				'selector' => '{{WRAPPER}} .yadakshop-service-card__icon',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Card title style controls.
	 */
	private function register_title_style_controls() {
		$this->start_controls_section(
			'section_title_style',
			array(
				'label' => esc_html__( 'عنوان', 'yadakshop' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'item_title_typography',
				'selector' => '{{WRAPPER}} .yadakshop-service-card__title',
			)
		);

		$this->add_control(
			'item_title_color',
			array(
				'label'     => esc_html__( 'رنگ', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-service-card__title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'item_title_hover_color',
			array(
				'label'     => esc_html__( 'رنگ هاور', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-service-card:hover .yadakshop-service-card__title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Description style controls.
	 */
	private function register_description_style_controls() {
		$this->start_controls_section(
			'section_description_style',
			array(
				'label' => esc_html__( 'توضیحات', 'yadakshop' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .yadakshop-service-card__description',
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => esc_html__( 'رنگ', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-service-card__description' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Button style controls.
	 */
	private function register_button_style_controls() {
		$this->start_controls_section(
			'section_button_style',
			array(
				'label' => esc_html__( 'دکمه', 'yadakshop' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .yadakshop-service-card__button',
			)
		);

		$this->add_control(
			'button_color',
			array(
				'label'     => esc_html__( 'رنگ', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-service-card__button' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_hover_color',
			array(
				'label'     => esc_html__( 'رنگ هاور', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-service-card__button:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_spacing',
			array(
				'label'      => esc_html__( 'فاصله بالا', 'yadakshop' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 60,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .yadakshop-service-card__button' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Navigation arrows style controls.
	 */
	private function register_navigation_style_controls() {
		$this->start_controls_section(
			'section_navigation_style',
			array(
				'label'     => esc_html__( 'ناوبری', 'yadakshop' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'navigation' => array( 'arrows', 'both' ),
				),
			)
		);

		$this->add_control(
			'arrow_color',
			array(
				'label'     => esc_html__( 'رنگ', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-services-carousel__arrow' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'arrow_hover_color',
			array(
				'label'     => esc_html__( 'رنگ هاور', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-services-carousel__arrow:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'arrow_size',
			array(
				'label'      => esc_html__( 'اندازه', 'yadakshop' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 20,
						'max' => 80,
					),
				),
				'default'    => array(
					'size' => 44,
				),
				'selectors'  => array(
					'{{WRAPPER}} .yadakshop-services-carousel__arrow' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: calc({{SIZE}}{{UNIT}} * 0.4);',
				),
			)
		);

		$this->add_responsive_control(
			'arrow_radius',
			array(
				'label'      => esc_html__( 'شعاع گوشه', 'yadakshop' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .yadakshop-services-carousel__arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'arrow_background',
				'selector' => '{{WRAPPER}} .yadakshop-services-carousel__arrow',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'arrow_shadow',
				'selector' => '{{WRAPPER}} .yadakshop-services-carousel__arrow',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Pagination dots style controls.
	 */
	private function register_dots_style_controls() {
		$this->start_controls_section(
			'section_dots_style',
			array(
				'label'     => esc_html__( 'نقطه‌ها', 'yadakshop' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'navigation' => array( 'dots', 'both' ),
				),
			)
		);

		$this->add_control(
			'dots_color',
			array(
				'label'     => esc_html__( 'رنگ', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .swiper-pagination-bullet' => 'background-color: {{VALUE}}; opacity: 1;',
				),
			)
		);

		$this->add_control(
			'dots_active_color',
			array(
				'label'     => esc_html__( 'رنگ فعال', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'dots_size',
			array(
				'label'      => esc_html__( 'اندازه', 'yadakshop' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 4,
						'max' => 20,
					),
				),
				'default'    => array(
					'size' => 10,
				),
				'selectors'  => array(
					'{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'dots_spacing',
			array(
				'label'      => esc_html__( 'فاصله', 'yadakshop' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 30,
					),
				),
				'default'    => array(
					'size' => 8,
				),
				'selectors'  => array(
					'{{WRAPPER}} .swiper-pagination-bullet' => 'margin: 0 {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['items'] ) ) {
			return;
		}

		$navigation = isset( $settings['navigation'] ) ? $settings['navigation'] : 'both';
		$show_arrows = in_array( $navigation, array( 'arrows', 'both' ), true );
		$show_dots   = in_array( $navigation, array( 'dots', 'both' ), true );

		$this->add_render_attribute( 'wrapper', 'class', 'yadakshop-services-carousel' );
		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<?php $this->render_header( $settings ); ?>

			<div class="yadakshop-services-carousel__slider elementor-swiper">
				<div class="swiper yadakshop-services-carousel__swiper">
					<div class="swiper-wrapper">
						<?php
						foreach ( $settings['items'] as $index => $item ) {
							$this->render_slide( $item, $index );
						}
						?>
					</div>
				</div>

				<?php if ( $show_arrows ) : ?>
					<div class="yadakshop-services-carousel__arrow yadakshop-services-carousel__arrow--prev swiper-button-prev" role="button" tabindex="0" aria-label="<?php echo esc_attr__( 'اسلاید قبلی', 'yadakshop' ); ?>">
						<span class="yadakshop-services-carousel__arrow-icon" aria-hidden="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="10" height="16" viewBox="0 0 10 16" fill="none">
								<path d="M8 2L2 8l6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</span>
					</div>
					<div class="yadakshop-services-carousel__arrow yadakshop-services-carousel__arrow--next swiper-button-next" role="button" tabindex="0" aria-label="<?php echo esc_attr__( 'اسلاید بعدی', 'yadakshop' ); ?>">
						<span class="yadakshop-services-carousel__arrow-icon" aria-hidden="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="10" height="16" viewBox="0 0 10 16" fill="none">
								<path d="M2 2l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</span>
					</div>
				<?php endif; ?>

				<?php if ( $show_dots ) : ?>
					<div class="swiper-pagination yadakshop-services-carousel__pagination"></div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	/**
	 * Render section header.
	 *
	 * @param array $settings Widget settings.
	 */
	private function render_header( $settings ) {
		if ( 'yes' !== $settings['show_header'] ) {
			return;
		}

		$subtitle        = isset( $settings['subtitle'] ) ? $settings['subtitle'] : '';
		$title           = isset( $settings['title'] ) ? $settings['title'] : '';
		$title_highlight = isset( $settings['title_highlight'] ) ? $settings['title_highlight'] : '';

		if ( '' === $subtitle && '' === $title && '' === $title_highlight ) {
			return;
		}
		?>
		<div class="yadakshop-services-carousel__header">
			<?php if ( '' !== $subtitle ) : ?>
				<span class="yadakshop-services-carousel__subtitle"><?php echo esc_html( $subtitle ); ?></span>
			<?php endif; ?>

			<?php if ( '' !== $title || '' !== $title_highlight ) : ?>
				<h2 class="yadakshop-services-carousel__title">
					<?php
					if ( '' !== $title ) {
						echo esc_html( $title );
					}
					if ( '' !== $title_highlight ) {
						echo ' <span class="yadakshop-services-carousel__title-highlight">' . esc_html( $title_highlight ) . '</span>';
					}
					?>
				</h2>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * Render a single carousel slide.
	 *
	 * @param array $item  Repeater item.
	 * @param int   $index Item index.
	 */
	private function render_slide( $item, $index ) {
		$slide_key = 'slide_' . $index;
		$this->add_render_attribute( $slide_key, 'class', 'swiper-slide' );

		$overlay_class = 'yes' === $item['enable_overlay'] ? ' has-overlay' : '';
		$image_url     = ! empty( $item['image']['url'] ) ? $item['image']['url'] : '';
		$image_alt     = ! empty( $item['title'] ) ? $item['title'] : '';
		$link_attrs    = $this->get_link_attributes( $item, $index );
		?>
		<div <?php $this->print_render_attribute_string( $slide_key ); ?>>
			<div class="yadakshop-service-card-shell">
				<article class="yadakshop-service-card">
					<div class="yadakshop-service-card__inner">
						<div class="yadakshop-service-card__media">
							<?php if ( ! empty( $item['number'] ) ) : ?>
								<span class="yadakshop-service-card__number"><?php echo esc_html( $item['number'] ); ?></span>
							<?php endif; ?>

<a class="yadakshop-service-card__image-link" <?php echo $link_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
    <div class="yadakshop-service-card__image<?php echo esc_attr( $overlay_class ); ?>">
        <?php if ( $image_url ) : ?>
            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" loading="lazy" />
        <?php endif; ?>

        <?php if ( 'yes' === $item['enable_overlay'] ) : ?>
            <span class="yadakshop-service-card__overlay" aria-hidden="true"></span>
        <?php endif; ?>
    </div>
</a>

							<?php if ( ! empty( $item['icon']['value'] ) ) : ?>
								<div class="yadakshop-service-card__icon">
									<?php Icons_Manager::render_icon( $item['icon'], array( 'aria-hidden' => 'true' ) ); ?>
								</div>
							<?php endif; ?>
						</div>

						<div class="yadakshop-service-card__content">
							<?php if ( ! empty( $item['title'] ) ) : ?>
<h3 class="yadakshop-service-card__title">
    <a class="yadakshop-service-card__title-link" <?php echo $link_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
        <?php echo esc_html( $item['title'] ); ?>
    </a>
</h3>							<?php endif; ?>

							<?php if ( ! empty( $item['description'] ) ) : ?>
								<p class="yadakshop-service-card__description"><?php echo esc_html( $item['description'] ); ?></p>
							<?php endif; ?>

							<?php if ( ! empty( $item['button_text'] ) ) : ?>
								<a class="yadakshop-service-card__button" <?php echo $link_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
									<span class="yadakshop-service-card__button-text"><?php echo esc_html( $item['button_text'] ); ?></span>
									<span class="yadakshop-service-card__button-arrow" aria-hidden="true">&larr;</span>
								</a>
							<?php endif; ?>
						</div>
					</div>
				</article>
			</div>
		</div>
		<?php
	}

	/**
	 * Build link attributes string from repeater URL control.
	 *
	 * @param array $item  Repeater item.
	 * @param int   $index Item index.
	 * @return string
	 */
	private function get_link_attributes( $item, $index ) {
		$link_key = 'button_link_' . $this->get_id() . '_' . $index;

		if ( empty( $item['button_link']['url'] ) ) {
			$this->add_render_attribute( $link_key, 'href', '#' );

			return $this->get_render_attribute_string( $link_key );
		}

		$this->add_link_attributes( $link_key, $item['button_link'] );

		return $this->get_render_attribute_string( $link_key );
	}
}
