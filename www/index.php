<!--
 autor Marco Gonzalez-Alirio Obregon
 ADSI
 1132133
-->
<?php 
include'operaciones.php'; 
$mi_obj=new operaciones;
?>

<html ng-app>
<head>
	<title>Marck-Alix</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/funciones.js"></script>
	<script type="text/javascript" src="js/angular.min.js"></script>
</head>
	<body>

		<form action="" method="POST">

			<div class="col-xs-12 col-md-2">

			<br>
			<h2>Sintomas</h2> <br><br>

			<?php 
			echo $mi_obj->traer_lista_informacion("dato5",'tb_sintomas', "id_sintomas", "sintomas" );
			 ?>
			<br>
			<input type="hidden" name="salida"	id="cont-salida">
			<br>		
			
			<input type="submit" value="aceptar" class="btn btn-info" ng-change="calcular_enfermedad()"/> 
			<br>
			
			</form>
			</div>
				<div class="col-xs-12 col-md-8">
				<?php
					 
					if ($_POST){
						$valores=$_POST['salida'];
					echo $mi_obj->calcular_enfermedad($valores);
					"<br>";
					}
				 ?>
				 <br>
			</div>

	</body>
</html>
