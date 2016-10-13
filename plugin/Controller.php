<?php namespace BoiseState\Events;

class Controller
{

	private $categories;
	private $data;

	public function __construct() {
		$this->data       = new Data();
		$this->categories = $this->data->getCategories();
		$this->prefix     = $this->data->getPrefix();
	}

	public function shortcode() {
		echo $this->data->template( __DIR__ . '/../templates/plugin/shortcode.php', array(
			'id'        => $this->data->randomId(),
			'dashboard' => $this->data->getFilePath( 'dashboard', 'js' ),
			'params'    => htmlentities( json_encode( array(
				'categories' => array(
					'all' => $this->categories
				)
			) ) )
		) );
	}

	public function settings() {
		echo $this->data->template( __DIR__ . '/../templates/plugin/settings.php', array() );
	}

	public function manager() {
		$config = $this->data->getConfig();
		echo $this->data->template( __DIR__ . '/../templates/plugin/manager.php', array(
			'id'        => $this->data->randomId(),
			'dashboard' => $this->data->getFilePath( 'dashboard', 'js' ),
			'params'    => htmlentities( json_encode( array(
				'categories'       => array(
					'all' => $this->categories
				),
				'apiKey'           => $config['apiKey'],
				'calendars'        => $config['calendars'],
				'clientId'         => $config['clientId'],
				'detailsPage'      => $config['detailsPage'],
				'eventTypes'       => $config['eventTypes'],
				'locations'        => $config['locations'],
				'staticCategories' => $config['staticCategories'],
				'icons'            => $this->data->getIcons()
			) ) )
		) );
	}

	public function display( $categories, $viewType, $calendarId = null, $eventId = null ) {
		$config = $this->data->getConfig();

		return $this->data->template( __DIR__ . '/../templates/plugin/display.php', array(
			'display'  => $this->data->getFilePath( 'display', 'js' ),
			'id'       => $this->data->randomId(),
			'viewType' => $viewType,
			'params'   => htmlentities( json_encode( array(
				'categories'       => array(
					'view' => $categories ?: array(),
					'all'  => $this->categories,
				),
				'apiKey'           => $config['apiKey'],
				'calendars'        => $config['calendars'],
				'clientId'         => $config['clientId'],
				'detailsPage'      => $config['detailsPage'],
				'eventTypes'       => $config['eventTypes'],
				'locations'        => $config['locations'],
				'staticCategories' => $config['staticCategories'],
				// Used for details page
				'calendarId'       => $calendarId,
				'eventId'          => $eventId
			) ) )
		) );
	}

	public function getField( $name ) {
		$option = get_option( $this->prefix . $name );
		echo '<input type="text" name="' . $this->prefix . $name . '" value="' . $option . '" class="form-control">';
	}

	public function __call( $name, $args ) {
		$name = str_replace( $this->prefix, '', $name );
		if ( method_exists( $this, $name ) ) {
			$this->{$name}( $args );
		} else {
			$this->getField( $name );
		}
	}

	public function calendars() {
		$calendars = get_option( $this->prefix . 'calendars' ) ?: array();
		?>
		<div class="calendarForm"><?php
		foreach ( $calendars as $key => $calendar ) {
			echo $this->data->template( __DIR__ . '/../templates/plugin/form/calendars.php', array(
				'prefix'  => $this->prefix,
				'uid'     => $key,
				'name'    => $calendar['name'],
				'id'      => $calendar['id'],
				'visible' => $calendar['visible']
			) );
		}
		echo $this->data->template( __DIR__ . '/../templates/plugin/form/newCalendar.php', array(
			'prefix' => $this->prefix
		) );
		?></div><?php
	}

	public function locations() {
		$locations = get_option( $this->prefix . 'locations' ) ?: array();
		?>
		<div class="locationsForm"><?php
		foreach ( $locations as $key => $location ) {
			echo $this->data->template( __DIR__ . '/../templates/plugin/form/locations.php', array(
				'prefix' => $this->prefix,
				'uid'    => $key,
				'name'   => $location['name']
			) );
		}
		echo $this->data->template( __DIR__ . '/../templates/plugin/form/newLocation.php', array(
			'prefix' => $this->prefix
		) );
		?></div><?php
	}

	public function eventTypes() {
		$eventTypes = get_option( $this->prefix . 'eventTypes' ) ?: array();
		?>
		<div class="locationsForm"><?php
		foreach ( $eventTypes as $key => $eventType ) {
			echo $this->data->template( __DIR__ . '/../templates/plugin/form/eventTypes.php', array(
				'prefix' => $this->prefix,
				'uid'    => $key,
				'name'   => $eventType['name'],
				'title'  => $eventType['title'],
				'color'  => $eventType['color']
			) );
		}
		echo $this->data->template( __DIR__ . '/../templates/plugin/form/newEventType.php', array(
			'prefix' => $this->prefix
		) );
		?></div><?php
	}

	public function staticCategories() {
		$staticCategories = get_option( $this->prefix . 'staticCategories' ) ?: array();
		?>
		<div class="locationsForm"><?php
		foreach ( $staticCategories as $key => $staticCategory ) {
			echo $this->data->template( __DIR__ . '/../templates/plugin/form/staticCategories.php', array(
				'prefix' => $this->prefix,
				'uid'    => $key,
				'name'   => $staticCategory
			) );
		}
		echo $this->data->template( __DIR__ . '/../templates/plugin/form/newStaticCategory.php', array(
			'prefix' => $this->prefix
		) );
		?></div><?php
	}
}