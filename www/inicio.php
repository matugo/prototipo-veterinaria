<!--
 Author Marco Gonzalez-Alirio Obregon
 ADSI
 1132133
-->
<!DOCTYPE html>
<?php
include'class/operations.php'; 
$mi_obj=new operaciones;
?>
<html ng-app="App">
	<head>
		<title>Veterinary</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<script type="text/javascript" src="js/angular.min.js"></script>
	</head>

	<body>
		<div ng-controller="App-control">
			<div class="row">
				<div class="col-xs-12 col-md-2">
					<center><h2>Symptom</h2></center>
					<?php 
							echo $mi_obj->bring_list_information("dato5",'tb_sintomas', "id_sintomas", "sintomas" );
					?>
					<br>
				
				</div>

				<center>
					<br>
					<div class="col-xs-12 col-md-4">
						<div ng-repeat="x in campos">
						<div class="row">
						<div class="col-xs-12 col-md-3">
							{{ x.Enfermedad}}
						</div>
						<br>
						<div class="col-xs-12 col-md-9">
							<img ng-src="{{ x.Url}} ">
						</div>
						</div>
						</div>
						
					</div>
						{{Alirio}}
				</center>

				<div class="col-xs-12 col-md-4">
				
					<h2>Search</h2>
					<input type="text" placeholder="Buscar" class="form-control" ng-model="text_busqueda" ng-change="search();"><hr>
					<div ng-repeat="x in row"><!--Es esencial para que muestre en pantalla los datos que se encuentrán en la base de datos-->
						<div class='row'>
							<div class='col-xs-12 col-md-10S ' style="text-align: justify;">
												            
					            
			                    <strong><li>{{ x.Titulo }}</li></strong><!--trae en pantalla el titulo de una consulta-->
			                    <br>
			                    {{ x.Texto }} <!--trae en pantalla la descripción de una consulta-->
							</div>
								  
							<div class='col-xs-12 col-md-10 '>
								<br>
							   	<img class="img img-responsive" ng-src="{{ x.Img }}" width="500%"><!--trae en pantalla la imagen de una consulta-->

						    </div>
				    	</div>
				    	<br><hr>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			var acomuladorApp= angular.module('App',[]);

				acomuladorApp.controller ('App-control',
						["$scope","$http",
							function ($scope,$http)/*------------------------------------------*/
							{
								//console.log("funcionando");
								$scope.saludo= function(a)/*------------------------------------------*/
								{
									//$scope.Alirio= "funionando";
									var lista = document.getElementById( "lista" );
									var con_salida = document.getElementById( "con-salida" );
									var salida = "";
									var volver = "";
									var conteo = 0;
									console.log( "toda la lista: " + lista.length );
									for( var i = 0; i < lista.length; i++)
									{
										if( lista.item( i ).selected )
										{
											if (salida == "")
											{
												salida+= lista.item( i ).value;
											}else{
												salida+= ","+lista.item( i ).value;
											}

											conteo ++;
										
										}
									}
									$scope.sintomas=salida;
									if(salida.length != "" )
									{
										$http.get("result.php?cadena=" + salida)
										.then(function (response) {$scope.campos = response.data.records;}); /*------------------------------------------*/
									
									}

								}
 
								$scope.search = function(a)/*------------------------------------------*/
				                {
				                    var buscar = $scope.text_busqueda;    
				                    console.log(buscar);
				                    //Aquí se hace el llamado a un php con conexión a MySQL.
				                     $http.get( "result.php?busqueda=" + buscar )
				                    .then(function( response ){ $scope.row = response.data.records;  }
				                    );                                       
				                }
								
							}
						]

					);
							
		</script>
	</body>
</html>
