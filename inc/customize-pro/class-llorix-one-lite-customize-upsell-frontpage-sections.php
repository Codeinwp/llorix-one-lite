<?php
/**
 * Section class file.
 *
 * @package llorix-one-lite
 */

/**
 * Pro customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class Llorix_One_Lite_Customizer_Upsell_Frontpage_Sections extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'llorix-one-lite-frontpage-sections';

	/**
	 * Upsell text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $upsell_text = '';


	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function json() {
		$json                = parent::json();
		$json['upsell_text'] = wp_kses_post( $this->upsell_text );
		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() {
	?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
			<p class="frontpage-sections-upsell">
				<# 	if ( data.upsell_text ) { #>
					{{{data.upsell_text}}}
				<# } #>
			</p>
		</li>
		<?php
	}
}
