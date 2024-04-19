<?php
/**
 * Plugin Name:       No Pulp Table
 * Description:       For those who don't like extra pulp in their oj
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       no-pulp-table
 *
 * @package           jl
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function no_pulp_table_no_pulp_table_block_init() {
	register_block_type( __DIR__ . '/build/blocks/table' );
	register_block_type( __DIR__ . '/build/blocks/review-list' );
}
add_action( 'init', 'no_pulp_table_no_pulp_table_block_init' );

// Include Font Awesome CSS file
function include_font_awesome() {
	// Load Font Awesome from CDN
	wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), '5.15.4', 'all');
}
add_action('wp_enqueue_scripts', 'include_font_awesome');

include "patterns.php";
