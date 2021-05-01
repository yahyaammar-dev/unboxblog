<?php
namespace MBViews\Fields;

use RWMB_Field;

class BaseRenderer {
	public static $field;

	public static function parse( $value, $field ) {
		self::$field = $field;
		return $field['clone'] ? array_map( 'static::get_clone_value', $value ) : static::get_clone_value( $value );
	}

	public static function get_clone_value( $clone ) {
		return self::$field['multiple'] ? array_map( 'static::get_single_value', $clone ) : static::get_single_value( $clone );
	}

	public static function get_single_value( $value ) {
		return RWMB_Field::call( 'format_single_value', self::$field, $value, [], null );
	}
}