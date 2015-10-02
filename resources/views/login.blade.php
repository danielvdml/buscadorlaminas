
@extends('index')


@section('login')

<div class="contenedor col-sm-6 col-sm-offset-3" >
	<form action={{route('login')}} method="POST" class="form-horizontal" role="form" style="margin-top:5%;margin-bottom:5%;">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="form-group" >
				<legend class="col-sm-6 col-sm-offset-3">Iniciar Sesión</legend>
			</div>
			
			<div class="form-group">
				
				<div class="col-sm-6 col-sm-offset-3">
					<input type="text"  name="username" class="form-control" placeholder="Usuario" required="required">
				</div>
			</div>
			 
			<div class="form-group">
				
				<div class="col-sm-6 col-sm-offset-3">
					<input type="password"  name="password" class="form-control" placeholder="Contraseña" required="required" >
				</div>
			</div>
			<div class="form-group">
				<a class="col-sm-6 col-sm-offset-5" href={{route("Registrar")}}>Registrar</a>
			</div>
			<div class="form-group">
				<div class="col-sm-6 col-sm-offset-3">
					<button type="submit" class="btn btn-primary">Ingresar</button>
				</div>
				
			</div>
	</form>
</div>
@stop