<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * @var $this WPBakeryShortCode_VC_Tta_Section
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$this->resetVariables( $atts, $content );
WPBakeryShortCode_VC_Tta_Section::$self_count ++;
WPBakeryShortCode_VC_Tta_Section::$section_info[] = $atts;
$isPageEditable = vc_is_page_editable();

$output = '';

$output .= '<div class="vc_tta-panel"';
$output .= ' id="' . esc_attr( $this->getTemplateVariable( 'tab_id' ) ) . '"';
$output .= ' data-vc-content=".vc_tta-panel-body">';
$output .= '<div class="vc_tta-panel-heading">';
$output .= '<h2 class="vc_tta-panel-title vc_tta-controls-icon-position-left">';
$output .= '<a href="#' . esc_attr( $this->getTemplateVariable( 'tab_id' ) ) . '" data-vc-accordion data-vc-container=".vc_tta-container">';
$output .= '<span class="vc_tta-title-text">'. $this->getTemplateVariable( 'title' ) .'</span>';
$output .= '</a>';
$output .= '</h2>';
$output .= '</div>';
$output .= '<div class="vc_tta-panel-body">';
if ( $isPageEditable ) {
	$output .= '<div data-js-panel-body>'; // fix for fe - shortcodes container, not required in b.e.
}
$output .= $this->getTemplateVariable( 'content' );
if ( $isPageEditable ) {
	$output .= '</div>';
}
$output .= '</div>';
$output .= '</div>';

echo $output;
