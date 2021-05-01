<?php
namespace MBUP;

class Error {
	private $key;
	private $type;

	public function __construct( $key ) {
		$this->key = $key;
	}

	public function set( $error, $type = 'error' ) {
		$_SESSION[ $this->key ] = $error;
		$this->type = $type;
	}

	public function has() {
		return ! empty( $_SESSION[ $this->key ] );
	}

	public function clear() {
		unset( $_SESSION[ $this->key ] );
	}

	public function show() {
		echo $this->get_message();
	}

	public function get_message() {
		return sprintf( '<div class="rwmb-%s">%s</div>', esc_attr( $this->type ), wp_kses_post( $_SESSION[ $this->key ] ) );
	}
}