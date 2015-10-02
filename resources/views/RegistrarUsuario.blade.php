

@extends('index')

@section('RegistrarUsuario')
<style>
    select:required,
input:required {
    border: 1px solid blue;
}
select:valid,
input:valid {
    border: 1px solid green;
}
select:invalid,
input:invalid {
    border: 1px solid red;
}
</style>
<div class="contenedor  col-sm-6 col-sm-offset-3">
    
    <form action={{route('crearUsuario')}} method="POST" class="form-horizontal" role="form" style="margin-top:5%;margin-bottom:5%;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <legend class="col-sm-6 col-sm-offset-3">Registrar Usuario</legend>
            </div>
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Usuario" required="required" >
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3">
                    <input type="email" name="email" id="input" class="form-control" placeholder="Correo Electrónico" required="required" >
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3">
                    <input type="password" name="password" id="input" class="form-control" placeholder="password" required="required" >
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3 ">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
    </form>
</div>
@stop