<?php 	

if(isset($_GET['cadena']))
{

		header("access-control-allow-origin: *");
		header("content-type: application/json; charset=UTF-8");
		include 'config.php';
		$conexion = new mysqli($servidor,$usuario,$clave,$base_de_datos);
		$salida="";
		$sql="";
		$sql.="SELECT * FROM  tb_relacion t1, tb_enfermedad t2, tb_sintomas t3 WHERE t1.id_enfermedad = t2.id_enfermedad AND t1.id_sintomas = t3.id_sintomas AND t1.id_sintomas IN (". $_GET['cadena']." ) GROUP BY t1.id_enfermedad";
		//echo $sql;
		$result= $conexion->query( $sql );
		while ($rs = mysqli_fetch_assoc($result))
		{
			if ($salida != "") $salida.= " , ";
			$salida.= '{"Enfermedad":"'. $rs['enfermedad'] .'", ';
			$salida.= '"Url":" '. $rs['url'] .' "} ';
		}
		$salida ='{"records":['.$salida.']}';
		$conexion -> close();
		echo ($salida);
}



