<?php
/**
 * FAQ Widget.
 *
 * @package Yadakshop
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Yadakshop_Faq extends Widget_Base {

	public function get_name() {
		return 'yadakshop-faq';
	}

	public function get_title() {
		return esc_html__( 'سئوالات متداول (FAQ)', 'yadakshop' );
	}

	public function get_icon() {
		return 'eicon-accordion';
	}

	public function get_categories() {
		return array( 'yadakshop' );
	}

	public function get_keywords() {
		return array( 'faq', 'accordion', 'questions', 'yadakshop' );
	}

	public function get_style_depends() {
		return array( 'yadakshop-faq' );
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
			'section_faq_content',
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
				'default'     => esc_html__( 'سئوالات متداول', 'yadakshop' ),
				'placeholder' => esc_html__( 'سئوالات متداول', 'yadakshop' ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => esc_html__( 'توضیحات', 'yadakshop' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'پاسخ به سوالات متداول مشتریان', 'yadakshop' ),
				'placeholder' => esc_html__( 'توضیحات...', 'yadakshop' ),
				'show_label'  => false,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'question',
			array(
				'label'       => esc_html__( 'سوال', 'yadakshop' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'سوال شما چیست؟', 'yadakshop' ),
				'placeholder' => esc_html__( 'متن سوال...', 'yadakshop' ),
			)
		);

		$repeater->add_control(
			'answer',
			array(
				'label'       => esc_html__( 'پاسخ', 'yadakshop' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'پاسخ شما اینجا قرار می‌گیرد.', 'yadakshop' ),
				'placeholder' => esc_html__( 'متن پاسخ...', 'yadakshop' ),
				'show_label'  => false,
			)
		);

		$this->add_control(
			'faqs',
			array(
				'label'       => esc_html__( 'لیست سئوالات و پاسخ‌ها', 'yadakshop' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'question' => esc_html__( 'سوال نمونه اول', 'yadakshop' ),
						'answer'   => esc_html__( 'پاسخ نمونه اول', 'yadakshop' ),
					),
					array(
						'question' => esc_html__( 'سوال نمونه دوم', 'yadakshop' ),
						'answer'   => esc_html__( 'پاسخ نمونه دوم', 'yadakshop' ),
					),
				),
				'title_field' => '{{{ question }}}',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Style controls.
	 */
	private function register_style_controls() {
		$this->start_controls_section(
			'section_faq_style',
			array(
				'label' => esc_html__( 'سبک‌بندی', 'yadakshop' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'background_color',
			array(
				'label'     => esc_html__( 'رنگ بک‌گراند آیتم‌ها', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-faqs-item' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => esc_html__( 'رنگ متن', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2c2e2f',
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-faqs-item' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'accent_color',
			array(
				'label'     => esc_html__( 'رنگ accents (آیکون و شماره)', 'yadakshop' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .yadakshop-faqs-question .yadakshop-parent-svgs svg' => 'stroke: {{VALUE}};',
					'{{WRAPPER}} .yadakshop-faqs-item.active .yadakshop-faqs-question' => 'color: {{VALUE}};',
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

		$title      = ! empty( $settings['title'] ) ? $settings['title'] : '';
		$description = ! empty( $settings['description'] ) ? $settings['description'] : '';
		$faqs       = ! empty( $settings['faqs'] ) ? $settings['faqs'] : array();

		if ( empty( $faqs ) && empty( $title ) && empty( $description ) ) {
			return;
		}

		$this->add_render_attribute( 'wrapper', 'class', 'yadakshop-faq faqSection mainView mgBot' );
		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<div class="yadakshop-faqs-content">
				<?php if ( $title || $description ) : ?>
					<div class="yadakshop-headings-section mainView">
						<?php if ( $title ) : ?>
							<h3 class="yadakshop-title-cus-theme"><?php echo wp_kses_post( $title ); ?></h3>
						<?php endif; ?>

						<?php if ( $description ) : ?>
							<p class="yadakshop-subs-title-cus-theme"><?php echo wp_kses_post( $description ); ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if ( is_array( $faqs ) && $faqs ) : ?>
					<?php $faq_number = 0; ?>
					<?php foreach ( $faqs as $faq ) : ?>
						<?php
						if ( ! is_array( $faq ) ) {
							continue;
						}

						++$faq_number;
						$question = ! empty( $faq['question'] ) ? $faq['question'] : '';
						$answer   = ! empty( $faq['answer'] ) ? $faq['answer'] : '';
						?>
						<div class="yadakshop-faqs-item">
							<div class="yadakshop-faqs-question accordion" tabindex="0" role="button" aria-expanded="false">
								<span class="yadakshop-faq-num"><?php echo esc_html( (string) $faq_number ); ?></span>
								<?php echo wp_kses_post( $question ); ?>
								<div class="yadakshop-parent-svgs">
									<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="m4 8.417 6.587 6.587a2.013 2.013 0 0 0 2.826 0L20 8.417" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
								</div>
							</div>
							<div class="yadakshop-faqs-answer accordion-content">
								<div class="yadakshop-editor-content main-content">
									<?php echo wp_kses_post( $answer ); ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>

			<?php if ( is_array( $faqs ) && $faqs ) : ?>
				<script type="application/ld+json">
				{
					"@context": "https://schema.org",
					"@type": "FAQPage",
					"mainEntity": [
						<?php
						$faq_number = 0;
						$first = true;
						foreach ( $faqs as $faq ) :
							if ( ! is_array( $faq ) ) {
								continue;
							}
							++$faq_number;
							if ( ! $first ) {
								echo ',';
							}
							$first = false;
							$q = esc_html( $faq['question'] ?? '' );
							$a = esc_html( $faq['answer'] ?? '' );
							?>
							{
								"@type": "Question",
								"name": "<?php echo $q; ?>",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "<?php echo $a; ?>"
								}
							}
						<?php endforeach; ?>
					]
				}
				</script>
			<?php endif; ?>
		</div>

		<script>
		(function() {
			var accordionClickHandler = function(e) {
				var item = e.target.closest('.yadakshop-faqs-question');
				if (!item) return;

				var wrapper = item.closest('.yadakshop-faq');
				if (!wrapper) return;

				var parent = item.closest('.yadakshop-faqs-item');
				var isActive = parent.classList.contains('active');

				wrapper.querySelectorAll('.yadakshop-faqs-item.active').forEach(function(el) {
					if (el !== parent) {
						el.classList.remove('active');
						var btn = el.querySelector('.yadakshop-faqs-question');
						if (btn) btn.setAttribute('aria-expanded', 'false');
					}
				});

				if (isActive) {
					parent.classList.remove('active');
					item.setAttribute('aria-expanded', 'false');
				} else {
					parent.classList.add('active');
					item.setAttribute('aria-expanded', 'true');
				}
			};

			var accordionKeyHandler = function(e) {
				if (e.key === 'Enter' || e.key === ' ') {
					var item = e.target.closest('.yadakshop-faqs-question');
					if (item) {
						e.preventDefault();
						item.click();
					}
				}
			};

			document.addEventListener('click', accordionClickHandler);
			document.addEventListener('keydown', accordionKeyHandler);
		})();
		</script>
		<?php
	}
}
