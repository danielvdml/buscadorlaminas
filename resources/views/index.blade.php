<!DOCTYPE html>
<html ng-app="BuscadorLaminas"lang="en">
<head>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
	<meta charset="UTF-8">
	
	
	{!!HTML::script('js/jquery.min.js')!!}
	{!!HTML::script('js/bootstrap.min.js')!!}
	{!!HTML::style('css/bootstrap.min.css')!!}
	{!!HTML::script('js/app/angular.min.js')!!}
	{!!HTML::script('js/app/app.js')!!}
	{!!HTML::script('js/app/controller.js')!!}
	{!!HTML::script('js/app/angular-animate.min.js')!!}
	{!!HTML::script('js/app/angular-sanitize.min.js')!!}
	<style>
	.contenedor{
		background: rgba(242,246,248,1);
background: -moz-linear-gradient(-45deg, rgba(242,246,248,1) 0%, rgba(216,225,231,1) 50%, rgba(181,198,208,1) 51%, rgba(224,239,249,1) 100%);
background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(242,246,248,1)), color-stop(50%, rgba(216,225,231,1)), color-stop(51%, rgba(181,198,208,1)), color-stop(100%, rgba(224,239,249,1)));
background: -webkit-linear-gradient(-45deg, rgba(242,246,248,1) 0%, rgba(216,225,231,1) 50%, rgba(181,198,208,1) 51%, rgba(224,239,249,1) 100%);
background: -o-linear-gradient(-45deg, rgba(242,246,248,1) 0%, rgba(216,225,231,1) 50%, rgba(181,198,208,1) 51%, rgba(224,239,249,1) 100%);
background: -ms-linear-gradient(-45deg, rgba(242,246,248,1) 0%, rgba(216,225,231,1) 50%, rgba(181,198,208,1) 51%, rgba(224,239,249,1) 100%);
background: linear-gradient(135deg, rgba(242,246,248,1) 0%, rgba(216,225,231,1) 50%, rgba(181,198,208,1) 51%, rgba(224,239,249,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f2f6f8', endColorstr='#e0eff9', GradientType=1 );
margin-top:5%;

-webkit-border-radius: 20px;
	}
</style>
	<title>Buscador de Laminas</title>
</head>
<body >

	@section('ConsultaLaminas')
	@show

	@section('login')
	@show

	@section('RegistrarUsuario')

	@show
	
</body>
</html>