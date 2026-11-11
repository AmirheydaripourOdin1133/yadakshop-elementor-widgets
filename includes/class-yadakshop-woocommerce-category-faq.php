<?php
/**
 * WooCommerce product-category FAQ integration.
 *
 * @package Yadakshop
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Yadakshop_Woocommerce_Category_Faq {

	const META_KEY = 'yadakshop_cat_faq';

	public function __construct() {
		add_action( 'product_cat_add_form_fields', array( $this, 'render_add_fields' ) );
		add_action( 'product_cat_edit_form_fields', array( $this, 'render_edit_fields' ) );
		add_action( 'created_product_cat', array( $this, 'save' ) );
		add_action( 'edited_product_cat', array( $this, 'save' ) );
		add_action( 'woocommerce_archive_description', array( $this, 'render_archive' ), 20 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend' ) );
	}

	/** Render fields on the Add category screen. */
	public function render_add_fields() {
		$this->render_fields( 0, false );
	}

	/** Render fields on the Edit category screen. */
	public function render_edit_fields( $term ) {
		$this->render_fields( (int) $term->term_id, true );
	}

	/**
	 * Render the repeater form.
	 *
	 * @param int  $term_id Term ID.
	 * @param bool $edit    Whether this is the edit form.
	 */
	private function render_fields( $term_id, $edit ) {
		$faqs = $term_id ? get_term_meta( $term_id, self::META_KEY, true ) : array();
		$faqs = is_array( $faqs ) ? $faqs : array();
		$rows = $faqs ? array_values( $faqs ) : array( array( 'question' => '', 'answer' => '' ) );
		$nonce = wp_create_nonce( 'yadakshop_category_faq' );
		$tag_open = $edit ? '<tr class="form-field"><th scope="row"><label>' . esc_html__( 'سئوالات متداول دسته‌بندی', 'yadakshop' ) . '</label></th><td>' : '<div class="form-field yadakshop-cat-faq-box"><label>' . esc_html__( 'سئوالات متداول دسته‌بندی', 'yadakshop' ) . '</label><p>';
		$tag_close = $edit ? '</td></tr>' : '</div>';
		?>
		<?php echo $tag_open; ?>
		<?php if ( ! $edit ) : ?>
			<?php esc_html_e( 'پرسش و پاسخ‌ها را وارد کنید؛ در آرشیو این دسته، بعد از توضیحات نمایش داده می‌شوند.', 'yadakshop' ); ?></p>
		<?php else : ?>
			<p class="description"><?php esc_html_e( 'پرسش و پاسخ‌ها بعد از توضیحات دسته‌بندی نمایش داده می‌شوند.', 'yadakshop' ); ?></p>
		<?php endif; ?>
		<input type="hidden" name="yadakshop_category_faq_nonce" value="<?php echo esc_attr( $nonce ); ?>">
		<table class="widefat yadakshop-cat-faq-table">
			<thead><tr><th><?php esc_html_e( 'سوال', 'yadakshop' ); ?></th><th><?php esc_html_e( 'پاسخ', 'yadakshop' ); ?></th><th></th></tr></thead>
			<tbody id="yadakshop-cat-faq-items">
			<?php foreach ( $rows as $index => $faq ) : ?>
				<?php $this->render_row( $index, $faq ); ?>
			<?php endforeach; ?>
			</tbody>
		</table>
		<p><button type="button" class="button" id="yadakshop-add-cat-faq"><?php esc_html_e( 'افزودن سوال و پاسخ', 'yadakshop' ); ?></button></p>
		<script type="text/html" id="yadakshop-cat-faq-template">
			<?php $this->render_row( '__index__', array() ); ?>
		</script>
		<script>
		jQuery(function($) {
			var index = $('#yadakshop-cat-faq-items .yadakshop-cat-faq-row').length;
			$('#yadakshop-add-cat-faq').on('click', function() {
				$('#yadakshop-cat-faq-items').append($('#yadakshop-cat-faq-template').html().replace(/__index__/g, index++));
			});
			$(document).on('click', '.yadakshop-remove-cat-faq', function(e) {
				e.preventDefault();
				$(this).closest('tr').remove();
			});
		});
		</script>
		<?php echo $tag_close; ?>
		<?php
	}

	/** Render one repeater row. */
	private function render_row( $index, $faq ) {
		$question = isset( $faq['question'] ) ? $faq['question'] : '';
		$answer   = isset( $faq['answer'] ) ? $faq['answer'] : '';
		?>
		<tr class="yadakshop-cat-faq-row">
			<td><input type="text" class="widefat" name="yadakshop_cat_faq[<?php echo esc_attr( $index ); ?>][question]" value="<?php echo esc_attr( $question ); ?>" placeholder="<?php esc_attr_e( 'متن سوال...', 'yadakshop' ); ?>"></td>
			<td><textarea class="widefat" rows="3" name="yadakshop_cat_faq[<?php echo esc_attr( $index ); ?>][answer]" placeholder="<?php esc_attr_e( 'متن پاسخ...', 'yadakshop' ); ?>"><?php echo esc_textarea( $answer ); ?></textarea></td>
			<td><button type="button" class="button-link-delete yadakshop-remove-cat-faq" aria-label="<?php esc_attr_e( 'حذف', 'yadakshop' ); ?>">×</button></td>
		</tr>
		<?php
	}

	/** Save term FAQ data securely. */
	public function save( $term_id ) {
		if ( ! current_user_can( 'manage_product_terms' ) ) {
			return;
		}
		if ( empty( $_POST['yadakshop_category_faq_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['yadakshop_category_faq_nonce'] ) ), 'yadakshop_category_faq' ) ) {
			return;
		}
		$raw = isset( $_POST['yadakshop_cat_faq'] ) && is_array( $_POST['yadakshop_cat_faq'] ) ? wp_unslash( $_POST['yadakshop_cat_faq'] ) : array();
		$clean = array();
		foreach ( $raw as $faq ) {
			$question = isset( $faq['question'] ) ? sanitize_text_field( $faq['question'] ) : '';
			$answer   = isset( $faq['answer'] ) ? wp_kses_post( $faq['answer'] ) : '';
			if ( '' !== trim( $question ) || '' !== trim( wp_strip_all_tags( $answer ) ) ) {
				$clean[] = array( 'question' => $question, 'answer' => $answer );
			}
		}
		if ( $clean ) {
			update_term_meta( $term_id, self::META_KEY, $clean );
		} else {
			delete_term_meta( $term_id, self::META_KEY );
		}
	}

	/** Render FAQ after WooCommerce archive description. */
	public function render_archive() {
		if ( ! is_product_category() ) {
			return;
		}
		$term = get_queried_object();
		$faqs = $term ? get_term_meta( $term->term_id, self::META_KEY, true ) : array();
		$faqs = is_array( $faqs ) ? array_values( $faqs ) : array();
		if ( ! $faqs ) {
			return;
		}
		$schema = array( '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => array() );
		?>
		<section class="yadakshop-cat-faq-section" aria-label="<?php esc_attr_e( 'سئوالات متداول', 'yadakshop' ); ?>">
			<h2 class="yadakshop-cat-faq-title"><?php esc_html_e( 'سئوالات متداول', 'yadakshop' ); ?></h2>
			<div class="yadakshop-cat-faqs">
			<?php foreach ( $faqs as $i => $faq ) : $question = isset( $faq['question'] ) ? $faq['question'] : ''; $answer = isset( $faq['answer'] ) ? $faq['answer'] : ''; $id = 'yadakshop-cat-faq-' . ( $i + 1 ); $schema['mainEntity'][] = array( '@type' => 'Question', 'name' => wp_strip_all_tags( $question ), 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => wp_strip_all_tags( $answer ) ) ); ?>
				<div class="yadakshop-cat-faq-item">
					<button type="button" class="yadakshop-cat-faq-question" aria-expanded="false" aria-controls="<?php echo esc_attr( $id ); ?>"><span><?php echo esc_html( (string) ( $i + 1 ) ); ?></span><?php echo esc_html( $question ); ?><b aria-hidden="true">⌄</b></button>
					<div id="<?php echo esc_attr( $id ); ?>" class="yadakshop-cat-faq-answer" hidden><?php echo wp_kses_post( wpautop( $answer ) ); ?></div>
				</div>
			<?php endforeach; ?>
			</div>
		</section>
		<script type="application/ld+json"><?php echo wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?></script>
		<?php
	}

	/** Enqueue archive styles and a reliable delegated accordion script. */
	public function enqueue_frontend() {
		if ( ! is_product_category() ) {
			return;
		}
		wp_enqueue_style( 'yadakshop-cat-faq', YADAKSHOP_PLUGIN_URL . 'assets/css/yadakshop-cat-faq.css', array(), YADAKSHOP_VERSION );
		wp_enqueue_script( 'jquery' );
		wp_add_inline_script( 'jquery', "jQuery(function($){$(document).on('click','.yadakshop-cat-faq-question',function(){var b=$(this),p=b.closest('.yadakshop-cat-faq-item'),a=p.find('.yadakshop-cat-faq-answer'),open=b.attr('aria-expanded')==='true';$('.yadakshop-cat-faq-question').not(b).attr('aria-expanded','false').closest('.yadakshop-cat-faq-item').find('.yadakshop-cat-faq-answer').stop(true,true).slideUp(300).prop('hidden',true);b.attr('aria-expanded',String(!open));a.stop(true,true).slideToggle(300,function(){a.prop('hidden',!b.attr('aria-expanded')||b.attr('aria-expanded')==='false');});});});" );
	}
}
