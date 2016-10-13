<?php namespace BoiseState\Events;

use WP_Query;

class Data
{
	private $config;
	private $prefix;

	public function __construct() {
		$this->prefix = 'saw_events_';
		$this->config = $this->getConfig();
	}

	public function getConfig() {
		return array(
			'apiKey'           => get_option( $this->prefix . 'apiKey' ),
			'clientId'         => get_option( $this->prefix . 'clientId' ),
			'detailsPage'      => get_option( $this->prefix . 'detailsPage' ),
			'calendars'        => get_option( $this->prefix . 'calendars' ),
			'locations'        => get_option( $this->prefix . 'locations' ),
			'eventTypes'       => get_option( $this->prefix . 'eventTypes' ),
			'staticCategories' => get_option( $this->prefix . 'staticCategories' )
		);
	}

	public function getPrefix() {
		return $this->prefix;
	}

	public function getOptions() {
		return array(
			array(
				'id'    => $this->prefix . 'apiKey',
				'title' => 'API Key:'
			),
			array(
				'id'    => $this->prefix . 'clientId',
				'title' => 'Client ID'
			),
			array(
				'id'    => $this->prefix . 'detailsPage',
				'title' => 'Details Page URL:'
			),
			array(
				'id'    => $this->prefix . 'calendars',
				'title' => 'Calendars:'
			),
			array(
				'id'    => $this->prefix . 'locations',
				'title' => 'Locations:'
			),
			array(
				'id'    => $this->prefix . 'eventTypes',
				'title' => 'Event types:'
			),
			array(
				'id'    => $this->prefix . 'staticCategories',
				'title' => 'Static Categories:'
			)
		);
	}

	public function getCategories() {
		$parentCategories = array();
		foreach ( (array)$this->config['calendars'] as $calendar ) {
			$calendar = (array) $calendar;
			if ( $calendar['visible'] === false ) {
				continue;
			}
			$parentCategories[] = $calendar['name'];
		}
		$categories = array();
		foreach ( $parentCategories as $name ) {
			// Get category
			$category = get_term_by( 'name', $name, 'category' );
			if ( ! is_object( $category ) ) {
				continue;
			}
			// Get subcategories
			$subcategories = get_categories( array(
				'child_of'   => $category->term_id,
				'hide_empty' => false
			) );
			// Add all to categories array
			$children = array();
			foreach ( $subcategories as $subcategory ) {
				$children[] = $subcategory->name;
			}
			$categories[] = array(
				'name'     => $category->name,
				'children' => $children
			);
		}

		return $categories;
	}

	public function getIcons() {
		$taxonomy = 'category_media'; // Change to media_category if using Enhanced Media Library

		$the_query = new WP_Query( array(
			'post_type'   => 'attachment',
			'post_status' => 'any',
			'tax_query'   => array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'name',
					'terms'    => 'Icon'
				)
			)
		) );

		$icons = array();
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$src        = wp_get_attachment_image_src( get_the_ID(), 'full' );
				$taxonomies = get_the_taxonomies();
				$taxonomies = str_replace( 'MCM Categories: ', '', $taxonomies[ $taxonomy ] );
				$taxonomies = strip_tags( str_replace( '.', '', $taxonomies ) );
				$icons[]    = array(
					'url'        => array_shift( $src ),
					'name'       => get_the_title(),
					'categories' => explode( ' and ', $taxonomies )
				);
			}
		}

		return $icons;
	}

	public function getFilePath( $name, $type ) {
		$manifest = json_decode( file_get_contents( __DIR__ . '/../app/revs/' . $name . '-rev.json' ) );

		return site_url() . '/wp-content/plugins/bsu_events_manager/app/' . $manifest->{$name . '.' . $type};
	}

	public function template( $filename, $data = array() ) {
		ob_start();
		extract( $data );
		include( $filename );
		$file = ob_get_contents();
		ob_end_clean();

		return $file;
	}

	// Called in views
	public function includes( $id ) {
		return $this->template( __DIR__ . '/../templates/plugin/includes.php', array(
			'id'           => $id,
			'css'          => $this->getFilePath( 'style', 'css' ),
			'dependencies' => $this->getFilePath( 'dependencies', 'js' )
		) );
	}

	// Used to allow us to bootstrap our angular app multiple times
	public function randomId() {
		$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$id   = '';
		for ( $i = 0; $i < 19; $i ++ ) {
			$id .= $pool[ rand( 0, strlen( $pool ) - 1 ) ];
		}

		return $id;
	}

}