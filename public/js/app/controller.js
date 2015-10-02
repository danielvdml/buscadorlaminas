(function () {
	angular.module('BuscadorLaminas.controllers',['ngSanitize'])

		.controller('ConsultaLaminaController',['$scope','$http','$location','$timeout',function($scope,$http,$location,$timeout){
			$scope.Titulo="Buscador de Laminas Escolares";
			$scope.url_index=document.getElementById('url_index').value;			
			$scope.Message=[];
			$scope.Data=[];
			$scope.Status=[];
			$scope.State=[];
			$scope.NuevasLaminas=[];
			$scope.Laminas=[];
			$scope.Editar=false;
			$scope.Buscar={
				'keyword':'',
				'editorial':''
			};
			// $scope.refrescarLaminas=function(data){
				
			// 	data.forEach(function(l){
			// 		l["keyword"]=l["numero"]+" "+l["titulo"]+" "+l["descripcion"]+" "+l["editorial"];
			// 		$scope.Laminas.push(l);
			// 	});
				
			// };
			$scope.getLaminas_1=function(event){
				if(event.keyCode==13){
					$http.get($scope.url_index+"/getLaminas/"+$scope.keyword)
						.success(function(data){
							$scope.Laminas=data;						
						})
						.error(function(data){
							$scope.Message["getLaminas"]="Error al obtener Laminas";
						});
				}
			};
			// $scope.getLaminas=function(){
			// 	$http.get($scope.url_index+"/getLaminas")
			// 		.success(function(data){
			// 			// data.forEach(function(l){
			// 			// 	l["keyword"]=l["numero"]+" "+l["titulo"]+" "+l["descripcion"]+" "+l["editorial"];
			// 			// });
			// 			$scope.refrescarLaminas(data);
			// 			// $scope.Laminas=data;
						
			// 		})
			// 		.error(function(data){
			// 			$scope.message["getLaminas"]="Error al obtener Laminas";
			// 		});
			// };

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
					.success(function(data,status){
						$scope.Status["updateLamina"]=status;
						$scope.Data["updateLamina"]=data;
						$scope.State["updateLamina"]=true;
						$scope.Message["updateLamina"]="Lamina Actulizada correctamente";
						$timeout(function(){$scope.State["updateLamina"]=false;},3000);
					})
					.error(function(data){
						$scope.State["updateLamina"]=false;
					});
			};

			$scope.createLamina=function(lamina){
				$http.post($scope.url_index+'/createLamina',$scope.Lamina)
				.success(function(data,status){
						$scope.Status["createLamina"]=status;
						$scope.Message["createLamina"]="Lamina Creada Exitosamente";
						$scope.Data["createLamina"]=data;
						$scope.State["createLamina"]=true;
					})
					.error(function(data){
						$scope.Message["createLamina"]=data;
					});

			};

			// $scope.EliminarLamina=function(lamina){
			// 	$http.post($scope.url_index+'/EliminarLamina',$scope.Lamina)
			// 		.success(function(data){
			// 			$scope.Message["EliminarLamina"]="Lamina Eliminada Exitosamente";
			// 		})
			// 		.error(function(data){
			// 			$scope.message["EliminarLamina"]=data;
			// 		});
			// };
			$scope.VentaLamina=function(lamina){
				$scope.Message["vender"]="";
				$scope.ListVenta=lamina;
			};

			$scope.vender=function(){
				$http.post($scope.url_index+'/vender',{"id":$scope.ListVenta["id"],"cantidad":$scope.ListVenta["c"]})
				.success(function(data){
					$scope.ListVenta["cantidad"]=data["cantidad"];
					$scope.Message["vender"]=data['Message'];
				})
				.error(function(data) {
					$scope.Message["vender"]=data;
				});
			};

			$scope.createListLamina=function(){
				$http.post($scope.url_index+'/createListLamina',$scope.NuevasLaminas)
				.success(function(data,status){
					
					$scope.Message["createListLamina"]="Las siguientes laminas han sido agregadas correctamente";
					$scope.State["createListLamina"]=true;
					$scope.Data["createListLamina"]=data;
					$scope.Status["createListLamina"]=status;
					$timeout(function(){$scope.State["createListLamina"]=false;},3000);
				})
				.error(function(data){
					$scope.message["createListLamina"]=data;
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
					.success(function(data,status){
											
						ListAux=$scope.Laminas;
						$scope.Laminas=[];
						ListAux.forEach(function(l){
							if(lamina["id"]!=l["id"]){
								$scope.Laminas.push(l);
							}
						});	
						

						$scope.Message["deleteLamina"]="Lamina eliminada Exitosamente";
						$scope.Data["deleteLamina"]=data;
						$scope.State["deleteLamina"]=true;
						$scope.Status["deleteLamina"]=status;
						$timeout(function(){$scope.State["deleteLamina"]=false;},3000);
					})
					.error(function(data){
						$scope.Message["deleteLamina"]=data;
					});
			};

		}])
		.filter('htmlToPlaintext', function() {
			    return function(text) {
			      return  text ? String(text).replace(/<[^>]+>/gm, '') : '';
			    };
		});

})();
