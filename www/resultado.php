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
 if (isset($_GET['busqueda'])) {
 		
 		header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        include 'config.php';
        $conn = new mysqli( $servidor, $usuario, $clave, $base_de_datos );
        $buscar = utf8_decode($_GET['busqueda']));
        //echo $buscar.length
		
		$buscar = (explode(',',$buscar));
		 if ($_GET['busqueda']=="manual tecnico"||$_GET['busqueda']=="uml") {
	        $sql= "SELECT * FROM tb_ayuda";
	        }else{
		//echo $buscar[0];*/
		
        //Se busca principalmente por alias.
       	$outp="";
			$sql = " SELECT * FROM tb_ayuda WHERE ";
			for ($i=0; $i < count($buscar) ; $i++) { 
				$sql.= " ayuda LIKE '%".$buscar[$i] ."%'  ";
				$sql.= " or texto LIKE '%".$buscar[$i] ."%'";
				$sql.= " or palabras_claves LIKE '%".$buscar[$i] ."%'";
				if ($i < (count($buscar)-1) ) $sql .= " or ";
			}
			}
        //echo $sql;
        //LA tabla que se cree debe tener la tabla aquí requerida, y los campos requeridos abajo.
        $result = $conn->query( $sql );
        
        $outp = "";
	        while ($rs = mysqli_fetch_assoc($result))
	        {
				
					//$conteo= $rs['conteo_sintomas'];
	            	//Mucho cuidado con esta sintaxis, hay una gran probabilidad de fallo con cualquier elemento que falte.
		            if ($outp != "") {$outp .= ",";}
		            $outp .= '{"Img":"' . $rs['url']  . '",';
		            $outp .= '"Titulo":"'.utf8_encode($rs["ayuda"]).'",';            // <-- La tabla MySQL debe tener este campo.
		            $outp .= '"Texto":"'.utf8_encode($rs["texto"]).'"}';
		            //$outp .= '"Texto":"'.utf8_encode($rs["palabras_claves"]).'"}';          // <-- La tabla MySQL debe tener este campo.
	        }
        
        $outp ='{"records":['.$outp.']}';
        $conn->close();
        
        echo($outp);
    //}
 }


 ?>
