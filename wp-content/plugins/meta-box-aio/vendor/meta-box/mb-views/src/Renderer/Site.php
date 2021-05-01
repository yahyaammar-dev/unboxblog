<?php
namespace MBViews\Renderer;

class Site extends Base {
	protected function get_data() {
		$this->data = [
			'title'       => get_bloginfo( 'name' ),
			'description' => get_bloginfo( 'description' ),
		];

		// Group field values by settings page ID.
		$options = [];
		$option_names = $this->get_option_names();
		foreach ( $option_names as $settings_page => $option_name ) {
			$options[ $settings_page ] = [];
		}
		$meta_boxes = rwmb_get_registry( 'meta_box' )->get_by( ['object_type' => 'setting'] );
		foreach ( $meta_boxes as $meta_box ) {
			foreach ( $meta_box->settings_pages as $settings_page ) {
				if ( empty( $option_names[ $settings_page ] ) ) {
					continue;
				}
				$options[ $settings_page ] = array_merge( $options[ $settings_page ], $this->meta_box_renderer->get_data( $meta_box, 'setting', $option_names[ $settings_page ] ) );
			}
		}

		$this->data = array_merge( $this->data, $options );
	}

	private function get_option_names() {
		$settings_pages = apply_filters( 'mb_settings_pages', [] );
		$settings_pages = array_filter( $settings_pages, function( $settings_page ) {
			return empty( $settings_page['network'] );
		} );
		return wp_list_pluck( $settings_pages, 'option_name', 'id' );
	}
}