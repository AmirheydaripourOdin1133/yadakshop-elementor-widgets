<?php
/**
 * Services Grid Elementor widget.
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
 * Staggered services grid widget.
 */
class Yadakshop_Services_Grid extends Widget_Base {

	/**
	 * Widget slug.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'yadakshop-services-grid';
	}

	/**
	 * Widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'خدمات یدک شاپ (Grid)', 'yadakshop' );
	}

	/**
	 * Widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-gallery-grid';
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
		return array( 'services', 'grid', 'visa', 'yadakshop' );
	}

	/**
	 * Style dependencies.
	 *
	 * @return array
	 */
	public function get_style_depends() {
		return array( 'yadakshop-services-grid' );
	}

	/**
	 * Register widget controls.
	 */
	protected function register_controls() {
		$this->register_content_controls();
		$this->register_layout_controls();
	}

	/**
	 * Content controls.
	 */
	private function register_content_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'محتوا', 'yadakshop' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_image',
			array(
				'label' => esc_html__( 'تصویر', 'yadakshop' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);

		$repeater->add_control(
			'item_title',
			array(
				'label'       => esc_html__( 'عنوان', 'yadakshop' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'ویزای تحصیلی', 'yadakshop' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'item_description',
			array(
				'label'   => esc_html__( 'توضیحات کوتاه', 'yadakshop' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'مشاوره و پیگیری پرونده از انتخاب مقصد تا دریافت ویزا.', 'yadakshop' ),
				'rows'    => 3,
			)
		);

		$repeater->add_control(
			'item_link',
			array(
				'label'       => esc_html__( 'لینک', 'yadakshop' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://example.com', 'yadakshop' ),
				'default'     => array(
					'url' => '',
				),
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
						'item_title'       => esc_html__( 'ویزای خانوادگی', 'yadakshop' ),
						'item_description' => esc_html__( 'پیوستن اعضای خانواده به متقاضی اصلی با شرایط قانونی.', 'yadakshop' ),
					),
					array(
						'item_title'       => esc_html__( 'ویزای سرمایه‌گذاری', 'yadakshop' ),
						'item_description' => esc_html__( 'مهاجرت از طریق سرمایه‌گذاری در کشورهای مقصد.', 'yadakshop' ),
					),
					array(
						'item_title'       => esc_html__( 'ویزای تحصیلی', 'yadakshop' ),
						'item_description' => esc_html__( 'تحصیل در دانشگاه‌های معتبر جهان با پشتیبانی کامل.', 'yadakshop' ),
					),
					array(
						'item_title'       => esc_html__( 'ویزای کاری', 'yadakshop' ),
						'item_description' => esc_html__( 'اخذ جاب‌آفر و ویزای کار در کشورهای مختلف.', 'yadakshop' ),
					),
				),
				'title_field' => '{{{ item_title }}}',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Layout controls.
	 */
	private function register_layout_controls() {
		$this->start_controls_section(
			'section_layout',
			array(
				'label' => esc_html__( 'چیدمان', 'yadakshop' ),
			)
		);

		$this->add_control(
			'desktop_columns',
			array(
				'label'   => esc_html__( 'تعداد ستون (دسکتاپ)', 'yadakshop' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
				'options' => array(
					'4' => esc_html__( '۴ ستون', 'yadakshop' ),
					'5' => esc_html__( '۵ ستون', 'yadakshop' ),
					'6' => esc_html__( '۶ ستون', 'yadakshop' ),
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Whether item has a valid link.
	 *
	 * @param array|null $link Link control value.
	 * @return bool
	 */
	private function has_link( $link ) {
		return ! empty( $link ) && ! empty( $link['url'] );
	}

	/**
	 * Render item image.
	 *
	 * @param array      $image Image control value.
	 * @param string     $title Item title for alt fallback.
	 * @param int        $index Item index.
	 * @param array|null $link  Optional link.
	 */
	private function render_item_image( $image, $title, $index, $link = null ) {
		if ( empty( $image['url'] ) ) {
			return;
		}

		$alt = ! empty( $image['alt'] ) ? $image['alt'] : $title;
		$img = '';

		if ( ! empty( $image['id'] ) ) {
			$img = wp_get_attachment_image(
				$image['id'],
				'large',
				false,
				array(
					'class'   => 'yadakshop-sg__image',
					'alt'     => $alt,
					'loading' => 'lazy',
				)
			);
		} else {
			$img = sprintf(
				'<img class="yadakshop-sg__image" src="%1$s" alt="%2$s" loading="lazy">',
				esc_url( $image['url'] ),
				esc_attr( $alt )
			);
		}

		if ( $this->has_link( $link ) ) {
			$link_key = 'media_link_' . $index;
			$this->add_link_attributes( $link_key, $link );
			$this->add_render_attribute( $link_key, 'class', 'yadakshop-sg__media-link' );
			printf(
				'<a %1$s>%2$s</a>',
				$this->get_render_attribute_string( $link_key ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				$img // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
			return;
		}

		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $img;
	}

	/**
	 * Render a single grid item.
	 *
	 * @param array $item   Repeater item.
	 * @param int   $index  Item index.
	 */
	private function render_item( $item, $index ) {
		$title       = isset( $item['item_title'] ) ? trim( $item['item_title'] ) : '';
		$description = isset( $item['item_description'] ) ? trim( $item['item_description'] ) : '';
		$image       = ! empty( $item['item_image'] ) ? $item['item_image'] : null;
		$link        = ! empty( $item['item_link'] ) ? $item['item_link'] : null;

		if ( '' === $title && '' === $description && empty( $image['url'] ) ) {
			return;
		}

		$item_key = 'item_' . $index;
		$this->add_render_attribute( $item_key, 'class', 'yadakshop-sg__item' );
		?>
		<article <?php $this->print_render_attribute_string( $item_key ); ?>>
			<div class="yadakshop-sg__card">
				<?php if ( ! empty( $image['url'] ) ) : ?>
					<div class="yadakshop-sg__media">
						<?php $this->render_item_image( $image, $title, $index, $link ); ?>
					</div>
				<?php endif; ?>

				<div class="yadakshop-sg__body">
					<?php if ( '' !== $title ) : ?>
						<?php if ( $this->has_link( $link ) ) : ?>
							<?php
							$title_link_key = 'title_link_' . $index;
							$this->add_link_attributes( $title_link_key, $link );
							$this->add_render_attribute( $title_link_key, 'class', 'yadakshop-sg__title-link' );
							?>
							<h3 class="yadakshop-sg__title">
								<a <?php $this->print_render_attribute_string( $title_link_key ); ?>>
									<?php echo esc_html( $title ); ?>
								</a>
							</h3>
						<?php else : ?>
							<h3 class="yadakshop-sg__title"><?php echo esc_html( $title ); ?></h3>
						<?php endif; ?>
					<?php endif; ?>

					<?php if ( '' !== $description ) : ?>
						<p class="yadakshop-sg__desc"><?php echo esc_html( $description ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</article>
		<?php
	}

	/**
	 * Render widget output.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$items    = ! empty( $settings['items'] ) && is_array( $settings['items'] ) ? $settings['items'] : array();

		if ( empty( $items ) ) {
			return;
		}

		$columns = isset( $settings['desktop_columns'] ) ? (int) $settings['desktop_columns'] : 4;
		$columns = max( 4, min( 6, $columns ) );

		$this->add_render_attribute(
			'wrapper',
			'class',
			array(
				'yadakshop-services-grid',
				'mainView',
			)
		);

		$this->add_render_attribute(
			'grid',
			'class',
			'yadakshop-sg__grid'
		);

		$this->add_render_attribute(
			'grid',
			'style',
			sprintf( '--yadakshop-sg-cols:%d;', $columns )
		);
		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<div <?php $this->print_render_attribute_string( 'grid' ); ?>>
				<?php
				foreach ( $items as $index => $item ) {
					$this->render_item( $item, $index );
				}
				?>
			</div>
		</div>
		<?php
	}
}