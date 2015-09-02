

@extends('index')

@section('RegistrarUsuario')
<div class="container">
    
    <form action={{route('crearUsuario')}} method="POST" class="form-horizontal" role="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <legend>Registrar Usuario</legend>
            </div>
            <div class="form-group">
                <div class="col-sm-10">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Usuario" required="required" >
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10">
                    <input type="email" name="email" id="input" class="form-control" placeholder="Correo Electrónico" required="required" >
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10">
                    <input type="password" name="password" id="input" class="form-control" placeholder="password" required="required" >
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