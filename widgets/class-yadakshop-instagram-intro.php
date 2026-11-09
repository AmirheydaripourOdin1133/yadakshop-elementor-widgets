<?php
/**
 * Instagram Intro Widget.
 *
 * @package Yadakshop
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Yadakshop_Instagram_Intro extends Widget_Base {

	public function get_name() {
		return 'yadakshop-instagram-intro';
	}

	public function get_title() {
		return esc_html__( 'معرفی اینستاگرام', 'yadakshop' );
	}

	public function get_icon() {
		return 'eicon-instagram';
	}

	public function get_categories() {
		return array( 'yadakshop' );
	}

	public function get_keywords() {
		return array( 'instagram', 'social', 'intro', 'yadakshop' );
	}

	public function get_style_depends() {
		return array( 'yadakshop-instagram-intro' );
	}

	protected function register_controls() {
		$this->register_content_controls();
		$this->register_style_controls();
	}

	/**
	 * Content controls.
	 */
	private function register_content_controls() {
		$this->start_controls_section(
			'section_instagram_content',
			array(
				'label' => esc_html__( 'محتوا', 'yadakshop' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => esc_html__( 'عنوان', 'yadakshop' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'معرفی اینستاگرام', 'yadakshop' ),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'       => esc_html__( 'تصویر', 'yadakshop' ),
				'type'        => Controls_Manager::MEDIA,
				'dynamic'     => array( 'url' ),
			)
		);

		$this->add_control(
			'insta_btn_text',
			array(
				'label'       => esc_html__( 'متن دکمه', 'yadakshop' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'مشاهده صفحهٔ اینستاگرام', 'yadakshop' ),
			)
		);

		$this->add_control(
			'insta_btn_link',
			array(
				'label'       => esc_html__( 'لینک دکمه', 'yadakshop' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://example.com', 'yadakshop' ),
				'show_external' => true,
				'default'     => array(
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
					'target'      => '_blank',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Style controls.
	 */
	private function register_style_controls() {
		$this->start_controls_section(
			'section_instagram_style',
			array(
				'label' => esc_html__( 'سبک‌بندی', 'yadakshop' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'background_color',
			array(
				'label'     => esc_html__( 'رنگ بک‌گراند', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#EEF8FC',
				'selectors' => array(
					'{{WRAPPER}} .BoxParentInsta' => 'background-color: {{VALUE}};',
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

		if ( empty( $settings['image'] ) ) {
			return;
		}

		$title      = ! empty( $settings['title'] ) ? $settings['title'] : '';
		$img_id     = ! empty( $settings['image']['id'] ) ? absint( $settings['image']['id'] ) : 0;
		$img_url    = ! empty( $settings['image']['url'] ) ? $settings['image']['url'] : '';
		$btn_txt    = ! empty( $settings['insta_btn_text'] ) ? $settings['insta_btn_text'] : '';
		$btn_url    = ! empty( $settings['insta_btn_link']['url'] ) ? esc_url( $settings['insta_btn_link']['url'] ) : '#';
		$btn_tgt    = ! empty( $settings['insta_btn_link']['target'] ) ? $settings['insta_btn_link']['target'] : '_self';
		$bg_color   = ! empty( $settings['background_color'] ) ? $settings['background_color'] : '#EEF8FC';

		$this->add_render_attribute( 'wrapper', 'class', 'SectionsInsta mgBot mainView' );
		$this->add_render_attribute( 'box', 'class', 'BoxParentInsta' );
		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<div <?php $this->print_render_attribute_string( 'box' ); ?>>
				<?php
				// Inline SVG background (same shape as original design) with dynamic fill color.
				?>
				<svg class="InstaBgSvg" width="1280" height="500" viewBox="0 0 1280 500" fill="none" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; pointer-events: none;">
					<path d="M15.329 20.787c.33-3.638 3.09-6.355 6.74-6.479C74.713 12.525 451.389 0 643.286 0c191.79 0 562.484 12.512 614.654 14.305 3.65.126 6.4 2.842 6.73 6.478C1267.52 52.139 1280 193.02 1280 256c0 62.687-12.36 193.226-15.29 223.237-.35 3.614-3.1 6.331-6.73 6.456C1205.97 487.482 835.127 500 643.286 500c-191.947 0-568.77-12.532-621.258-14.31-3.631-.123-6.387-2.841-6.74-6.457C12.362 449.215 0 318.685 0 256 0 193.023 12.478 52.15 15.329 20.787" fill="<?php echo esc_attr( $bg_color ); ?>" />
				</svg>
				<p class="CustomTxtInsta"><?php echo esc_html( $title ); ?></p>
				<?php
				if ( $img_id ) {
					echo wp_get_attachment_image(
						$img_id,
						'full',
						false,
						array(
							'class'    => 'imgsInsta',
							'loading'  => 'lazy',
							'decoding' => 'async',
							'sizes'    => '(max-width: 1080px) 320px, 560px',
						)
					);
				} elseif ( $img_url ) {
					?>
					<img class="imgsInsta" src="<?php echo esc_url( $img_url ); ?>" loading="lazy" decoding="async" sizes="(max-width: 1080px) 320px, 560px">
					<?php
				}
				?>

				<?php if ( ! empty( $btn_txt ) ) : ?>
					<a href="<?php echo esc_url( $btn_url ); ?>" target="<?php echo esc_attr( $btn_tgt ); ?>" class="buttonCustomAramrsh Insta">
						<p><?php echo esc_html( $btn_txt ); ?></p>
						<span class="ParentIcon">
							<svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="m6.813 6.25 8.75 8.75" stroke="currentcolor" stroke-width="2" stroke-linecap="round" />
								<path d="M13.896 5.157s-6.707-.566-7.725.452-.452 7.724-.452 7.724" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</span>
					</a>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
