<?php namespace BoiseState\Events;

class Settings
{
	private $controller;
	private $data;

	public function __construct() {
		$this->controller = new Controller();
		$this->data       = new Data();

		add_action( 'admin_menu', array( $this, 'bsu_events_menu' ) );
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		$options = $this->data->getOptions(); // PHP 5.3 can't use $this in closure
		add_action( 'whitelist_options', function($whitelistOptions) use($options) {
			$whitelistOptions['boise_state_events_settings'] = array_map( function ( $option ) {
				return $option['id'];
			}, $options );
			return $whitelistOptions;
		});
	}

	public function bsu_events_menu() {

		add_menu_page(
			"Events", // Page title
			"Events", // Menu title
			"publish_posts", // Capability
			"boise-state-events-manager", // Menu slug
			array( $this->controller, 'manager' ), // Callback
			'dashicons-calendar' // Icon
		);
		add_submenu_page(
			"boise-state-events-manager", // Parent slug
			"Boise State Events Admin", // Page title
			"Shortcode Creator", // Menu Title
			"manage_options", // Capability
			"boise-state-events-shortcode", // Menu slug
			array( $this->controller, 'shortcode' ) // Callback
		);
		add_submenu_page(
			'boise-state-events-manager', // Parent slug
			'Boise State Events Admin', // Page title
			'Settings', // Menu Title
			'manage_options', // Capability
			'boise-state-events-settings', // Menu slug
			array( $this->controller, 'settings' ) // Callback
		);
	}

	public function admin_init() {
		add_settings_section(
			'boise_state_events_settings', // ID
			'Events Settings', // Title
			array( $this, 'settings' ), // Callback
			'boise_state_events_settings_options' // Page
		);
	}

	public function settings() {
		foreach ( $this->data->getOptions() as $option ) {
			if(isset($option['validator'])){
				add_filter('pre_update_option_' . $option['id'], $option['validator']);
			}
			register_setting(
				'boise_state_events_settings', // Option group
				$option['id'] // Option name
			);
			$method = preg_replace( '/\[|\]/', '', $option['id'] ); // Remove '[]' from arrays
			add_settings_field(
				$option['id'], // ID
				$option['title'], // Title
				array( $this->controller, $method ), // Callback
				'boise_state_events_settings_options', // Page
				'boise_state_events_settings' // Section
			);
		}
	}

}