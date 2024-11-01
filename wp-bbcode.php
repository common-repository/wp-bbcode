<?php
/*

**************************************************************************

Plugin Name:  WP BBCode
Plugin URI:   http://www.arefly.com/wp-bbcode/
Description:  Use BBCode in posts or comments. 讓你可以在部落格中使用BBCode
Version:      1.8.1
Author:       Arefly
Author URI:   http://www.arefly.com/
Text Domain:  wp-bbcode
Domain Path:  /lang/

**************************************************************************

	Copyright 2014  Arefly  (email : eflyjason@gmail.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

**************************************************************************/

define("WP_BBCODE_PLUGIN_URL", plugin_dir_url( __FILE__ ));
define("WP_BBCODE_FULL_DIR", plugin_dir_path( __FILE__ ));
define("WP_BBCODE_TEXT_DOMAIN", "wp-bbcode");

/* Plugin Localize */
function wp_bbcode_load_plugin_textdomain() {
	load_plugin_textdomain(WP_BBCODE_TEXT_DOMAIN, false, dirname(plugin_basename( __FILE__ )).'/lang/');
}
add_action('plugins_loaded', 'wp_bbcode_load_plugin_textdomain');

include_once WP_BBCODE_FULL_DIR."options.php";

/* Add Links to Plugins Management Page */
function wp_bbcode_action_links($links){
	$links[] = '<a href="'.get_admin_url(null, 'options-general.php?page='.WP_BBCODE_TEXT_DOMAIN.'-options').'">'.__("Settings", WP_BBCODE_TEXT_DOMAIN).'</a>';
	return $links;
}
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'wp_bbcode_action_links');

class BBCode {

	// Plugin initialization
	function BBCode() {
		// This version only supports WP 2.5+
		if ( !function_exists('add_shortcode') ) return;

		// Register the shortcodes
		add_shortcode( 'b' , array(&$this, 'shortcode_bold') );
		add_shortcode( 'i' , array(&$this, 'shortcode_italics') );
		add_shortcode( 'u' , array(&$this, 'shortcode_underline') );
		add_shortcode( 'del' , array(&$this, 'shortcode_del') );
		add_shortcode( 'code' , array(&$this, 'shortcode_code') );
		add_shortcode( 'url' , array(&$this, 'shortcode_url') );
		add_shortcode( 'img' , array(&$this, 'shortcode_image') );
		add_shortcode( 'quote' , array(&$this, 'shortcode_quote') );
		add_shortcode( 'textarea' , array(&$this, 'shortcode_textarea') );
		add_shortcode( 'color' , array(&$this, 'shortcode_color') );
		add_shortcode( 'size' , array(&$this, 'shortcode_size') );
		add_shortcode( 'center' , array(&$this, 'shortcode_center') );
		add_shortcode( 'email' , array(&$this, 'shortcode_email') );
		// Table Start
		add_shortcode( 'table' , array(&$this, 'shortcode_table') );
		add_shortcode( 'th' , array(&$this, 'shortcode_th') );
		add_shortcode( 'tr' , array(&$this, 'shortcode_tr') );
		add_shortcode( 'td' , array(&$this, 'shortcode_td') );
		// Table End
		add_shortcode( 'note' , array(&$this, 'shortcode_note') );
		add_shortcode( 'line' , array(&$this, 'shortcode_line') );
		// List Start
		add_shortcode( 'ul' , array(&$this, 'shortcode_ul') );
		add_shortcode( 'ol' , array(&$this, 'shortcode_ol') );
		add_shortcode( 'li' , array(&$this, 'shortcode_li') );
		// List End
		add_shortcode( 'rtl' , array(&$this, 'shortcode_rtl') );
	}


	// No-name attribute fixing
	function attributefix( $atts = array() ) {
		if ( empty($atts[0]) ) return $atts;

		if ( 0 !== preg_match( '#=("|\')(.*?)("|\')#', $atts[0], $match ) )
			$atts[0] = $match[2];

		return $atts;
	}


	// Bold shortcode
	function shortcode_bold( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';

		return '<strong>' . do_shortcode( $content ) . '</strong>';
	}

	// Delete shortcode
	function shortcode_del( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';

		return '<del>' . do_shortcode( $content ) . '</del>';
	}

	// Code shortcode
	function shortcode_code( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';

		return '<code>' . do_shortcode( $content ) . '</code>';
	}


	// Italics shortcode
	function shortcode_italics( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';

		return '<em>' . do_shortcode( $content ) . '</em>';
	}


	// Italics shortcode
	function shortcode_underline( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';

		return '<u>' . do_shortcode( $content ) . '</u>';
	}

	// Blockquote shortcode
	function shortcode_quote( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';

		return '<blockquote>' . do_shortcode( $content ) . '</blockquote>';
	}

	// Textarea shortcode
	function shortcode_textarea( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';

		return '<textarea>' . do_shortcode( $content ) . '</textarea>';
	}


	// URL shortcode
	function shortcode_url( $atts = array(), $content = NULL ) {
		$atts = $this->attributefix( $atts );

		// [url="http://www.google.com/"]Google[/url]
		if ( isset($atts[0]) ) {
			$url = $atts[0];
			$text = $content;
			return '<a href="' . $url . '" title="' . $text . '" target="_blank">' . do_shortcode( $text ) . '</a>';
		}
		// [url]http://www.google.com/[/url]
		else {
			$url = $content;
			return '<a href="' . $url . '" target="_blank">' . do_shortcode( $url ) . '</a>';
		}
	}


	// Image shortcode
	function shortcode_image( $atts = array(), $content = NULL ) {
		$atts = $this->attributefix( $atts );

		// [img="Google's Favicon"]http://www.google.com/favicon.ico[/img]
		if ( isset($atts[0]) ) {
			$alt = $atts[0];		//Google's Favicon
			$img = $content;		//http://www.google.com/favicon.ico
			return '<img src="' . $img . '" alt="' . do_shortcode( $alt )  . '" />';
		}
		// [img]http://www.google.com/favicon.ico[/img]
		else {
			$img = $content;
			return '<img src="' . $img . '" />';
		}
	}

	// Font Color shortcode
	function shortcode_color( $atts = array(), $content = NULL ) {
		$atts = $this->attributefix( $atts );

		// [color="red"]Something[/color]
		if ( isset($atts[0]) ) {
			$color = $atts[0];
			$text = $content;
			return '<span style="color: ' . $color . ';">' . do_shortcode( $text ) . '</span>';
		}
		// [color]Something[/color]
		else {
			$text = $content;
			return '<span>' . do_shortcode( $text ) . '</span>';
		}
	}

	// Font Size shortcode
	function shortcode_size( $atts = array(), $content = NULL ) {
		$atts = $this->attributefix( $atts );

		// [size="10"]Something[/size]
		if ( isset($atts[0]) ) {
			$size = $atts[0];
			$text = $content;
			return '<span style="font-size: ' . $size . 'px;">' . do_shortcode( $text ) . '</span>';
		}
		// [size]Something[/size]
		else {
			$size = $content;
			return '<span>' . do_shortcode( $text ) . '</span>';
		}
	}

	// Center shortcode
	function shortcode_center( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';

		return '<p style="text-align: center;">' . do_shortcode( $content ) . '</p>';
	}

	// Email shortcode
	function shortcode_email( $atts = array(), $content = NULL ) {
		$atts = $this->attributefix( $atts );

		// [email="info@google.com"]Send Mail To Google[/email]
		if ( isset($atts[0]) ) {
			$email = $atts[0];
			$text = $content;
			return '<a href="Mailto:' . $email . '" title="' . do_shortcode( $text ) . '">' . do_shortcode( $text ) . '</a>';
		}
		// [email]info@google.com[/email]
		else {
			$email = $content;
			return '<a href="Mailto:' . $email . '">' . do_shortcode( $email ) . '</a>';
		}
	}

	// Table-table shortcode
	function shortcode_table( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';

		return '<table>' . do_shortcode( $content ) . '</table>';
	}

	// Table-title shortcode
	function shortcode_th( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';

		return '<th>' . do_shortcode( $content ) . '</th>';
	}

	// Table-tablerow shortcode
	function shortcode_tr( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';

		return '<tr>' . do_shortcode( $content ) . '</tr>';
	}

	// Table-tablecol shortcode
	function shortcode_td( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';

		return '<td>' . do_shortcode( $content ) . '</td>';
	}

	// Note shortcode
	function shortcode_note( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';

		return '<!-- ' . do_shortcode( $content ) . ' -->';
	}

	// Line shortcode
	function shortcode_line( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';

		return '<hr />';
	}

	// Unordered List shortcode
	function shortcode_ul( $atts = array(), $content = NULL ) {
		$atts = $this->attributefix( $atts );

		// [ul="circle"][li][/li][/ul]
		if ( isset($atts[0]) ) {
			$ul_type = $atts[0];
			$text = $content;
			return '<ul type="' . $ul_type . '">' . do_shortcode( $text ) . '</ul>';
		}
		// [ul][li][/li][/ul]
		else {
			$text = $content;
			return '<ul>' . do_shortcode( $text ) . '</ul>';
		}
	}

	// Ordered List shortcode
	function shortcode_ol( $atts = array(), $content = NULL ) {
		$atts = $this->attributefix( $atts );

		// [ol="circle"][li][/li][/ol]
		if ( isset($atts[0]) ) {
			$ol_type = $atts[0];
			$text = $content;
			return '<ol type="' . $ol_type . '">' . do_shortcode( $text ) . '</ol>';
		}
		// [ol]http://www.google.com/[/ol]
		else {
			$text = $content;
			return '<ol>' . do_shortcode( $text ) . '</ol>';
		}
	}

	// List shortcode
	function shortcode_li( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';

		return '<li>' . do_shortcode( $content ) . '</li>';
	}

	// Text align right shortcode
	function shortcode_rtl( $atts = array(), $content = NULL ) {
		if ( NULL === $content ) return '';

		return '<p style="text-align: right;">' . do_shortcode( $content ) . '</p>';
	}

}

if (get_option('wp_bbcode_open') == "open_both"){
	// Start this plugin once all other plugins are fully loaded
	add_action( 'plugins_loaded', create_function( '', 'global $BBCode; $BBCode = new BBCode();' ) );
}else{
	// Start this plugin only in comment area
	add_filter( 'comments_template', create_function( '', 'global $BBCode; $BBCode = new BBCode();' ) );
}

?>