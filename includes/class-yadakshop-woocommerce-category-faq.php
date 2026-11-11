<?php
/**
 * WooCommerce Product Category FAQ.
 *
 * Adds a FAQ meta box to product category edit pages and displays FAQ
 * on product category archive pages (after the category description).
 *
 * @package Yadakshop
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;

class Yadakshop_Woocommerce_Category_Faq {

	/**
	 * Meta key used to store FAQ data on the term.
	 */
	const META_KEY = 'yadakshop_cat_faq';

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'product_cat_add_form_fields', array( $this, 'add_faq_meta_box' ), 10, 1 );
		add_action( 'product_cat_edit_form_fields', array( $this, 'add_faq_meta_box' ), 10, 1 );
		add_action( 'edited_product_cat', array( $this, 'save_faq_meta' ), 10, 1 );
		add_action( 'create_product_cat', array( $this, 'save_faq_meta' ), 10, 1 );
		add_action( 'woocommerce_archive_description', array( $this, 'render_category_faq' ), 15 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
	}

	/**
	 * Add FAQ meta box to add/edit product category forms.
	 *
	 * @param WP_Term $category The term object.
	 */
	public function add_faq_meta_box( $category ) {
		$faqs = get_term_meta( $category->term_id, self::META_KEY, true );
		if ( ! is_array( $faqs ) ) {
			$faqs = array();
		}
		?>
		<tr class="form-field yadakshop-cat-faq-box">
			<th scope="row" valign="top"><?php esc_html_e('سئوالات متداول (FAQ) دسته‌بندی', 'yadakshop'); ?></th>
			<td>
				<p><?php esc_html_e('پرسش و پاسخ مربوط به این دسته‌بندی محصولات را وارد کنید. این موارد در صفحه آرشیو دسته‌بندی نمایش داده می‌شوند.', 'yadakshop'); ?></p>
				<table class="yadakshop-cat-faq-table" width="100%">
					<thead>
						<tr>
							<th style="width:40%;"><?php esc_html_e('سوال', 'yadakshop'); ?></th>
							<th style="width:55%;"><?php esc_html_e('پاسخ', 'yadakshop'); ?></th>
							<th style="width:5%;"><?php esc_html_e('حذف', 'yadakshop'); ?></th>
						</tr>
					</thead>
					<tbody id="yadakshop-cat-faq-items">
						<?php if ( ! empty( $faqs ) ) : $i = 0; foreach ( $faqs as $faq ) : $i++; ?>
							<tr class="yadakshop-cat-faq-row">
								<td><input type="text" name="yadakshop_cat_faq[<?php echo esc_attr( $i ); ?>][question]" value="<?php echo esc_attr( $faq['question'] ?? '' ); ?>" class="widefat" placeholder="<?php esc_attr_e('متن سوال...', 'yadakshop'); ?>"></td>
								<td><textarea name="yadakshop_cat_faq[<?php echo esc_attr( $i ); ?>][answer]" class="widefat" rows="3" placeholder="<?php esc_attr_e('متن پاسخ...', 'yadakshop'); ?>"><?php echo esc_textarea( $faq['answer'] ?? '' ); ?></textarea></td>
								<td><a href="#" class="yadakshop-remove-row button-link"><?php esc_html_e('×', 'yadakshop'); ?></a></td>
							</tr>
						<?php endforeach; else: ?>
							<tr class="yadakshop-cat-faq-row">
								<td><input type="text" name="yadakshop_cat_faq[0][question]" class="widefat" placeholder="<?php esc_attr_e('متن سوال...', 'yadakshop'); ?>"></td>
								<td><textarea name="yadakshop_cat_faq[0][answer]" class="widefat" rows="3" placeholder="<?php esc_attr_e('متن پاسخ...', 'yadakshop'); ?>"></textarea></td>
								<td><a href="#" class="yadakshop-remove-row button-link"><?php esc_html_e('×', 'yadakshop'); ?></a></td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
				<p><a href="#" id="yadakshop-add-cat-faq" class="button"><?php esc_html_e('افزودن سوال و پاسخ جدید', 'yadakshop'); ?></a></p>
				<script type="text/html" id="yadakshop-cat-faq-tmpl">
					<tr class="yadakshop-cat-faq-row">
						<td><input type="text" name="yadakshop_cat_faq[__index__][question]" class="widefat" placeholder="<?php esc_attr_e('متن سوال...', 'yadakshop'); ?>"></td>
						<td><textarea name="yadakshop_cat_faq[__index__][answer]" class="widefat" rows="3" placeholder="<?php esc_attr_e('متن پاسخ...', 'yadakshop'); ?>"></textarea></td>
						<td><a href="#" class="yadakshop-remove-row button-link"><?php esc_html_e('×', 'yadakshop'); ?></a></td>
					</tr>
				</script>
				<script>
				jQuery(document).ready(function($) {
					var faqIndex = $('#yadakshop-cat-faq-items tr.yadakshop-cat-faq-row').length;
					$('#yadakshop-add-cat-faq').on('click', function(e) {
						e.preventDefault();
						var newRow = $('#yadakshop-cat-faq-tmpl').html().replace(/__index__/g, faqIndex++);
						$('#yadakshop-cat-faq-items').append(newRow);
					});
					$('#yadakshop-cat-faq-items').on('click', '.yadakshop-remove-row', function(e) {
						e.preventDefault();
						$(this).closest('tr.yadakshop-cat-faq-row').remove();
					});
				});
				</script>
			</td>
		</tr>
		<?php
	}

	/**
	 * Save FAQ meta when category is created/edited.
	 *
	 * @param int $term_id Term ID.
	 */
	public function save_faq_meta( $term_id ) {
		if ( ! isset( $_POST['yadakshop_cat_faq'] ) ) {
			return;
		}

		$raw = $_POST['yadakshop_cat_faq'];
		if ( ! is_array( $raw ) ) {
			return;
		}

		$clean = array();
		foreach ( $raw as $faq ) {
			$question = ! empty( $faq['question'] ) ? trim( $faq['question'] ) : '';
			$answer   = ! empty( $faq['answer'] )   ? trim( $faq['answer'] )   : '';
			if ( '' === $question && '' === $answer ) {
				continue;
			}
			$clean[] = array(
				'question' => sanitize_text_field( $question ),
				'answer'   => wp_kses_post( $answer ),
			);
		}

		update_term_meta( $term_id, self::META_KEY, $clean );
	}

	/**
	 * Render FAQ after category description on archive pages.
	 */
	public function render_category_faq() {
		if ( ! is_product_category() ) {
			return;
		}

		$category = get_queried_object();
		if ( ! $category ) {
			return;
		}

		$faqs = get_term_meta( $category->term_id, self::META_KEY, true );
		if ( ! is_array( $faqs ) || empty( $faqs ) ) {
			return;
		}

		?>
		<div class="yadakshop-cat-faq-section">
			<h3 class="yadakshop-cat-faq-title"><?php esc_html_e('سئوالات متداول', 'yadakshop'); ?></h3>
			<div class="yadakshop-cat-faqs">
				<?php $i = 0; foreach ( $faqs as $faq ) : $i++; ?>
					<div class="yadakshop-cat-faq-item">
						<div class="yadakshop-cat-faq-question" tabindex="0" role="button" aria-expanded="false">
							<span class="yadakshop-cat-faq-num"><?php echo esc_html( (string) $i ); ?></span>
							<?php echo wp_kses_post( $faq['question'] ); ?>
							<div class="yadakshop-cat-faq-icon">
								<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="m4 8.417 6.587 6.587a2.013 2.013 0 0 0 2.826 0L20 8.417" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
								</svg>
							</div>
						</div>
						<div class="yadakshop-cat-faq-answer">
							<?php echo wp_kses_post( $faq['answer'] ); ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}

	/**
	 * Enqueue CSS for category FAQ.
	 */
	public function enqueue_assets() {
		if ( ! is_product_category() ) {
			return;
		}
		wp_enqueue_style( 'yadakshop-cat-faq', YADAKSHOP_PLUGIN_URL . 'assets/css/yadakshop-cat-faq.css', array(), YADAKSHOP_VERSION );
		wp_enqueue_script( 'jquery' );
	}
}
