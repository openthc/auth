<?php
/**
 * Enables Test Mode
 *
 * SPDX-License-Identifier: MIT
 */

namespace App\Middleware;

class TestMode extends \OpenTHC\Middleware\Base
{
	function __invoke($REQ, $RES, $NMW) {

		$key_user = null;
		$key_real = null;
		$set_test = false;

		if (!empty($_SERVER['HTTP_OPENTHC_TEST_MODE'])) {
			$key_user = $_SERVER['HTTP_OPENTHC_TEST_MODE'];
		} elseif (!empty($_COOKIE['test'])) {
			$key_user = $_COOKIE['test'];
		} elseif (!empty($_GET['_t'])) {
			$key_user = $_GET['_t'];
		}

		if (!empty($key_user)) {
			$key_real = \OpenTHC\Config::get('app/test');
			if ($key_user == $key_real) {
				$set_test = true;
			}
		}

		if ($set_test) {
			$_ENV['test'] = $set_test;
			setcookie('test', $key_real, 0, '/', '', true, true);
			$RES = $RES->withHeader('openthc-test-mode', '1');
		}

		$RES = $NMW($REQ, $RES);

		return $RES;

	}
}
