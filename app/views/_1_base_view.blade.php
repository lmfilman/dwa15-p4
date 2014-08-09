<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield("title", "Concoction Keeper")</title>
	{{ HTML::style('/packages/bootstrap-3.2.0-dist/css/bootstrap.min.css'); }}
	{{ HTML::style('/packages/bootstrap-3.2.0-dist/css/starter-template.css'); }}
</head>
<body>

  @yield('body')

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  {{ HTML::script('/packages/bootstrap-3.2.0-dist/js/bootstrap.min.js');}}

</body>
</html>
