<?php

/**
 * Security Headers/CSP Policy configuration
 * Require composer autoload and csp-headers.php in functions.php
 * __DIR__ . '/inc|lib/security/vendor/autoload.php';
 * __DIR__ . '/inc|lib/security/csp-headers.php';
 */

// require _DIR__ . '/lib/security/vendor/autoload.php';
// 'lib/security/csp-headers.php',          // Security scripts

// https://github.com/paragonie/csp-builder/tree/master
use ParagonIE\CSPBuilder\CSPBuilder;

add_filter( 'wp_headers', function( $headers ) {

	if ( ! isset( $headers["Cache-Control"] ) ) {
		$headers["Cache-Control"] = "no-store,max-age=0";
	}

	if ( ! isset( $headers["Strict-Transport-Security"] ) ) {
		$headers["Strict-Transport-Security"] = "max-age=31536000; includeSubDomains";
	}

	if ( ! isset( $headers['X-Frame-Options'] ) ) {
		$headers['X-Frame-Options'] = 'SAMEORIGIN';
	}

	if ( ! isset( $headers["X-XSS-Protection"] ) ) {
		$headers["X-XSS-Protection"] = "0";
	}

	if ( ! isset( $headers["X-Content-Type-Options"] ) ) {
		$headers["X-Content-Type-Options"] = "nosniff";
	}

	if ( ! isset( $headers["Referrer-Policy"] ) ) {
		$headers["Referrer-Policy"] = "same-origin";
	}

	if ( ! isset( $headers["Permissions-Policy"] ) ) {
		$headers["Permissions-Policy"] = "accelerometer=(), autoplay=(self), camera=(), cross-origin-isolated=(), display-capture=(), encrypted-media=(self), fullscreen=(self), geolocation=(self), gyroscope=(), keyboard-map=(), magnetometer=(), microphone=(), midi=(), payment=(), picture-in-picture=(), publickey-credentials-get=(), screen-wake-lock=(), sync-xhr=(self), usb=(), xr-spatial-tracking=()";
	}

	if ( ! isset( $headers["X-Frame-Options"] ) ) {
		$headers["X-Frame-Options"] = "SAMEORIGIN";
	}

	if ( ! isset( $headers["Cross-Origin-Opener-Policy"] ) ) {
		$headers["Cross-Origin-Opener-Policy"] = "same-origin";
	}

	if ( ! isset( $headers["Cross-Origin-Resource-Policy"] ) ) {
		$headers["Cross-Origin-Resource-Policy"] = "same-origin";
	}

	if ( ! isset( $headers["Cross-Origin-Embedder-Policy"] ) ) {
		$headers["Cross-Origin-Embedder-Policy"] = "same-origin";
	}

	if ( ! isset( $headers["Content-Security-Policy"] ) && file_exists(  __DIR__ . '/csp-policy.json' ) ) {

		$csp = CSPBuilder::fromFile( __DIR__ . '/csp-policy.json');
		$csp->sendCSPHeader();

	}

	return $headers;

}, 999 );
