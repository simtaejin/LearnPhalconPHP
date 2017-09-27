{% extends "templates/base.volt" %}

{% block head %}
{{ this.assets.outputCss('extra') }}
{% endblock %}

{% block content %}
<form class="form-signin" method="post" action="{{ url('signin/doRegister') }}">
    <h2 class="form-signin-heading">Register</h2>
    <input type="text" name="email" class="form-control" placeholder="Email address" autofocus>
    <input type="password" name="password" class="form-control" placeholder="Password">
    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <input type="hidden" name="{{ security.getTokenKey() }}" value="{{ security.getToken() }}">
</form>
{% endblock %}

