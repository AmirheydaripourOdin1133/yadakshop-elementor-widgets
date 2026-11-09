<?php
/**
 * Contact Us Elementor widget.
 *
 * @package Yadakshop
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

/**
 * Contact page section widget.
 */
class Yadakshop_Contact_Us extends Widget_Base {

	/**
	 * Widget slug.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'yadakshop-contact-us';
	}

	/**
	 * Widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'تماس با ما یدک شاپ', 'yadakshop' );
	}

	/**
	 * Widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-form-horizontal';
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
		return array( 'contact', 'map', 'phone', 'yadakshop' );
	}

	/**
	 * Style dependencies.
	 *
	 * @return array
	 */
	public function get_style_depends() {
		return array( 'yadakshop-contact-us' );
	}

	/**
	 * Register widget controls.
	 */
	protected function register_controls() {
		$this->register_header_controls();
		$this->register_info_controls();
		$this->register_map_controls();
		$this->register_social_controls();
		$this->register_style_controls();
	}

	/**
	 * Header content controls.
	 */
	private function register_header_controls() {
		$this->start_controls_section(
			'section_header',
			array(
				'label' => esc_html__( 'عنوان صفحه', 'yadakshop' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => esc_html__( 'عنوان فارسی', 'yadakshop' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'تماس باما', 'yadakshop' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'       => esc_html__( 'زیرعنوان انگلیسی', 'yadakshop' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'CONTACT US',
				'label_block' => true,
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Contact info controls.
	 */
	private function register_info_controls() {
		$this->start_controls_section(
			'section_info',
			array(
				'label' => esc_html__( 'اطلاعات تماس', 'yadakshop' ),
			)
		);

		$landline = new Repeater();
		$landline->add_control(
			'number',
			array(
				'label'       => esc_html__( 'شماره', 'yadakshop' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '02133991036',
				'label_block' => true,
			)
		);

		$this->add_control(
			'landline_label',
			array(
				'label'   => esc_html__( 'برچسب تلفن ثابت', 'yadakshop' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'تلفن ثابت', 'yadakshop' ),
			)
		);

		$this->add_control(
			'landline_numbers',
			array(
				'label'       => esc_html__( 'شماره‌های ثابت', 'yadakshop' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $landline->get_controls(),
				'default'     => array(
					array( 'number' => '02133991036' ),
					array( 'number' => '02133991035' ),
				),
				'title_field' => '{{{ number }}}',
			)
		);

		$mobile = new Repeater();
		$mobile->add_control(
			'number',
			array(
				'label'       => esc_html__( 'شماره', 'yadakshop' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '09122365070',
				'label_block' => true,
			)
		);

		$this->add_control(
			'mobile_label',
			array(
				'label'   => esc_html__( 'برچسب تلفن همراه', 'yadakshop' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'تلفن همراه', 'yadakshop' ),
			)
		);

		$this->add_control(
			'mobile_numbers',
			array(
				'label'       => esc_html__( 'شماره‌های همراه', 'yadakshop' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $mobile->get_controls(),
				'default'     => array(
					array( 'number' => '09122365070' ),
				),
				'title_field' => '{{{ number }}}',
			)
		);

		$email = new Repeater();
		$email->add_control(
			'address',
			array(
				'label'       => esc_html__( 'ایمیل', 'yadakshop' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'info@example.com',
				'label_block' => true,
			)
		);

		$this->add_control(
			'email_label',
			array(
				'label'   => esc_html__( 'برچسب ایمیل', 'yadakshop' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'ایمیل', 'yadakshop' ),
			)
		);

		$this->add_control(
			'emails',
			array(
				'label'       => esc_html__( 'ایمیل‌ها', 'yadakshop' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $email->get_controls(),
				'default'     => array(
					array( 'address' => 'info@example.com' ),
				),
				'title_field' => '{{{ address }}}',
			)
		);

		$this->add_control(
			'hours_label',
			array(
				'label'   => esc_html__( 'برچسب ساعات کاری', 'yadakshop' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'ساعات کاری', 'yadakshop' ),
			)
		);

		$this->add_control(
			'working_hours',
			array(
				'label'       => esc_html__( 'ساعات کاری', 'yadakshop' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '۹ صبح الی ۷ عصر', 'yadakshop' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'address_label',
			array(
				'label'   => esc_html__( 'برچسب آدرس', 'yadakshop' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'آدرس', 'yadakshop' ),
			)
		);

		$this->add_control(
			'address',
			array(
				'label'       => esc_html__( 'آدرس', 'yadakshop' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'تهران - آدرس خود را وارد کنید', 'yadakshop' ),
				'label_block' => true,
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Map controls.
	 */
	private function register_map_controls() {
		$this->start_controls_section(
			'section_map',
			array(
				'label' => esc_html__( 'نقشه', 'yadakshop' ),
			)
		);

		$this->add_control(
			'map_embed',
			array(
				'label'       => esc_html__( 'کد embed نقشه', 'yadakshop' ),
				'type'        => Controls_Manager::TEXTAREA,
				'description' => esc_html__( 'کد iframe نقشه را از گوگل مپ، نشان یا بلد کپی کنید.', 'yadakshop' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'google_map_url',
			array(
				'label'       => esc_html__( 'لینک گوگل مپ', 'yadakshop' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://maps.google.com/',
			)
		);

		$this->add_control(
			'neshan_url',
			array(
				'label'       => esc_html__( 'لینک نشان', 'yadakshop' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://neshan.org/',
			)
		);

		$this->add_control(
			'balad_url',
			array(
				'label'       => esc_html__( 'لینک بلد', 'yadakshop' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://balad.ir/',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Social links controls.
	 */
	private function register_social_controls() {
		$this->start_controls_section(
			'section_social',
			array(
				'label' => esc_html__( 'شبکه‌های اجتماعی (اختیاری)', 'yadakshop' ),
			)
		);

		$social = new Repeater();
		$social->add_control(
			'label',
			array(
				'label'       => esc_html__( 'عنوان', 'yadakshop' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'اینستاگرام', 'yadakshop' ),
				'label_block' => true,
			)
		);

		$social->add_control(
			'icon',
			array(
				'label'   => esc_html__( 'آیکون', 'yadakshop' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fab fa-instagram',
					'library' => 'fa-brands',
				),
			)
		);

		$social->add_control(
			'link',
			array(
				'label'       => esc_html__( 'لینک', 'yadakshop' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://',
			)
		);

		$this->add_control(
			'social_links',
			array(
				'label'       => esc_html__( 'لینک‌ها', 'yadakshop' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $social->get_controls(),
				'title_field' => '{{{ label }}}',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Style controls.
	 */
	private function register_style_controls() {
		$this->start_controls_section(
			'section_style_general',
			array(
				'label' => esc_html__( 'تنظیمات کلی', 'yadakshop' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'global_radius',
			array(
				'label'      => esc_html__( 'گردی المان‌ها', 'yadakshop' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 48,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 16,
				),
				'selectors'  => array(
					'{{WRAPPER}} .yadakshop-contact-us' => '--tcu-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'map_height',
			array(
				'label'      => esc_html__( 'ارتفاع نقشه', 'yadakshop' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'range'      => array(
					'px' => array(
						'min' => 200,
						'max' => 800,
					),
					'vh' => array(
						'min' => 20,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 420,
				),
				'selectors'  => array(
					'{{WRAPPER}} .yadakshop-contact-us__map iframe' => 'height: {{SIZE}}{{UNIT}} !important; min-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_header',
			array(
				'label' => esc_html__( 'هدر عنوان', 'yadakshop' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'header_background',
				'selector' => '{{WRAPPER}} .yadakshop-contact-us__header',
				'fields_options' => array(
					'background' => array(
						'default' => 'gradient',
					),
					'color' => array(
						'default' => '#1a9b4b',
					),
					'color_b' => array(
						'default' => '#0a5e7a',
					),
					'gradient_angle' => array(
						'default' => array(
							'unit' => 'deg',
							'size' => 135,
						),
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'تایپوگرافی عنوان', 'yadakshop' ),
				'selector' => '{{WRAPPER}} .yadakshop-contact-us__title',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'رنگ عنوان', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-contact-us__title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'subtitle_typography',
				'label'    => esc_html__( 'تایپوگرافی زیرعنوان', 'yadakshop' ),
				'selector' => '{{WRAPPER}} .yadakshop-contact-us__subtitle',
			)
		);

		$this->add_control(
			'subtitle_color',
			array(
				'label'     => esc_html__( 'رنگ زیرعنوان', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255,255,255,0.9)',
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-contact-us__subtitle' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_cards',
			array(
				'label' => esc_html__( 'باکس‌های اطلاعات', 'yadakshop' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'رنگ آیکون‌ها', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#d90202',
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-contact-us__card-label svg' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'label_typography',
				'label'    => esc_html__( 'تایپوگرافی برچسب', 'yadakshop' ),
				'selector' => '{{WRAPPER}} .yadakshop-contact-us__card-label',
			)
		);

		$this->add_control(
			'label_color',
			array(
				'label'     => esc_html__( 'رنگ برچسب', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-contact-us__card-label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'value_typography',
				'label'    => esc_html__( 'تایپوگرافی مقدار', 'yadakshop' ),
				'selector' => '{{WRAPPER}} .yadakshop-contact-us__card-value, {{WRAPPER}} .yadakshop-contact-us__card-value a',
			)
		);

		$this->add_control(
			'value_color',
			array(
				'label'     => esc_html__( 'رنگ مقدار', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0a0a0a',
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-contact-us__card-value' => 'color: {{VALUE}};',
					'{{WRAPPER}} .yadakshop-contact-us__card-value a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'value_hover_color',
			array(
				'label'     => esc_html__( 'رنگ مقدار (هاور)', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#d90202',
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-contact-us__card-value a:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_social',
			array(
				'label' => esc_html__( 'شبکه‌های اجتماعی', 'yadakshop' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'social_typography',
				'label'    => esc_html__( 'تایپوگرافی متن', 'yadakshop' ),
				'selector' => '{{WRAPPER}} .yadakshop-contact-us__social-label',
			)
		);

		$this->start_controls_tabs( 'social_color_tabs' );

		$this->start_controls_tab(
			'social_tab_normal',
			array(
				'label' => esc_html__( 'عادی', 'yadakshop' ),
			)
		);

		$this->add_control(
			'social_bg_color',
			array(
				'label'     => esc_html__( 'پس‌زمینه', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f7f7f7',
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-contact-us__social-items a' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'social_text_color',
			array(
				'label'     => esc_html__( 'رنگ متن', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0a0a0a',
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-contact-us__social-label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'social_icon_color',
			array(
				'label'     => esc_html__( 'رنگ آیکون', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#960016',
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-contact-us__social-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .yadakshop-contact-us__social-icon svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .yadakshop-contact-us__social-icon i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'social_tab_hover',
			array(
				'label' => esc_html__( 'هاور', 'yadakshop' ),
			)
		);

		$this->add_control(
			'social_bg_hover_color',
			array(
				'label'     => esc_html__( 'پس‌زمینه', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#960016',
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-contact-us__social-items a:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'social_text_hover_color',
			array(
				'label'     => esc_html__( 'رنگ متن', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-contact-us__social-items a:hover .yadakshop-contact-us__social-label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'social_icon_hover_color',
			array(
				'label'     => esc_html__( 'رنگ آیکون', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-contact-us__social-items a:hover .yadakshop-contact-us__social-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .yadakshop-contact-us__social-items a:hover .yadakshop-contact-us__social-icon svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .yadakshop-contact-us__social-items a:hover .yadakshop-contact-us__social-icon i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Render widget output.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="yadakshop-contact-us">
			<div class="yadakshop-contact-us__inner mainView">
				<?php $this->render_header( $settings ); ?>
				<?php $this->render_cards( $settings ); ?>
				<?php $this->render_map( $settings ); ?>
				<?php $this->render_social( $settings ); ?>
			</div>
		</div>
		<?php
	}

	/**
	 * Render page header.
	 *
	 * @param array $settings Widget settings.
	 */
	private function render_header( $settings ) {
		$title    = isset( $settings['title'] ) ? trim( $settings['title'] ) : '';
		$subtitle = isset( $settings['subtitle'] ) ? trim( $settings['subtitle'] ) : '';

		if ( '' === $title && '' === $subtitle ) {
			return;
		}
		?>
		<div class="yadakshop-contact-us__header">
			<?php if ( $title ) : ?>
				<h1 class="yadakshop-contact-us__title"><?php echo esc_html( $title ); ?></h1>
			<?php endif; ?>
			<?php if ( $subtitle ) : ?>
				<p class="yadakshop-contact-us__subtitle"><?php echo esc_html( $subtitle ); ?></p>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * Render contact info cards.
	 *
	 * @param array $settings Widget settings.
	 */
	private function render_cards( $settings ) {
		$cards = array();

		if ( ! empty( $settings['landline_numbers'] ) ) {
			$numbers = $this->pluck_repeater_values( $settings['landline_numbers'], 'number' );
			if ( $numbers ) {
				$cards[] = array(
					'label' => $settings['landline_label'],
					'icon'  => $this->get_icon_landline(),
					'type'  => 'tel',
					'items' => $numbers,
				);
			}
		}

		if ( ! empty( $settings['mobile_numbers'] ) ) {
			$numbers = $this->pluck_repeater_values( $settings['mobile_numbers'], 'number' );
			if ( $numbers ) {
				$cards[] = array(
					'label' => $settings['mobile_label'],
					'icon'  => $this->get_icon_mobile(),
					'type'  => 'tel',
					'items' => $numbers,
				);
			}
		}

		if ( ! empty( $settings['emails'] ) ) {
			$emails = $this->pluck_repeater_values( $settings['emails'], 'address' );
			if ( $emails ) {
				$cards[] = array(
					'label' => $settings['email_label'],
					'icon'  => $this->get_icon_email(),
					'type'  => 'email',
					'items' => $emails,
				);
			}
		}

		if ( ! empty( $settings['working_hours'] ) ) {
			$cards[] = array(
				'label' => $settings['hours_label'],
				'icon'  => $this->get_icon_clock(),
				'type'  => 'text',
				'items' => array( $settings['working_hours'] ),
			);
		}

		if ( ! empty( $settings['address'] ) ) {
			$cards[] = array(
				'label'      => $settings['address_label'],
				'icon'       => $this->get_icon_location(),
				'type'       => 'text',
				'items'      => array( $settings['address'] ),
				'full_width' => true,
			);
		}

		if ( empty( $cards ) ) {
			return;
		}
		?>
		<div class="yadakshop-contact-us__cards">
			<?php foreach ( $cards as $card ) : ?>
				<div class="yadakshop-contact-us__card<?php echo ! empty( $card['full_width'] ) ? ' yadakshop-contact-us__card--full' : ''; ?>">
					<div class="yadakshop-contact-us__card-label">
						<?php echo $card['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<span><?php echo esc_html( $card['label'] ); ?></span>
					</div>
					<div class="yadakshop-contact-us__card-value">
						<?php $this->render_card_values( $card ); ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
	}

	/**
	 * Render card value items.
	 *
	 * @param array $card Card data.
	 */
	private function render_card_values( $card ) {
		foreach ( $card['items'] as $item ) {
			$item = trim( (string) $item );
			if ( '' === $item ) {
				continue;
			}

			if ( 'tel' === $card['type'] ) {
				printf(
					'<a href="tel:%1$s">%2$s</a>',
					esc_attr( preg_replace( '/\s+/', '', $item ) ),
					esc_html( $item )
				);
			} elseif ( 'email' === $card['type'] ) {
				printf(
					'<a href="mailto:%1$s">%2$s</a>',
					esc_attr( $item ),
					esc_html( $item )
				);
			} else {
				printf( '<p>%s</p>', esc_html( $item ) );
			}
		}
	}

	/**
	 * Render map section.
	 *
	 * @param array $settings Widget settings.
	 */
	private function render_map( $settings ) {
		$embed = isset( $settings['map_embed'] ) ? trim( $settings['map_embed'] ) : '';

		if ( '' === $embed ) {
			return;
		}

		$map_links = array(
			array(
				'url'   => $settings['google_map_url']['url'] ?? '',
				'label' => esc_html__( 'گوگل مپ', 'yadakshop' ),
				'icon'  => $this->get_map_icon( 'google' ),
			),
			array(
				'url'   => $settings['neshan_url']['url'] ?? '',
				'label' => esc_html__( 'نشان', 'yadakshop' ),
				'icon'  => $this->get_map_icon( 'neshan' ),
			),
			array(
				'url'   => $settings['balad_url']['url'] ?? '',
				'label' => esc_html__( 'بلد', 'yadakshop' ),
				'icon'  => $this->get_map_icon( 'balad' ),
			),
		);
		?>
		<div class="yadakshop-contact-us__map-wrap">
			<div class="yadakshop-contact-us__map">
				<?php echo $this->sanitize_map_embed( $embed ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
			<div class="yadakshop-contact-us__map-actions">
				<?php foreach ( $map_links as $link ) : ?>
					<?php if ( empty( $link['url'] ) ) : ?>
						<?php continue; ?>
					<?php endif; ?>
					<a href="<?php echo esc_url( $link['url'] ); ?>" target="_blank" rel="noopener noreferrer">
						<?php echo esc_html( $link['label'] ); ?>
						<?php echo $link['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}

	/**
	 * Render social links.
	 *
	 * @param array $settings Widget settings.
	 */
	private function render_social( $settings ) {
		if ( empty( $settings['social_links'] ) ) {
			return;
		}

		$links = array_filter(
			$settings['social_links'],
			function ( $item ) {
				if ( empty( $item['link']['url'] ) ) {
					return false;
				}

				return ! empty( $item['label'] ) || ! empty( $item['icon']['value'] );
			}
		);

		if ( empty( $links ) ) {
			return;
		}
		?>
		<div class="yadakshop-contact-us__social">
			<div class="yadakshop-contact-us__social-items">
				<?php foreach ( $links as $item ) : ?>
					<a href="<?php echo esc_url( $item['link']['url'] ); ?>"<?php echo ! empty( $item['link']['is_external'] ) ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>
						<?php if ( ! empty( $item['icon']['value'] ) ) : ?>
							<span class="yadakshop-contact-us__social-icon">
								<?php Icons_Manager::render_icon( $item['icon'], array( 'aria-hidden' => 'true' ) ); ?>
							</span>
						<?php endif; ?>
						<?php if ( ! empty( $item['label'] ) ) : ?>
							<span class="yadakshop-contact-us__social-label"><?php echo esc_html( $item['label'] ); ?></span>
						<?php endif; ?>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}

	/**
	 * Extract non-empty repeater values.
	 *
	 * @param array  $rows Repeater rows.
	 * @param string $key  Field key.
	 * @return array
	 */
	private function pluck_repeater_values( $rows, $key ) {
		$values = array();

		foreach ( $rows as $row ) {
			if ( empty( $row[ $key ] ) ) {
				continue;
			}
			$values[] = trim( (string) $row[ $key ] );
		}

		return $values;
	}

	/**
	 * Sanitize map iframe embed.
	 *
	 * @param string $embed Raw embed HTML.
	 * @return string
	 */
	private function sanitize_map_embed( $embed ) {
		return wp_kses(
			$embed,
			array(
				'iframe' => array(
					'src'             => true,
					'width'           => true,
					'height'          => true,
					'style'           => true,
					'allowfullscreen' => true,
					'loading'         => true,
					'referrerpolicy'  => true,
					'title'           => true,
					'frameborder'     => true,
					'class'           => true,
					'id'              => true,
				),
			)
		);
	}

	/**
	 * Load map service icon SVG.
	 *
	 * @param string $name Icon slug.
	 * @return string
	 */
	private function get_map_icon( $name ) {
		$name = sanitize_key( $name );
		$path = YADAKSHOP_PLUGIN_DIR . '/assets/svg/' . $name . '.svg';

		if ( ! file_exists( $path ) ) {
			return '';
		}

		// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
		$svg = file_get_contents( $path );

		if ( false === $svg || '' === $svg ) {
			return '';
		}

		$prefix = 'yadakshop-' . $name . '-';

		// Each file uses the same fragment ids (#a, #b). Namespace them so inline SVGs do not clash.
		$svg = preg_replace( '/\bid="([a-z])"/', 'id="' . $prefix . '$1"', $svg );
		$svg = str_replace( 'url(#a)', 'url(#' . $prefix . 'a)', $svg );
		$svg = str_replace( 'xlink:href="#b"', 'xlink:href="#' . $prefix . 'b"', $svg );
		$svg = str_replace( 'href="#b"', 'href="#' . $prefix . 'b"', $svg );

		return $svg;
	}

	/**
	 * Landline phone icon SVG.
	 *
	 * @return string
	 */
	private function get_icon_landline() {
		return '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6.55 22.75c1.13 0 2.32-.27 3.55-.79 1.2-.51 2.41-1.21 3.59-2.06 1.17-.86 2.3-1.82 3.37-2.87 1.06-1.07 2.02-2.2 2.87-3.36.86-1.2 1.55-2.4 2.04-3.56.52-1.24.78-2.44.78-3.57 0-.78-.14-1.52-.41-2.21-.28-.71-.73-1.37-1.34-1.94-.77-.76-1.65-1.14-2.59-1.14-.39 0-.79.09-1.13.25-.39.18-.72.45-.96.81L14 5.58c-.21.29-.37.57-.48.85-.13.3-.2.6-.2.89 0 .38.11.75.32 1.1a4 4 0 0 0 .67.85l.68.71-.03.07c-.12.21-.36.57-.82 1.11-.49.56-.95 1.07-1.41 1.54-.59.58-1.08 1.04-1.54 1.42-.57.48-.94.72-1.16.83l-.71-.67a3.5 3.5 0 0 1-.9-.69c-.55-.34-1.25-.4-1.95-.11-.26.11-.54.26-.84.47l-3.32 2.36c-.37.25-.64.57-.8.95-.15.38-.22.73-.22 1.08 0 .48.11.96.32 1.41s.47.84.8 1.2c.57.63 1.19 1.08 1.91 1.37.69.28 1.44.43 2.23.43m11.86-20c.55 0 1.06.24 1.55.72.46.43.78.9.98 1.41.21.52.31 1.07.31 1.66 0 .93-.22 1.94-.66 2.98-.45 1.06-1.08 2.16-1.88 3.26S17 14.95 16 15.96c-1 .99-2.08 1.91-3.19 2.72-1.08.79-2.19 1.43-3.29 1.89-1.71.73-3.31.9-4.63.35-.51-.21-.96-.53-1.37-.99-.23-.25-.41-.52-.56-.84-.12-.25-.18-.51-.18-.77 0-.16.03-.32.11-.5.03-.06.09-.17.28-.3l3.32-2.36c.2-.14.38-.24.55-.31.22-.09.31-.18.65.03.2.1.38.25.58.45l.76.75c.39.38.99.47 1.45.3l.27-.12c.41-.22.89-.56 1.42-1.01.48-.41 1-.89 1.63-1.51.49-.5.98-1.03 1.49-1.62.34-.39.78-.87 1.02-1.41l.12-.3c.06-.23.08-.36.08-.5 0-.36-.13-.68-.38-.93l-.75-.78a1.2 1.2 0 0 1-.45-.56.64.64 0 0 1-.11-.34c0-.08.03-.2.08-.32.07-.16.18-.34.32-.53l2.32-3.28c.1-.14.22-.24.37-.31.16-.07.33-.11.5-.11m-8.36 12.26.16.68-.27-.7c.05-.01.09 0 .11.02M5.5 9.75c.41 0 .75-.34.75-.75 0-.36.36-1.11.96-1.75.59-.63 1.24-1 1.79-1 .41 0 .75-.34.75-.75s-.34-.75-.75-.75c-.97 0-1.99.52-2.88 1.47C5.29 7.11 4.75 8.2 4.75 9c0 .41.34.75.75.75m-3.5 0c.41 0 .75-.34.75-.75 0-3.45 2.8-6.25 6.25-6.25.41 0 .75-.34.75-.75s-.34-.75-.75-.75C4.73 1.25 1.25 4.73 1.25 9c0 .41.34.75.75.75" fill="currentColor"/></svg>';
	}

	/**
	 * Mobile phone icon SVG.
	 *
	 * @return string
	 */
	private function get_icon_mobile() {
		return '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 22.75H9c-4.41 0-5.75-1.34-5.75-5.75V7c0-4.41 1.34-5.75 5.75-5.75h6c4.41 0 5.75 1.34 5.75 5.75v10c0 4.41-1.34 5.75-5.75 5.75m-6-20c-3.58 0-4.25.68-4.25 4.25v10c0 3.57.67 4.25 4.25 4.25h6c3.58 0 4.25-.68 4.25-4.25V7c0-3.57-.67-4.25-4.25-4.25z" fill="currentColor"/><path d="M14 6.25h-4c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h4c.41 0 .75.34.75.75s-.34.75-.75.75m-2 13.61a2.3 2.3 0 1 1 0-4.6 2.3 2.3 0 0 1 0 4.6m0-3.11c-.44 0-.8.36-.8.8s.36.8.8.8.8-.36.8-.8-.36-.8-.8-.8" fill="currentColor"/></svg>';
	}

	/**
	 * Email icon SVG.
	 *
	 * @return string
	 */
	private function get_icon_email() {
		return '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M17 21.25H7c-3.65 0-5.75-2.1-5.75-5.75v-7c0-3.65 2.1-5.75 5.75-5.75h10c3.65 0 5.75 2.1 5.75 5.75v7c0 3.65-2.1 5.75-5.75 5.75m-10-17c-2.86 0-4.25 1.39-4.25 4.25v7c0 2.86 1.39 4.25 4.25 4.25h10c2.86 0 4.25-1.39 4.25-4.25v-7c0-2.86-1.39-4.25-4.25-4.25z" fill="currentColor"/><path d="M12 12.87c-.84 0-1.69-.26-2.34-.79l-3.13-2.5a.748.748 0 0 1 .93-1.17l3.13 2.5c.76.61 2.05.61 2.81 0l3.13-2.5c.32-.26.8-.21 1.05.12.26.32.21.8-.12 1.05l-3.13 2.5c-.64.53-1.49.79-2.33.79" fill="currentColor"/></svg>';
	}

	/**
	 * Clock icon SVG.
	 *
	 * @return string
	 */
	private function get_icon_clock() {
		return '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m15.172 15.172-3.167-3.167V5.672" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/><path d="M12 21.5a9.5 9.5 0 1 0 0-19 9.5 9.5 0 0 0 0 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
	}

	/**
	 * Location icon SVG.
	 *
	 * @return string
	 */
	private function get_icon_location() {
		return '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 14.17c-2.13 0-3.87-1.73-3.87-3.87S9.87 6.44 12 6.44s3.87 1.73 3.87 3.87-1.74 3.86-3.87 3.86m0-6.23c-1.3 0-2.37 1.06-2.37 2.37s1.06 2.37 2.37 2.37 2.37-1.06 2.37-2.37S13.3 7.94 12 7.94" fill="currentColor"/><path d="M12 22.76a5.97 5.97 0 0 1-4.13-1.67c-2.95-2.84-6.21-7.37-4.98-12.76C4 3.44 8.27 1.25 12 1.25h.01c3.73 0 8 2.19 9.11 7.09 1.22 5.39-2.04 9.91-4.99 12.75A5.97 5.97 0 0 1 12 22.76m0-20.01c-2.91 0-6.65 1.55-7.64 5.91C3.28 13.37 6.24 17.43 8.92 20a4.426 4.426 0 0 0 6.17 0c2.67-2.57 5.63-6.63 4.57-11.34-1-4.36-4.75-5.91-7.66-5.91" fill="currentColor"/></svg>';
	}
}
