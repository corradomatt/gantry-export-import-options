<?php
/*
Plugin Name: Gantry Export and Import Options
Description: Export and Import options of your Gantry powered theme. Also supports Gantry overrides.
Version: 0.2
Author: Hassan Derakhshandeh

		* 	Copyright (C) 2011  Hassan Derakhshandeh
		*	http://tween.ir/
		*	hassan.derakhshandeh@gmail.com

		This program is free software; you can redistribute it and/or modify
		it under the terms of the GNU General Public License as published by
		the Free Software Foundation; either version 2 of the License, or
		(at your option) any later version.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program; if not, write to the Free Software
		Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class Gantry_Export_Import_Options {

	function Gantry_Export_Import_Options() {
		add_action( "load-toplevel_page_gantry-theme-settings", array( &$this, 'actions' ) );
		add_action( "admin_footer-toplevel_page_gantry-theme-settings", array( &$this, 'form' ) );
	}

	function form() {
		require_once( dirname( __FILE__ ) . '/screens/form.php' );
	}

	function actions() {
		if( $_GET['action'] == 'download' ) {
			header("Cache-Control: public, must-revalidate");
			header("Pragma: hack");
			header("Content-Type: text/plain");
			header('Content-Disposition: attachment; filename="theme-options-'.date("dMy").'.dat"');
			echo serialize( $this->_get_options() );
			die();
		}

		// import settings
		if( isset( $_POST['upload'] ) ) {
			if( $_FILES["file"]["error"] > 0 ) {
				// error
			} else {
				$options = unserialize( file_get_contents( $_FILES["file"]["tmp_name"] ) );
				foreach( $options as $option ) {
					update_option( $option->option_name, unserialize( $option->option_value ) );
				}
			}
		}
	}

	function _get_options() {
		global $wpdb, $gantry;

		return $wpdb->get_results( "SELECT option_name, option_value FROM {$wpdb->options} WHERE option_name LIKE 'widget_%' OR option_name LIKE '{$gantry->templateName}-template-options%' OR option_name = 'sidebars_widgets'" );
	}
}
new Gantry_Export_Import_Options;