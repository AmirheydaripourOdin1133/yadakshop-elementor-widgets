<?php
/**
 * Special Content Section Elementor widget.
 *
 * @package Yadakshop
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

/**
 * Special content section widget class.
 */
class Yadakshop_Special_Content extends Widget_Base {

	/**
	 * Widget slug.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'yadakshop-special-content';
	}

	/**
	 * Widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'سکشن محتوایی ویژه یدک شاپ', 'yadakshop' );
	}

	/**
	 * Widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-image-box';
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
		return array( 'about', 'content', 'image', 'special', 'yadakshop' );
	}

	/**
	 * Style dependencies.
	 *
	 * @return array
	 */
	public function get_style_depends() {
		return array( 'yadakshop-special-content' );
	}

	/**
	 * Register widget controls.
	 */
	protected function register_controls() {
		$this->register_content_controls();
		$this->register_style_controls();
	}

	/**
	 * Content tab controls.
	 */
	private function register_content_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'محتوا', 'yadakshop' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => esc_html__( 'عنوان', 'yadakshop' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'درباره ما', 'yadakshop' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'image',
			array(
				'label' => esc_html__( 'تصویر', 'yadakshop' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);

		$this->add_control(
			'content',
			array(
				'label'   => esc_html__( 'متن', 'yadakshop' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'متن محتوای خود را اینجا وارد کنید.', 'yadakshop' ),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Style tab controls.
	 */
	private function register_style_controls() {
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
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .yadakshop-special-content__title',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'رنگ', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-special-content__title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			array(
				'label' => esc_html__( 'متن', 'yadakshop' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .yadakshop-special-content__content',
			)
		);

		$this->add_control(
			'content_color',
			array(
				'label'     => esc_html__( 'رنگ', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-special-content__content' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			array(
				'label' => esc_html__( 'تصویر', 'yadakshop' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'image_radius',
			array(
				'label'      => esc_html__( 'گردی گوشه‌ها', 'yadakshop' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => '48',
					'right'  => '48',
					'bottom' => '48',
					'left'   => '48',
					'unit'   => 'px',
				),
				'tablet_default' => array(
					'top'    => '24',
					'right'  => '24',
					'bottom' => '24',
					'left'   => '24',
					'unit'   => 'px',
				),
				'mobile_default' => array(
					'top'    => '16',
					'right'  => '16',
					'bottom' => '16',
					'left'   => '16',
					'unit'   => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .yadakshop-special-content__image-side' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .yadakshop-special-content__image-side img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_style',
			array(
				'label' => esc_html__( 'باکس محتوا (دسکتاپ)', 'yadakshop' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'content_box_radius',
			array(
				'label'      => esc_html__( 'گردی گوشه‌ها', 'yadakshop' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => '48',
					'right'  => '0',
					'bottom' => '48',
					'left'   => '0',
					'unit'   => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .yadakshop-special-content__content-side' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_box_padding',
			array(
				'label'      => esc_html__( 'فاصله داخلی', 'yadakshop' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'    => '54',
					'right'  => '0',
					'bottom' => '54',
					'left'   => '40',
					'unit'   => 'px',
				),
				'tablet_default' => array(
					'top'    => '24',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => 'px',
				),
				'mobile_default' => array(
					'top'    => '24',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .yadakshop-special-content__content-side' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$title    = isset( $settings['title'] ) ? trim( $settings['title'] ) : '';

		if ( '' === $title ) {
			return;
		}

		$image_url = ! empty( $settings['image']['url'] ) ? $settings['image']['url'] : '';
		$content   = isset( $settings['content'] ) ? $settings['content'] : '';
		?>
		<div class="yadakshop-special-content">
			<div class="yadakshop-special-content__inner">
				<div class="yadakshop-special-content__image-side">
					<div class="yadakshop-special-content__heading yadakshop-special-content__heading--mobile">
						<?php $this->render_title( $title ); ?>
					</div>

					<?php if ( $image_url ) : ?>
						<img
							class="yadakshop-special-content__image"
							src="<?php echo esc_url( $image_url ); ?>"
							alt="<?php echo esc_attr( $title ); ?>"
							loading="lazy"
						/>
					<?php endif; ?>
				</div>

				<div class="yadakshop-special-content__content-side">
					<div class="yadakshop-special-content__heading yadakshop-special-content__heading--desktop">
						<?php $this->render_title( $title ); ?>
					</div>

					<?php if ( '' !== $content ) : ?>
						<div class="yadakshop-special-content__content">
							<?php echo wp_kses_post( $content ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Render section title markup.
	 *
	 * @param string $title Section title.
	 */
	private function render_title( $title ) {
		?>
		<h3 class="yadakshop-special-content__title"><?php echo esc_html( $title ); ?></h3>
		<?php
	}
}
