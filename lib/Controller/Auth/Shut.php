<?php
/**
 * Shut
 */

namespace App\Controller\Auth;

class Shut extends \OpenTHC\Controller\Auth\Shut
{
	function __invoke($REQ, $RES, $ARG)
	{
		$RES = parent::__invoke($REQ, $RES, $ARG);

		if (200 == $RES->getStatusCode()) {

			$file = 'page/done.html';

			$data = [];
			$data['Page'] = [ 'title' => 'Session Closed' ];
			$data['body'] = '<p>Your session has been closed</p><p>';
			$data['foot'] = '<a class="btn btn-outline-secondary" href="/auth/open">Sign In Again</a>';

			$RES = $this->_container->response;
			$RES = $this->_container->view->render($RES, $file, $data);

		}

		return $RES;

	}
}
