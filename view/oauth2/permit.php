{% extends "layout/html.html" %}

{% block body %}

<div class="auth-wrap">
<div class="card">

	<h1 class="card-header">Application Permitted</h1>
	<div class="card-body">

		<h2 style="margin:0;">Account:</h2>
		<div class="form-group">
			<div class="form-control"><code>{{ Contact.username }}</code></div>
		</div>

		<h2 style="margin:0;">Company:</h2>
		<div class="form-group">
			<div class="form-control"><code>{{ Company.name }}</code></div>
		</div>

		<h2 style="margin:0;">Service:</h2>
		<div class="form-group">
			<div class="form-control"><code>{{ Service.name }}</code></div>
		</div>

		<p>You have selected to <strong>PERMIT</strong> access to this application.</p>

	</div>
	<div class="card-footer">
		<a class="btn btn-success" href="{{ return_url }}">Continue <i class="fas fa-arrow-right"></i></a>
	</div>

</div>
</div>

{% endblock %}
