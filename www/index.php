<!--
 Author: Marco Gonzalez-Alirio Obregon
 ADSI
 1132133
-->
<!DOCTYPE html>
<?php 
include'operations.php'; 
$mi_obj=new operaciones;
?>
<html ng-app="App">
<head>
	<title>Veterinaria </title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/angular.min.js"></script>
</head>
<body>
	<div ng-controller="App-control">
		<div class="row">
			<div class="col-xs-12 col-md-2">
				<center><h2>Sintomas</h2></center>
				<?php 
						echo $mi_obj->traer_lista_informacion("dato5",'tb_sintomas', "id_sintomas", "sintomas" );
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
					<img src="{{ x.Url}} ">
				</div>
				</div>
				</div>
				
			</div>
				{{Alirio}}
		</center>
		<div class="col-xs-12 col-md-4">
			
				<h2>Busqueda</h2>
				<input type="text" placeholder="Buscar" class="form-control" ng-model="text_busqueda" ng-change="buscar();"><hr>
				<div ng-repeat="x in row"><!--Es esencial para que muestre en pantalla los datos que se encuentrán en la base de datos  *  It is essential to display on screen the data that is in the database
-->
					<div class='row'>
						<div class='col-xs-12 col-md-10S ' style="text-align: justify;">
											            
				            
		                    <strong><li>{{ x.Titulo }}</li></strong><!--trae en pantalla el titulo de una consulta  *  Brings the title of a query
-->
		                    <br>
		                    {{ x.Texto }} <!--trae en pantalla la descripción de una consulta  *  Brings the description of a query
-->
						</div>
							  
						<div class='col-xs-12 col-md-10 '>
						<br>
						   	<img class="img img-responsive" src="{{ x.Img }}" width="500%"><!--trae en pantalla la imagen de una consulta  *  Brings the image of a query on screen-->

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
						function ($scope,$http)
						{
							//console.log("funcionando");
							$scope.saludo= function(a)
							{
								//$scope.Alirio= "funcionando";
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
									.then(function (response) {$scope.campos = response.data.records;});
								
								}

							}

							$scope.buscar = function(a)
			                {
			                    var buscar = $scope.text_busqueda;    
			                    console.log(buscar);
			                    //Aquí se hace el llamado a un php con conexión a MySQL. Here is the call to a php with connection to MySQL
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
