
@extends('index')



@section('ConsultaLaminas')
<div ng-controller="ConsultaLaminaController">
<nav class="navbar navbar-default" role="navigation"  >
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header" >
		<input value={{route('index')}} id="url_index" style='display:none;'>
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#">Gestor Laminas</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		
		<ul class="nav navbar-nav navbar-right">
			<li >
				<a class="btn btn-xs" ><span  aria-hidden="true" >Editar</span>	<input type="checkbox"   ng-click="Editar=!Editar;" ></a>	
			</li>
			<li >
				<a  class="btn btn-xs" href="#Agregar" ng-click="EditLamina()" data-toggle="modal" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar</a>
			</li>
			<li>
				<a class="btn btn-xs" href="#"><span  aria-hidden="true">Bienvenido {!!Auth::user()->username!!}</span></a>
			</li>
	 		<li>
				<a class="btn btn-xs" href={{route('logout')}} ><span  aria-hidden="true">Salir</span></a>
			</li>
		</ul>
	</div><!-- /.navbar-collapse -->
</nav>
@include('ConsultaLaminas_')
</div>
@stop

