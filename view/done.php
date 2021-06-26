
<div class="auth-wrap">

	<div class="card">
	<h1 class="card-header"><?= $data['Page']['title'] ?></h1>
	<div class="card-body">

		<?php
		if ($data['fail']) {
			printf('<div class="alert alert-danger">%s</div>', h($data['fail']));
		}

		if ($data['warn']) {
			printf('<div class="alert alert-waring">%s</div>', h($data['warn']));
		}

		if ($data['info']) {
			printf('<div class="alert alert-info">%s</div>', h($data['info']));
		}

		echo $data['body']

		?>

	</div>
	<?php
	if ($data['foot']) {
		printf('<div class="card-footer">%s</div>', $data['foot']);
	}
	?>
	</div>
</div>
