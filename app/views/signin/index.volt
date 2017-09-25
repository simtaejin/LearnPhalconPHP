{% extends "templates/base.volt" %}

{% block head %}
{{ this.assets.outputCss('extra') }}
{% endblock %}

{% block content %}
<form class="form-signin" method="post" action="{{ url('signin/doSignin') }}">
    <h2 class="form-signin-heading">Please sign in</h2>
    <input type="text" name="email" class="form-control" placeholder="Email address" autofocus>
    <input type="password" name="password" class="form-control" placeholder="Password">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>
{% endblock %}

