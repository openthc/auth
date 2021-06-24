{% extends "layout/html.html" %}

{% block body %}

<div class="auth-wrap">
<div class="card">

	<h1 class="card-header">Application Rejected</h1>
	<div class="card-body">
		<h2 class="card-title">Return To: <strong>{{ Service.name }}</strong></h2>
		<p>You have selected to <strong>REJECT</strong> access to this application, when returning some, or all, functionality may be restricted.</p>
	</div>
	<div class="card-footer">
		<a class="btn btn-outline-secondary" href="{{ return_url }}">Return <i class="fas fa-arrow-right"></i></a>
	</div>

</div>
</div>

{% endblock %}
