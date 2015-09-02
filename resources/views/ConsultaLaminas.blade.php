
@extends('index')

@section('ConsultaLaminas')
<div class="container" >
		<div ng-controller="ConsultaLaminaController">
			<input value={{route('index')}} id="url_index" style='display:none;'>
			<div class="container">
				<div class="navbar" style="position:fixed">
						<a class="navbar-brand" href="#">Gestor Laminas</a>
						<ul class="nav navbar-nav">
							<li class="active">
								<a  class="btn btn-xs"href="#Agregar" ng-click="EditLamina()" data-toggle="modal" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar</a>
							</li>
							
							<li>
								<a href="#">Bienvenido {!!Auth::user()->username!!}</a>
							</li>
					 		<li>
								
								<a href={{route('logout')}} >Salir</a>
							</li>
						</ul>

				</div>
			</div>
			@include('ConsultaLaminas_')
		</div>		
</div>
@stop