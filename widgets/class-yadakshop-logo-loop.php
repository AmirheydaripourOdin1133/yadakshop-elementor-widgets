<?php
/**
 * Logo Loop Elementor widget.
 *
 * Inspired by React Bits Logo Loop – https://reactbits.dev/animations/logo-loop
 *
 * @package Yadakshop
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

/**
 * Logo Loop widget class.
 */
class Yadakshop_Logo_Loop extends Widget_Base {

	/**
	 * Widget slug.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'yadakshop-logo-loop';
	}

	/**
	 * Widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'حلقه لوگو یدک شاپ', 'yadakshop' );
	}

	/**
	 * Widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-logo';
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
		return array( 'logo', 'loop', 'marquee', 'brand', 'yadakshop' );
	}

	/**
	 * Script dependencies.
	 *
	 * @return array
	 */
	public function get_script_depends() {
		return array( 'yadakshop-logo-loop' );
	}

	/**
	 * Style dependencies.
	 *
	 * @return array
	 */
	public function get_style_depends() {
		return array( 'yadakshop-logo-loop' );
	}

	/**
	 * Register widget controls.
	 */
	protected function register_controls() {
		$this->register_content_controls();
		$this->register_effect_controls();
	}

	/**
	 * Content controls.
	 */
	private function register_content_controls() {
		$this->start_controls_section(
			'section_logos',
			array(
				'label' => esc_html__( 'لوگوها', 'yadakshop' ),
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
			'alt',
			array(
				'label'       => esc_html__( 'متن جایگزین', 'yadakshop' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'link',
			array(
				'label'       => esc_html__( 'لینک', 'yadakshop' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://example.com', 'yadakshop' ),
			)
		);

		$this->add_control(
			'logos',
			array(
				'label'       => esc_html__( 'آیتم‌ها', 'yadakshop' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'alt' => esc_html__( 'لوگو ۱', 'yadakshop' ),
					),
					array(
						'alt' => esc_html__( 'لوگو ۲', 'yadakshop' ),
					),
					array(
						'alt' => esc_html__( 'لوگو ۳', 'yadakshop' ),
					),
					array(
						'alt' => esc_html__( 'لوگو ۴', 'yadakshop' ),
					),
				),
				'title_field' => '{{{ alt }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_animation',
			array(
				'label' => esc_html__( 'انیمیشن', 'yadakshop' ),
			)
		);

		$this->add_control(
			'speed',
			array(
				'label'              => esc_html__( 'سرعت (px/s)', 'yadakshop' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 120,
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'direction',
			array(
				'label'              => esc_html__( 'جهت', 'yadakshop' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'left',
				'options'            => array(
					'left'  => esc_html__( 'چپ', 'yadakshop' ),
					'right' => esc_html__( 'راست', 'yadakshop' ),
					'up'    => esc_html__( 'بالا', 'yadakshop' ),
					'down'  => esc_html__( 'پایین', 'yadakshop' ),
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'logo_height',
			array(
				'label'              => esc_html__( 'ارتفاع لوگو (px)', 'yadakshop' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 16,
				'max'                => 200,
				'step'               => 1,
				'default'            => 28,
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'gap',
			array(
				'label'              => esc_html__( 'فاصله بین لوگوها (px)', 'yadakshop' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 0,
				'max'                => 200,
				'step'               => 1,
				'default'            => 32,
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
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'hover_speed',
			array(
				'label'              => esc_html__( 'سرعت در هاور (px/s)', 'yadakshop' ),
				'description'        => esc_html__( 'خالی بگذارید تا از «توقف با هاور» استفاده شود.', 'yadakshop' ),
				'type'               => Controls_Manager::NUMBER,
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'aria_label',
			array(
				'label'       => esc_html__( 'برچسب دسترسی‌پذیری', 'yadakshop' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'لوگوهای همکار', 'yadakshop' ),
				'label_block' => true,
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Effect controls.
	 */
	private function register_effect_controls() {
		$this->start_controls_section(
			'section_effects',
			array(
				'label' => esc_html__( 'افکت‌ها', 'yadakshop' ),
			)
		);

		$this->add_control(
			'fade_out',
			array(
				'label'              => esc_html__( 'محو شدن لبه‌ها', 'yadakshop' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'بله', 'yadakshop' ),
				'label_off'          => esc_html__( 'خیر', 'yadakshop' ),
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'fade_out_color',
			array(
				'label'              => esc_html__( 'رنگ محو لبه', 'yadakshop' ),
				'type'               => Controls_Manager::COLOR,
				'default'            => '#ffffff',
				'frontend_available' => true,
				'condition'          => array(
					'fade_out' => 'yes',
				),
			)
		);

		$this->add_control(
			'scale_on_hover',
			array(
				'label'              => esc_html__( 'بزرگ‌نمایی لوگو در هاور', 'yadakshop' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'بله', 'yadakshop' ),
				'label_off'          => esc_html__( 'خیر', 'yadakshop' ),
				'return_value'       => 'yes',
				'default'            => '',
				'frontend_available' => true,
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['logos'] ) ) {
			return;
		}

		$direction   = ! empty( $settings['direction'] ) ? $settings['direction'] : 'left';
		$is_vertical = in_array( $direction, array( 'up', 'down' ), true );
		$gap         = isset( $settings['gap'] ) ? (int) $settings['gap'] : 32;
		$logo_height = isset( $settings['logo_height'] ) ? (int) $settings['logo_height'] : 28;
		$fade_color  = ! empty( $settings['fade_out_color'] ) ? $settings['fade_out_color'] : '#ffffff';

		$classes = array(
			'yadakshop-logo-loop',
			$is_vertical ? 'yadakshop-logo-loop--vertical' : 'yadakshop-logo-loop--horizontal',
		);

		if ( 'yes' === $settings['fade_out'] ) {
			$classes[] = 'yadakshop-logo-loop--fade';
		}

		if ( 'yes' === $settings['scale_on_hover'] ) {
			$classes[] = 'yadakshop-logo-loop--scale-hover';
		}

		$this->add_render_attribute(
			'wrapper',
			'class',
			$classes
		);

		$this->add_render_attribute(
			'wrapper',
			'style',
			sprintf(
				'--yadakshop-logoloop-gap:%1$dpx;--yadakshop-logoloop-logoHeight:%2$dpx;--yadakshop-logoloop-fadeColor:%3$s;',
				$gap,
				$logo_height,
				esc_attr( $fade_color )
			)
		);

		$this->add_render_attribute(
			'wrapper',
			'role',
			'region'
		);

		$this->add_render_attribute(
			'wrapper',
			'aria-label',
			! empty( $settings['aria_label'] ) ? $settings['aria_label'] : esc_html__( 'لوگوهای همکار', 'yadakshop' )
		);
		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<div class="yadakshop-logo-loop__track">
				<ul class="yadakshop-logo-loop__list" data-logoloop-seq role="list">
					<?php
					foreach ( $settings['logos'] as $index => $item ) {
						$this->render_logo_item( $item, $index );
					}
					?>
				</ul>
			</div>
		</div>
		<?php
	}

	/**
	 * Render a single logo item.
	 *
	 * @param array $item  Repeater item.
	 * @param int   $index Item index.
	 */
	private function render_logo_item( $item, $index ) {
		$image_url = ! empty( $item['image']['url'] ) ? $item['image']['url'] : '';

		if ( '' === $image_url ) {
			return;
		}

		$alt  = ! empty( $item['alt'] ) ? $item['alt'] : '';
		$link = ! empty( $item['link']['url'] ) ? $item['link']['url'] : '';

		$item_key = 'logo_item_' . $this->get_id() . '_' . $index;
		$this->add_render_attribute( $item_key, 'class', 'yadakshop-logo-loop__item' );
		$this->add_render_attribute( $item_key, 'role', 'listitem' );
		?>
		<li <?php $this->print_render_attribute_string( $item_key ); ?>>
			<?php if ( $link ) : ?>
				<?php
				$link_key = 'logo_link_' . $this->get_id() . '_' . $index;
				$this->add_link_attributes( $link_key, $item['link'] );
				$this->add_render_attribute( $link_key, 'class', 'yadakshop-logo-loop__link' );
				if ( empty( $item['link']['is_external'] ) ) {
					$this->add_render_attribute( $link_key, 'target', '_self' );
				}
				?>
				<a <?php $this->print_render_attribute_string( $link_key ); ?> aria-label="<?php echo esc_attr( $alt ); ?>">
					<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>" loading="lazy" decoding="async" draggable="false" />
				</a>
			<?php else : ?>
				<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>" loading="lazy" decoding="async" draggable="false" />
			<?php endif; ?>
		</li>
		<?php
	}
}
