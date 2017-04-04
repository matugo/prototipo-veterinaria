<?php 

include 'config.php';
//include( "config.php" ); //Aquí se traen los parámetros de la base de datos.

class operaciones
{


	/**
	*Descrición : 		Esta funcion consiste en imprimir resultados.
	*@param 	text 	llamado de la tabla de valores, de la base de datos.
	*@param 	text 	Aqui Llamamos el campo de la tabla.
	*@param 	text 	Se debe de tener unos requerimientos en la función.
	*@return 	text 	dato de salida de la tabla selecionada.
	**/
function retornar_dato_tabla( $tabla, $campo_a_retornar, $condicion = null )
	{
		
		//Hay que recordar que solo debería existir un archivo que permita dicha configuración.
		$salida = "";

		//------------SQL Se traen datos----------------------------------------------------
		$sql = "SELECT $campo_a_retornar AS dato_de_salida FROM $tabla ";
		//if( $condicion != null ) $sql .= " WHERE $condicion ";

		//if( $sn_pruebas == "s" ) echo "<div class='contenedor-sql-pruebas'>".$sql."</div>";

		$conexion = mysqli_connect('localhost','root','','bd_clinica');
		$resultado = $conexion-> query($sql);	

		//Si se encuentran datos se retornarán. De lo contrario la función no retornará o retornará vacío.
		if( mysqli_num_rows( $resultado ) > 0 )
		{
			while( $fila = mysqli_fetch_assoc( $resultado ) )
			{
				$salida = $fila[ 'dato_de_salida' ];
			}
		}
		return $salida;
	} 



	/**
	*Descrición : 		Esta funcion me trae todos los valores de la lista.
	*@param 	text 	llamado del identificador de la lista.
	*@param 	text 	Aqui Llamamos el campo de la tabla.
	*@param 	text 	La llave primaria de una tabla.
	*@param 	text 	nos muestra el campo en pantalla
	*@return 	text 	Imprime los resultados de los datos seleccionados.
	**/
	function traer_lista_informacion( $nombre_lista, $tabla, $campo_llave_primaria, $campo_a_mostrar )
	{
		

		$salida = "";

		//------------SQL Se traen datos----------------------------------------------------
		$sql = "SELECT * FROM  $tabla ";
		
		//if( $sn_pruebas == "s" ) echo "<div class='contenedor-sql-pruebas'>".$sql."</div>";

		$conexion = mysqli_connect('localhost','root','','bd_clinica');
		$resultado = $conexion-> query($sql);	

		$salida .= "<SELECT NAME='sintomas[] ' multiple id='lista' ng-model='select' class='form-control' size='20' ng-change='saludo();' >";
		//$salida .= "<OPTION VALUE='-1'>sintomas</OPTION>";

		while( $fila = mysqli_fetch_assoc( $resultado ) )
		{
			$salida .= "<OPTION VALUE='".$fila[ $campo_llave_primaria ]."'>".$fila[ $campo_a_mostrar ]."</OPTION>";
		}

		$salida .= "</SELECT>";

		return $salida;	
	}

	/**
	*Descrición : 		Esta funcion consiste en calcular la enfermedad y dar una impresion.  
	*@param 	text 		
	*@return 	text 	
	**/


	function calcular_enfermedad($sintomas)
	{
		$salida="";
		//$sintomas=$_POST["sintomas"];
		//echo $sintomas;
		$sql="";
		$cantidad=0;
			//$datos= $sintomas[$i];
			$sql.="SELECT * FROM  tb_relacion t1, tb_enfermedad t2, tb_sintomas t3 WHERE t1.id_enfermedad = t2.id_enfermedad AND t1.id_sintomas = t3.id_sintomas AND t1.id_sintomas IN (". $sintomas." ) GROUP BY t1.id_enfermedad";
			//echo $sql;
			

			
			$conexion = mysqli_connect('localhost','root','','bd_clinica');
			$resultado = $conexion-> query($sql);
		echo "<table>";

				while (  $fila = mysqli_fetch_assoc( $resultado ) )
						 {
				echo"<tr>";
						echo "<td width='200px';height='50px';>"  . $fila['enfermedad'] . "</td>";
						echo "<br>";
						echo "<td width='200px';height='50px';>" ."<img src='" . $fila['url'] . "'>"."</td>";
					echo"</tr>";

				}
		echo "</table>";

	}

	function buscar($busqueda)
	{
		    
	       
	        /*Esta conexión se realiza para la prueba con angularjs*/
	        header("Access-Control-Allow-Origin: *");
	        header("Content-Type: application/json; charset=UTF-8");

	         include( "config.php" );
	        $busqueda=$_GET['busqueda'];
	        $conn = new mysqli( $servidor, $usuario, $clave, $base_de_datos );
	        
	        //Se busca principalmente por alias.
	        
	        $consulta = explode(",", $busqueda);
	        //echo $consulta;
	        $sql  = " SELECT * FROM tb_ayuda  WHERE ";
	        for ($i=0; $i < count($consulta); $i ++) { 
	        	
	        	$sql .= " ayuda LIKE '%".$consulta[$i]."%'";
	        	$sql .= " palabras_claves LIKE '%".$consulta[$i]."%'";
	        	//$sql .= " OR definicion LIKE '%".$consulta[$i]."%'";
	        	if ($i < (count($consulta)-1)) $sql.=" or ";

	        }
	        
	        //echo $sql;
	        //LA tabla que se cree debe tener la tabla aquí requerida, y los campos requeridos abajo.
	        $result = $conn->query( $sql );
	        
	        $outp = "";
	        
	        while($rs = mysqli_fetch_assoc($result)) 
	        {
	            //Mucho cuidado con esta sintaxis, hay una gran probabilidad de fallo con cualquier elemento que falte.
	            if ($outp != "") {$outp .= " , ";}
	            
	            $outp .= '{"Titulo":"'.$rs["ayuda"].'",';
	            $outp .= '"Descripcion":"'.utf8_encode($rs["texto"]).'",';     // <-- La tabla MySQL debe tener este campo.
	            $outp .= '"Imagen":"'.$rs["url"].'"}';

	        }
	        //echo $sql;
	        $outp ='{"records":['.$outp.']}';
	        $conn->close();
	        
	        echo($outp);
	    
	     
	}
}

?>
