<?php
/**
 * Immigration Methods Elementor widget.
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
 * Immigration methods hub widget.
 */
class Yadakshop_Immigration_Methods extends Widget_Base {

	/**
	 * Widget slug.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'yadakshop-immigration-methods';
	}

	/**
	 * Widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'روش‌های مهاجرت یدک شاپ', 'yadakshop' );
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
		return array( 'immigration', 'visa', 'methods', 'yadakshop' );
	}

	/**
	 * Style dependencies.
	 *
	 * @return array
	 */
	public function get_style_depends() {
		return array( 'yadakshop-immigration-methods' );
	}

	/**
	 * Register widget controls.
	 */
	protected function register_controls() {
		$this->register_content_controls();
		$this->register_style_controls();
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

		$this->add_control(
			'center_image',
			array(
				'label' => esc_html__( 'تصویر مرکزی', 'yadakshop' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_side',
			array(
				'label'   => esc_html__( 'موقعیت', 'yadakshop' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'start',
				'options' => array(
					'start' => esc_html__( 'سمت راست', 'yadakshop' ),
					'end'   => esc_html__( 'سمت چپ', 'yadakshop' ),
				),
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
				'default' => esc_html__( 'مشاوره و پیگیری پرونده تحصیلی از انتخاب مقصد تا دریافت ویزا.', 'yadakshop' ),
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
					'url' => '#',
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
						'item_side'        => 'start',
						'item_title'       => esc_html__( 'ویزای تحصیلی', 'yadakshop' ),
						'item_description' => esc_html__( 'تحصیل در دانشگاه‌های معتبر جهان', 'yadakshop' ),
					),
					array(
						'item_side'        => 'start',
						'item_title'       => esc_html__( 'ویزای کاری', 'yadakshop' ),
						'item_description' => esc_html__( 'اخذ جاب‌آفر و ویزای کار', 'yadakshop' ),
					),
					array(
						'item_side'        => 'start',
						'item_title'       => esc_html__( 'سرمایه‌گذاری', 'yadakshop' ),
						'item_description' => esc_html__( 'مهاجرت از طریق سرمایه‌گذاری', 'yadakshop' ),
					),
					array(
						'item_side'        => 'start',
						'item_title'       => esc_html__( 'ثبت شرکت', 'yadakshop' ),
						'item_description' => esc_html__( 'راه‌اندازی کسب‌وکار در خارج', 'yadakshop' ),
					),
					array(
						'item_side'        => 'start',
						'item_title'       => esc_html__( 'جاب‌آفر', 'yadakshop' ),
						'item_description' => esc_html__( 'دریافت پیشنهاد شغلی معتبر', 'yadakshop' ),
					),
					array(
						'item_side'        => 'end',
						'item_title'       => esc_html__( 'اقامت دائم', 'yadakshop' ),
						'item_description' => esc_html__( 'اخذ اقامت دائم کشور مقصد', 'yadakshop' ),
					),
					array(
						'item_side'        => 'end',
						'item_title'       => esc_html__( 'اخذ تابعیت', 'yadakshop' ),
						'item_description' => esc_html__( 'دریافت پاسپورت پس از اقامت قانونی', 'yadakshop' ),
					),
					array(
						'item_side'        => 'end',
						'item_title'       => esc_html__( 'ویزای خانوادگی', 'yadakshop' ),
						'item_description' => esc_html__( 'پیوستن اعضای خانواده', 'yadakshop' ),
					),
					array(
						'item_side'        => 'end',
						'item_title'       => esc_html__( 'استارت‌آپ', 'yadakshop' ),
						'item_description' => esc_html__( 'مهاجرت با طرح کسب‌وکار نوآورانه', 'yadakshop' ),
					),
					array(
						'item_side'        => 'end',
						'item_title'       => esc_html__( 'ویزای توریستی', 'yadakshop' ),
						'item_description' => esc_html__( 'سفر کوتاه‌مدت و گردشگری', 'yadakshop' ),
					),
				),
				'title_field' => '{{{ item_title }}}',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Style controls.
	 */
	private function register_style_controls() {
		$this->start_controls_section(
			'section_style',
			array(
				'label' => esc_html__( 'رنگ‌ها', 'yadakshop' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'box_bg_color',
			array(
				'label'     => esc_html__( 'رنگ پس‌زمینه باکس', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-im__card' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'رنگ عنوان', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000001',
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-im__card-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => esc_html__( 'رنگ توضیحات', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#9D9C9C',
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-im__card-desc' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_color',
			array(
				'label'     => esc_html__( 'رنگ دکمه', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#12223C',
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-im__card-action' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Card action icon SVG markup.
	 *
	 * @return string
	 */
	private function get_card_icon_svg() {
		$path = YADAKSHOP_PLUGIN_DIR . '/assets/icons/boxcustomsvg.svg';

		if ( ! file_exists( $path ) ) {
			return '';
		}

		// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
		$svg = file_get_contents( $path );

		if ( empty( $svg ) ) {
			return '';
		}

		return $svg;
	}

	/**
	 * Split items by column side.
	 *
	 * @param array $items Repeater items.
	 * @return array
	 */
	private function split_items_by_side( $items ) {
		$columns = array(
			'start' => array(),
			'end'   => array(),
		);

		if ( empty( $items ) || ! is_array( $items ) ) {
			return $columns;
		}

		foreach ( $items as $index => $item ) {
			$side = ( isset( $item['item_side'] ) && 'end' === $item['item_side'] ) ? 'end' : 'start';

			if ( empty( $item['item_title'] ) && empty( $item['item_description'] ) ) {
				continue;
			}

			$item['_index'] = $index;
			$columns[ $side ][] = $item;
		}

		return $columns;
	}

	/**
	 * Render widget output.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$columns  = $this->split_items_by_side( $settings['items'] );
		$image    = ! empty( $settings['center_image']['url'] ) ? $settings['center_image'] : null;

		if ( empty( $columns['start'] ) && empty( $columns['end'] ) && empty( $image ) ) {
			return;
		}

		$layout_classes = array( 'yadakshop-im__layout' );
		if ( ! $image ) {
			$layout_classes[] = 'yadakshop-im__layout--no-image';
		}

		$this->add_render_attribute( 'wrapper', 'class', 'yadakshop-immigration-methods mainView' );
		$this->add_render_attribute( 'layout', 'class', $layout_classes );
		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<div <?php $this->print_render_attribute_string( 'layout' ); ?>>
				<div class="yadakshop-im__col yadakshop-im__col--start">
					<?php
					$start_total = count( $columns['start'] );
					foreach ( $columns['start'] as $position => $item ) {
						$this->render_card( $item, 'start', $position + 1, $start_total );
					}
					?>
				</div>

				<?php if ( $image ) : ?>
					<div class="yadakshop-im__media">
						<?php
						if ( ! empty( $image['id'] ) ) {
							echo wp_get_attachment_image(
								$image['id'],
								'full',
								false,
								array(
									'class'   => 'yadakshop-im__image',
									'alt'     => ! empty( $image['alt'] ) ? $image['alt'] : '',
									'loading' => 'lazy',
								)
							);
						} else {
							?>
							<img class="yadakshop-im__image" src="<?php echo esc_url( $image['url'] ); ?>"
								alt="<?php echo esc_attr( ! empty( $image['alt'] ) ? $image['alt'] : '' ); ?>" loading="lazy">
							<?php
						}
						?>
					</div>
				<?php endif; ?>

				<div class="yadakshop-im__col yadakshop-im__col--end">
					<?php
					$end_total = count( $columns['end'] );
					foreach ( $columns['end'] as $position => $item ) {
						$this->render_card( $item, 'end', $position + 1, $end_total );
					}
					?>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Calculate arc offset toward center image.
	 *
	 * @param int $position 1-based position in column.
	 * @param int $total    Total items in column.
	 * @return int
	 */
	private function get_arc_offset( $position, $total ) {
		if ( $total <= 1 ) {
			return 0;
		}

		$max_offset  = 100;
		$normalized  = ( $position - 1 ) / ( $total - 1 );
		$dist_center = abs( $normalized - 0.5 ) * 2;

		// Edge items closer to globe, middle item further out — ( image ) curve.
		return (int) round( $max_offset * $dist_center );
	}

	/**
	 * Render a single card item.
	 *
	 * @param array  $item Card data.
	 * @param string $side Column side slug.
	 * @param int    $position Item position within the column (1-based).
	 * @param int    $total Total items in the column.
	 */
	private function render_card( $item, $side, $position = 1, $total = 1 ) {
		$title       = isset( $item['item_title'] ) ? trim( $item['item_title'] ) : '';
		$description = isset( $item['item_description'] ) ? trim( $item['item_description'] ) : '';
		$link        = ! empty( $item['item_link']['url'] ) ? $item['item_link'] : null;
		$index       = isset( $item['_index'] ) ? (int) $item['_index'] : 0;
		$icon_svg    = $this->get_card_icon_svg();

		if ( '' === $title && '' === $description ) {
			return;
		}

		$card_key = 'card_' . $side . '_' . $index;
		$arc_offset = $this->get_arc_offset( $position, $total );
		$arc_x      = ( 'start' === $side ) ? -$arc_offset : $arc_offset;

		$this->add_render_attribute(
			$card_key,
			'class',
			array(
				'yadakshop-im__card',
				'yadakshop-im__card--' . $side,
				'yadakshop-im__card--pos-' . $position,
			)
		);
		$this->add_render_attribute(
			$card_key,
			'style',
			sprintf(
				'--yadakshop-im-arc-x:%dpx;--yadakshop-im-arc-offset:%dpx;',
				$arc_x,
				$arc_offset
			)
		);
		?>
		<article <?php $this->print_render_attribute_string( $card_key ); ?>>
			<div class="yadakshop-im__card-inner">
				<div class="yadakshop-im__card-content">
<?php if ( '' !== $title ) : ?>
    <h3 class="yadakshop-im__card-title">
        <?php if ( $link ) : ?>
            <?php
            $title_link_key = 'title_link_' . $side . '_' . $index;
            $this->add_link_attributes( $title_link_key, $link );
            $this->add_render_attribute( $title_link_key, 'class', 'yadakshop-im__card-title-link' );
            ?>
            <a <?php $this->print_render_attribute_string( $title_link_key ); ?>>
                <?php echo esc_html( $title ); ?>
            </a>
        <?php else : ?>
            <?php echo esc_html( $title ); ?>
        <?php endif; ?>
    </h3>
<?php endif; ?>

					<?php if ( '' !== $description ) : ?>
						<p class="yadakshop-im__card-desc"><?php echo esc_html( $description ); ?></p>
					<?php endif; ?>
				</div>

				<?php if ( $link && '' !== $icon_svg ) : ?>
					<?php
					$link_key = 'link_' . $side . '_' . $index;
					$this->add_link_attributes( $link_key, $link );
					$this->add_render_attribute( $link_key, 'class', 'yadakshop-im__card-action' );
					$this->add_render_attribute( $link_key, 'aria-label', $title ? $title : esc_html__( 'مشاهده بیشتر', 'yadakshop' ) );
					?>
					<a <?php $this->print_render_attribute_string( $link_key ); ?>>
						<span class="yadakshop-im__card-action-icon" aria-hidden="true"><?php echo $icon_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					</a>
				<?php elseif ( '' !== $icon_svg ) : ?>
					<span class="yadakshop-im__card-action yadakshop-im__card-action--static" aria-hidden="true">
						<span class="yadakshop-im__card-action-icon"><?php echo $icon_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					</span>
				<?php endif; ?>
			</div>
		</article>
		<?php
	}
}