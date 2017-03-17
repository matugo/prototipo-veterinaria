<?php 
include 'config.php';
//include( "config.php" ); //Aquí se traen los parámetros de la base de datos.
class operaciones
{
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
	function traer_lista_informacion( $nombre_lista, $tabla, $campo_llave_primaria, $campo_a_mostrar )
	{
		
		$salida = "";
		//------------SQL Se traen datos----------------------------------------------------
		$sql = "SELECT * FROM  $tabla ";
		
		//if( $sn_pruebas == "s" ) echo "<div class='contenedor-sql-pruebas'>".$sql."</div>";
		$conexion = mysqli_connect('localhost','root','','bd_clinica');
		$resultado = $conexion-> query($sql);	
		$salida .= "<SELECT NAME='sintomas[] ' multiple id='lista' onclick='tomar_sintomas()' class='form-control' size='20'>"  ;
		//$salida .= "<OPTION VALUE='-1'>sintomas</OPTION>";
		while( $fila = mysqli_fetch_assoc( $resultado ) )
		{
			$salida .= "<OPTION VALUE='".$fila[ $campo_llave_primaria ]."'>".$fila[ $campo_a_mostrar ]."</OPTION>";
		}
		$salida .= "</SELECT>";
		return $salida;	
	}
	function calcular_enfermedad($sintomas)
	{
		$salidad="";
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
				//echo"<tr>";
						echo "<td width='200px';height='50px';>"  . $fila['enfermedad'] . "</td>";
						echo "<br>";
						echo "<td width='200px';height='50px';>" ."<img src='" . $fila['url'] . "'>"."</td>";
					echo"</tr>";
				}
		echo "</table>";
	
			
		
	}
//
}
?>
