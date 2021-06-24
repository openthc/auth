{% extends "layout/html.html" %}

{% block body %}

<div class="auth-wrap">

	<div class="card">
	<h1 class="card-header">{{ Page.title }}</h1>
	<div class="card-body">

		{% if fail %}
			<div class="alert alert-danger">{{ fail }}</div>
		{% endif %}

		{% if warn %}
			<div class="alert alert-waring">{{ warn }}</div>
		{% endif %}

		{% if info %}
			<div class="alert alert-info">{{ info }}</div>
		{% endif %}

		{{ body|raw }}

	</div>
	{% if foot %}
		<div class="card-footer">
			{{ foot|raw }}
		</div>
	{% endif %}
	</div>
</div>

{% endblock %}
