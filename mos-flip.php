<?php
/*
Plugin Name: Mos Flip
Plugin URI:
Description: Simaple shortcode
Author: Md. Mostak Shahid
Version: 1.0.0
Author URI: http://mostak.belocal.today
*/
function mos_flip_func( $atts = array(), $content = '' ) {
	$atts = shortcode_atts( array(
		'attachment_id' => '',
		'heading' => '',
		'heading' => '',
		'text_area' => '',
		'link' => '',
		'link_title' => '',
	), $atts, 'mos-flip' );
	$html = '';

	$html .= '<div class="card">';
		$html .= '<div class="front">';
			$attachment_alt = get_post_meta( $atts['attachment_id'], '_wp_attachment_image_alt', true );
			$html .= '<img class="img-mos" src="'.wp_get_attachment_url( $atts['attachment_id'] ).'" alt="'.$attachment_alt.'">';
		$html .= '</div>';
		$html .= '<div class="back">';
			$html .= '<div class="wrapper">';
				if ($atts['heading']) {
					$html .= '<h3>'.$atts['heading'].'</h3>';
				}
				if ($atts['text_area']) {
					$html .= '<div clas="text_area"'.$atts['text_area'].'</div>';
				}
				if ($atts['link'] AND $atts['link_title']) {
					$html .= '<a href="'.$atts['link'].'" class="hidden-link">'.$atts['link_title'].'</a>';
				}

			$html .= '</div>';
		$html .= '</div>';
	$html .= '</div>';
	return $html;
}
add_shortcode( 'mos-flip', 'mos_flip_func' );

function vc_mos_flip_func() {
	vc_map( array(
		'name' => __( 'Mos Flip', 'textdomain' ),
		'base' => 'mos-flip',
		'show_settings_on_create' => true,
		'category' => __( 'Content', 'textdomain'),
		'params' => array(
			array(
				'type' => 'attach_image',
				'holder' => 'div',
				'class' => '',
				'admin_label' => true,
				'heading' => __( 'Image', 'textdomain' ),
				'param_name' => 'attachment_id',
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'admin_label' => true,
				'heading' => __( 'Heading', 'textdomain' ),
				'param_name' => 'heading',
			),
			array(
				'type' => 'textarea',
				'holder' => 'div',
				'class' => '',
				'admin_label' => true,
				'heading' => __( 'Content', 'textdomain' ),
				'param_name' => 'text_area',
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'admin_label' => true,
				'heading' => __( 'Link title', 'textdomain' ),
				'param_name' => 'link_title',
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'admin_label' => true,
				'heading' => __( 'Link URL', 'textdomain' ),
				'param_name' => 'link',
			),
		)
	) );
}
add_action( 'vc_before_init', 'vc_mos_flip_func' );
?>