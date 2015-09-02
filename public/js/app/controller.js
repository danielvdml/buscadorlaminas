(function () {
	angular.module('BuscadorLaminas.controllers',[])

		.controller('ConsultaLaminaController',['$scope','$http','$location',function($scope,$http,$location){
			$scope.Titulo="Buscador de Laminas Escolares";
			$scope.url_index=document.getElementById('url_index').value;			
			$scope.message=[];
			$scope.NuevasLaminas=[];
			$scope.Laminas=[];
				
			$scope.Buscar={
				'keyword':'',
				'editorial':''
			};
			$scope.refrescarLaminas=function(data){
				L=$scope.Laminas;
				data.forEach(function(l){
					l["keyword"]=l["numero"]+" "+l["titulo"]+" "+l["descripcion"]+" "+l["editorial"];
					L.push(l);
				});
				$scope.Laminas=L;
			};
			$scope.getLaminas=function(){
				$http.get($scope.url_index+"/getLaminas")
					.success(function(data){
						// data.forEach(function(l){
						// 	l["keyword"]=l["numero"]+" "+l["titulo"]+" "+l["descripcion"]+" "+l["editorial"];
						// });
						$scope.refrescarLaminas(data);
						// $scope.Laminas=data;
						
					})
					.error(function(data){
						$scope.message["getLaminas"]="Error al obtener Laminas";
					});
			};

			$scope.getEditoriales=function(){
				$http.get($scope.url_index+'/getEditoriales')
					.success(function(data){
						$scope.Editoriales=data;
					})
					.error(function(data){
						$scope.message["getEditoriales"]="Error al obtener las editoriales";
					});	
			};
			$scope.AgregarEditorial=function(){
				l=$scope.Editoriales;
				var exit=false;
				if($scope.nuevaEditorial.length>=3){
					for (var i = 0 ; i <  l.length ; i++) {
						if($scope.nuevaEditorial==l[i].editorial){
							exit=true;
						}
					}
					if(!exit) $scope.Editoriales.push({"editorial":$scope.nuevaEditorial});
				}
				
			};

			$scope.EditLamina=function(lamina){
				$scope.Lamina=lamina;
			};

			$scope.updateLamina=function(lamina){
				$http.post($scope.url_index+'/updateLamina',$scope.Lamina)
					.success(function(data){
						$scope.message["updateLamina"]="Lamina Actulizada correctamente";
						$scope.status["updateLamina"]=status;
						$scope.data["updateLamina"]=data;
						$scope.state["updateLamina"]=true;
					})
					.error(function(data){
						$scope.message["updateLamina"]=false;
					});
			};

			$scope.createLamina=function(lamina){
				$http.post($scope.url_index+'/createLamina',$scope.Lamina)
				.success(function(data,status){
						$scope.status["createLamina"]=status;
						$scope.message["createLamina"]="Lamina Creada Exitosamente";
						$scope.data["createLamina"]=data;
						$scope.state["createLamina"]=true;
					})
					.error(function(data){
						$scope.message["createLamina"]=data;
					});

			};

			$scope.EliminarLamina=function(lamina){
				$http.post($scope.url_index+'/EliminarLamina',$scope.Lamina)
					.success(function(data){
						$scope.message["EliminarLamina"]="Lamina Eliminada Exitosamente";
					})
					.error(function(data){
						$scope.message["EliminarLamina"]=data;
					});
			};
			$scope.vender=function(id,cantidad){
				$http.post($scope.url_index+'/vender',{"id":id,"cantidad":cantidad})
				.success(function(data){
					$scope.message["vender"]=data;
				})
				.error(function(data) {
					$scope.message["vender"]=data;
				});
			};

			$scope.createListLamina=function(){
				$http.post($scope.url_index+'/createListLamina',$scope.NuevasLaminas)
				.success(function(data){
					l=$scope.Laminas;
					data["Success"].forEach(function(i){
						l.push(i);
					});
					$scope.Laminas=l;
					$scope.message["createListLamina"]="Las siguientes laminas han sido agregadas correctamente";
					$scope.state["createListLamina"]=true;
					$scope.data["createListLamina"]=data["Success"];
					$scope.status["createListLamina"]=status;
				})
				.error(function(data){
					$scope.message["createListLamina"]=data["Error"];
				})
			};
			$scope.cancelarEditar=function(lamina){
				$scope.Lamina={};
			};
			$scope.addListLamina=function(){
				id_=$scope.NuevasLaminas.length+1;
				NuevaLamina={'id_':id_,'numero':'','editorial':'','cantidad':0,'descripcion':"",'titulo':''};
				$scope.NuevasLaminas.push(NuevaLamina);
			};
			$scope.removeListLamina=function(lamina){
				ListAux=$scope.NuevasLaminas;
				$scope.NuevasLaminas=[];
				angular.forEach(ListAux, function(l){
					if(lamina["id_"]!==l["id_"]){
						$scope.NuevasLaminas.push(l);
					}
				});
			};
			$scope.deleteLamina=function(lamina){
				$http.post($scope.url_index+'/deleteLamina',lamina)
					.success(function(data){
						$scope.message["deleteLamina"]=data;						
						ListAux=$scope.Laminas;
						$scope.Laminas=[];
						ListAux.forEach(function(l){
							if(lamina["id"]!=l["id"]){
								$scope.Laminas.push(l);
							}
						});	
						$scope.Laminas=ListAux;
						// $scope.refrescarLaminas($scope.Laminas);
					})
					.error(function(data){
						$scope.message["deleteLamina"]=data;
					});
			};



		}]);

})();
