



<div class="container"  >
	<div class="row">
		<div class="panel panel-primary">

			  <div class="panel-body" ng-init="getEditoriales()" >
					<input type="search" ng-model="keyword" ng-keypress="getLaminas_1($event)" id="input" class="form-control" placeholder="Buscar">
					<div class="radio">
						<label>
							<input type="radio" value="" ng-model="Buscar.editorial" checked="checked">Todos
						</label>
						<label ng-repeat="editorial in Editoriales">
							<input type="radio"  name="editorial"  ng-value="editorial.editorial" ng-model="Buscar.editorial" >
							{{editorial.editorial}}
						</label>
					</div>
			  </div>
		</div>
	</div>

	<div class="row">
		<div class="panel panel-primary">
			  <div class="panel-body" style ="height:500px;overflow-y:scroll">
					<table class="table table-hover">
						<thead>
							<tr>
								<th class="col-sm-1">Número</th>
								<th class="col-sm-3">Título</th>
								<th class="col-sm-3">Editorial</th>
								<th class="col-sm-3">Descripcion</th>
								<th class="col-sm-1">Cantidad</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="lamina in Laminas| filter:Buscar.editorial" >
								<td class="col-sm-1"><a data-toggle="modal" href='#Editar' ng-click="EditLamina(lamina)" ng-if="Editar">{{lamina.numero}}</a><span ng-if="!Editar">{{lamina.numero}}</span></td>
								<td class="col-sm-3"><a data-toggle="modal" href="#Vender" ng-click="VentaLamina(lamina)" ng-bind-html="lamina.titulo"></a></td>
								<td class="col-sm-3">{{lamina.editorial}}</td>
								<td class="col-sm-3" ng-bind-html="lamina.descripcion"></td>
								<td class="col-sm-1">{{lamina.cantidad}}</td>
							</tr>
						</tbody>
					</table>
			  </div>
		</div>
	</div>
</div>

<style>
	.alert-message
{
    margin: 20px 0;
    padding: 20px;
    border-left: 3px solid #eee;

}
.alert-message-success
{
    background-color: #F4FDF0;
    border-color: #3C763D;
}
.alert-message-danger
{
    background-color: #fdf7f7;
    border-color: #d9534f;
}
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

<div class="modal fade" id="Editar">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Editar Lamina   <!-- {{message.deleteLamina}} --></h4>
				<div class="alert-message alert-message-success" ng-show="State.updateLamina">{{Message.updateLamina}}</div>
				<!-- <div class="alert-message alert-message-danger" ng-show="State.updateLamina==false">Ha Ocurrido un Error</div> -->
				<div class="alert-message alert-message-danger" ng-show="State.deleteLamina">{{Message.deleteLamina}}</div>
				<!-- <div class="alert-message alert-message-danger" ng-show="State.deleteLamina==false">Ha Ocurrido un Error</div> -->
			</div>
			<div class="modal-body">
				<form  role="form">
				
					<div class="form-group">
						<label class="sr-only" for="">Numero</label>
						<input type="text"  class="form-control" placeholder="Número" ng-model="Lamina.numero" required>
					</div>

					<div class="form-group">
						<label class="sr-only" for="">Título</label>

						<input type="text"  class="form-control" placeholder="Título" required="required" ng-bind-html="Lamina.titulo" ng-model="Lamina.titulo" >
					</div>					
					
					<div class="radio">
						<!-- <label class="radio-inline">
							<input type="radio" name="radioEditorial" ng-value="Lamina.editorial" ng-model="Lamina.editorial" checked="checked">
							{{Lamina.editorial}}
						</label> -->
						<label class="radio-inline" ng-repeat="editorial in Editoriales" ng-if="editorial.editorial!==null ">
							<input type="radio" name="radioEditorial" id="input" ng-value="editorial.editorial" ng-model='Lamina.editorial' >
							{{editorial.editorial}}
						</label>
					</div>
					
					<div class="form-group">
						<input type="number"  placeholder="Cantidad" class="form-control" ng-model="Lamina.cantidad">
					</div>
					<div class="form-group">
						<textarea  class="form-control" placeholder="Descripción" rows="5"  ng-model='Lamina.descripcion' ng-bind-html="Lamina.descripcion"></textarea>
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" ng-click="deleteLamina(Lamina)" data-dismiss="modal">Eliminar</button>
				<button type="button" class="btn btn-default" ng-click="cancelarEditar(Lamina)" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary" ng-click="updateLamina()">Guardar Cambios</button>
			</div>
		</div>
	</div>
</div>


	<div class="modal fade" id="Agregar">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Agregar Laminas </h4>
						<!-- <div ng-if="Status.createListLamina!=200">Cargando ... </div> -->
						<div ng-if="State.createListLamina">
							{{Message.createListLamina}} 
							<ul ng-repeat="success in Data.createListLamina.Success">
								<li class="alert-message alert-message-success">{{success.numero}} {{success.titulo}} {{success.editorial}}</li>
							</ul>
						</div>
						<div ng-if="State.createListLamina ">
							<ul ng-repeat="Error in Data.createListLamina.Error">
								<li class="alert-message alert-message-danger">{{Error.numero}} {{Error.titulo}} {{Error.editorial}}</li>
							</ul>
						</div>
					</div>
					<div class="modal-body" ng-init="Editoriales">
						<table class="table table-striped table-hover table-lg">
							<thead>
								<tr>
									<th>Número</th>
									<th>Título</th>
									<th>Editorial <a href="#NuevaEditorial" data-toggle="modal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></th>
									<th>Cantidad</th>
									<th>Descripción</th>
									<th><a ng-click="addListLamina()" class="btn btn-success btn-md"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></th>
								</tr>
							</thead>
							<tbody>
								
								<tr ng-repeat="lamina in NuevasLaminas">
								
									<td>
										<input type="number"  ng-model="lamina.numero" value=0 class="form-control"   placeholder="#" required>
									</td>
									<td>
										<input type="text"  ng-model="lamina.titulo" value="" class="form-control" placeholder="Título" required>
									</td>
									<td>
										<select class="form-control" ng-model="lamina.editorial" required>
											<option ng-repeat="editorial in Editoriales"  ng-value="editorial.editorial" ng-if="editorial.editorial!==null" required>{{editorial.editorial}}</option>
										</select>

									</td>
									<td>
										<input type="number"  ng-model="lamina.cantidad" value=0 class="form-control"  required="required" placeholder="#">
									</td>
									<td>
										<textarea class="form-control" rows="3" required="required" value=""  ng-model="lamina.descripcion" placeholder="Descripción"></textarea>
									</td>
									<td>
										<a ng-click="removeListLamina(lamina)" class="btn btn-danger btn-md"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<!-- <button type="button" class="btn btn-primary" href="#modal-id" >Guardar</button> -->
						<a class="btn btn-primary" data-toggle="modal" href='#guardarCambios'>Guardar</a>
					</div>
				</div>
			</div>
		</div>
		


<div class="modal fade" id="NuevaEditorial">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Nueva Editorial</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					
					<div class="col-sm-10">
						<input type="text" ng-model="nuevaEditorial" class="form-control"  required="required" placeholder="Editorial">
					</div>
				</div>
				<br>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" ng-click="AgregarEditorial()"	data-dismiss="modal" class="btn btn-primary">Agregar</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="guardarCambios">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Desea guardar los Cambios?</h4>
			</div>
			<div class="modal-body">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="createListLamina()">Aceptar</button>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="Vender">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Venta : {{ListVenta.numero}}-{{ListVenta.titulo|htmlToPlaintext}}-{{ListVenta.editorial}} </h4>
				<h3>{{Message.vender}}</h3>
			</div>
			<div class="modal-body">
				<label for="cantidad">Cantidad</label>
				<input type="number" ng-model="ListVenta.c" id="input" class="form-control"  min=1 max={{ListVenta.cantidad}}  required>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success btn-success-lg" ng-click="vender()">Venta</button>
			</div>
		</div>
	</div>
</div>