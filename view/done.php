<?php
/**
 * End of the Line
 *
 * SPDX-License-Identifier: MIT
 */

if ( ! empty($data['error_code'])) {
	$data['Page']['title'] = sprintf('Error: %s', $data['error_code']);
	switch ($data['error_code']) {
		case 'CVB-030':
			$data['fail'] = 'Invalid Request';
			break;
		case 'CAO-040':
			$data['fail'] = 'Invalid Request, Token Expired or Invalid';
			break;
		case 'CVM-130':
			$data['Page']['title'] = 'Verification Complete';
			$data['body'] = <<<HTML
			<h2 class="alert alert-success">Account Pending Activation.</h2>
			<p>You will soon receive an activation email which will complete the account creation process.</p>
			HTML;
			$data['foot'] = <<<HTML
			<a class="btn btn-primary" href="https://openthc.com/demo" tabindex="1">Browse Demo <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
			<a class="btn btn-outline-danger" href="https://openthc.com/help" tabindex="2" target="_blank" style="float: right;">Get Help <i class="fas fa-life-ring"></i></a>
			HTML;
			break;
		default:
			$data['Page']['title'] = sprintf('Error: %s', $data['error_code']);
	}
}

?>

<div class="auth-wrap">

	<div class="card">
	<h1 class="card-header"><?= $data['Page']['title'] ?></h1>
	<div class="card-body">

		<?php
		if ($data['fail']) {
			printf('<div class="alert alert-danger">%s</div>', h($data['fail']));
		}

		if ($data['warn']) {
			printf('<div class="alert alert-warning">%s</div>', h($data['warn']));
		}

		if ($data['info']) {
			printf('<div class="alert alert-info">%s</div>', h($data['info']));
		}

		echo $data['body'];

		// It's the Secret Token
		if ( ! empty($_GET['t'])) {
			$sso_origin = OPENTHC_SERVICE_ORIGIN;
			echo sprintf('<hr><div class="alert alert-warning">Auth: <a href="%s/auth/once?_=%s">SSO/auth/once</a></div>', $sso_origin, $_GET['t']);
		}

		?>

	</div>
	<?php
	if ($data['foot']) {
		printf('<div class="card-footer">%s</div>', $data['foot']);
	}
	?>
	</div>
</div>
