
@extends('index')


@section('login')
<div class="container">
	<form action={{route('login')}} method="POST" class="form-horizontal" role="form">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="form-group">
				<legend>Login</legend>
			</div>
			
			<div class="form-group">
				
				<div class="col-sm-10">
					<input type="text"  name="username" class="form-control" placeholder="Usuario" required="required">
				</div>
			</div>
			 
			<div class="form-group">
				
				<div class="col-sm-10">
					<input type="password"  name="password" class="form-control" placeholder="Contraseña" required="required" >
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
	</form>
</div>
@stop