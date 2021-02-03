<?php
/**
 * Set a Password
 */

namespace App\Controller\Account;

class Password extends \OpenTHC\Controller\Base
{
	/**
	 *
	 */
	function __invoke($REQ, $RES, $ARG)
	{
		$ARG = $this->parseArg();

		$file = 'page/account/password.html';
		$data = $this->data;
		$data['Page']['title'] = 'Set Password';
		$data['auth_username'] = $ARG['contact']['username'];

		if (!empty($_GET['e'])) {
			switch ($_GET['e']) {
			case 'cap047':
				$data['Page']['flash'] = 'Invalid password';
				break;
			case 'cap052':
				$data['Page']['flash'] = 'Invalid password';
				break;
			case 'cap057':
				$data['Page']['flash'] = 'Invalid password';
				break;
			case 'cap062':
				$data['Page']['flash'] = 'Passwords do not match';
				break;
			}
		}

		return $this->_container->view->render($RES, $file, $data);

	}

	/**
	 *
	 */
	function post($REQ, $RES, $ARG)
	{
		$ARG = $this->parseArg();

		// Set Their Password
		switch (strtolower($_POST['a'])) {
		case 'update':

			$p = $_POST['p0'];

			if (empty($p) || empty($_POST['p1'])) {
				return $RES->withRedirect('/account/password?e=cap047');
			}

			if (strlen($p) < 8) {
				return $RES->withRedirect('/account/password?e=cap052');
			}

			if (preg_match_all('/\w|\d/', $p) < 8) {
				return $RES->withRedirect('/account/password?e=cap057');
			}

			if ($p != $_POST['p1']) {
				return $RES->withRedirect('/account/password?e=cap062');
			}

			$dbc_auth = $this->_container->DBC_AUTH;

			$arg = [];
			$arg[':c0'] = $ARG['contact']['id'];
			$arg[':pw'] = password_hash($_POST['p0'], PASSWORD_DEFAULT);

			$sql = 'UPDATE auth_contact SET password = :pw WHERE id = :c0';
			$dbc_auth->query($sql, $arg);

			$RES = $RES->withAttribute('Contact', [
				'id' => $ARG['contact']['id'],
				'username' => $ARG['contact']['username'],
				'password' => $arg[':pw'],
			]);

			// @deprecated use ACT
			// Password reset from email link, routes to verify
			if ('email' == $ARG['source']) {
				$ARG['intent'] = 'email-verify-save';
				$ARG['source'] = 'password-reset';
				$x = _encrypt(json_encode($ARG), $_SESSION['crypt-key']);
				return $RES->withRedirect('/account/verify?_=' . $x);
			}

			return $RES->withRedirect('/auth/open?e=cap080');

			break;
		}
	}

	private function parseArg()
	{
		$act = new \App\AUth_Context_Ticket($this->_container->DBC_AUTH);
		$act->loadBy('id', $_GET['_']);

		$ARG = _decrypt($_GET['_'], $_SESSION['crypt-key']);
		$ARG = json_decode($ARG, true);

		if (empty($ARG)) {
			__exit_html('<h1>Invalid Request [CAP-107]</h1><p>You can <a href="/auth/shut">clear your session</a> and try again</p>', 400);
		}

		if (empty($ARG['contact']['id'])) {
			__exit_html('<h1>Invalid Request [CAP-111]</h1><p>You can <a href="/auth/shut">clear your session</a> and try again</p>', 400);
		}

		return $ARG;
	}
}
