<!--
 Autor Marco Gonzalez-Alirio Obregon-Edwar Cruz
 ADSI
 1132133
-->
<!DOCTYPE html>
<?php 
include'operaciones.php'; 
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
				<input type="text" placeholder="Buscar" class="form-control"><hr>
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
									$http.get("resultado.php?cadena=" + salida)
									.then(function (response) {$scope.campos = response.data.records;});
								
								}

							}
							
						}
					]

				);
						
	</script>
</body>
</html>
