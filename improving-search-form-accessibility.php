<?php
/**
 * Plugin Name:  Improving Search Form Accessibility
 * Plugin URI:   https://www.webmandesign.eu/portfolio/improving-search-form-accessibility-wordpress-plugin/
 * Description:  Improves search form accessibility by associating search field label explicitly instead of implicitly.
 * Version:      1.0.1
 * Author:       WebMan Design, Oliver Juhas
 * Author URI:   https://www.webmandesign.eu/
 * License:      GNU General Public License v3
 * License URI:  http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:  improving-search-form-accessibility
 * Domain Path:  /languages
 *
 * @copyright  WebMan Design, Oliver Juhas
 * @license    GPL-3.0, https://www.gnu.org/licenses/gpl-3.0.html
 *
 * @link  https://github.com/webmandesign/improving-search-form-accessibility
 * @link  https://www.webmandesign.eu
 *
 * @link  https://developer.wordpress.org/reference/functions/get_search_form/
 * @link  https://www.w3.org/WAI/tutorials/forms/labels/#associating-labels-implicitly
 * @link  https://www.w3.org/WAI/tutorials/forms/labels/#associating-labels-explicitly
 *
 * @package  Improving Search Form Accessibility
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_filter( 'get_search_form', 'isfa_get_search_form', 0, 2 );

function isfa_get_search_form( $form, $args ) {

	// Variables

		if ( $args['aria_label'] ) {
			$aria_label = 'aria-label="' . esc_attr( $args['aria_label'] ) . '" ';
		} else {
			$aria_label = '';
		}

		$id = wp_unique_id( 'search-form-text-' );


	// Output

		return
			'<form role="search" ' . $aria_label . 'method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
				<label for="' . esc_attr( $id ) . '" class="screen-reader-text">' . esc_html_x( 'Search for:', 'label', 'improving-search-form-accessibility' ) . '</label>
				<input id="' . esc_attr( $id ) . '" type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder', 'improving-search-form-accessibility' ) . '" value="' . get_search_query() . '" name="s" />
				<input type="submit" class="search-submit" value="' . esc_attr_x( 'Search', 'submit button', 'improving-search-form-accessibility' ) . '" />
			</form>';

}
