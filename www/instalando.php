<?php

	/**
	* Autor: Camilo Figueroa
	* Este programa creará una base de datos con todos sus componentes. La prueba sería usar este script y después mirar 
	* que efectivamente exportándola y creando el gráfico del modelo entidad relación, todos sus componentes estén ahí.
	*
	* En este programa se usan tanto la programación estructurada, como las funciones y la POO.
	*/

	include( "Verificador.php" ); //Se incluye la clase verificador, la idea es no hacer este código más grande.
	include 'sql_insert.php'; //se incluye el archivo de la informacion que esta en las tablas.
	$objeto_verificador = new Verificador(); //Se crea la instancia de la clase verificador.

	define( "NUMERO_DE_TABLAS", 2 ); //Se define el número de tablas que se va a crear. 

	$contador_variables_llegada = 0; 
	$cadena_informe_instalacion = ""; 
	$interrupcion_proceso = 0;
	$imprimir_mensajes_prueba = 0;  //Usar valores 0 o 1, solo para el programador.
	$tmp_nombre_objeto_o_tabla = "";

	$mensaje1 = "Es posible que la tabla o el objeto ya esté creada(o), por favor reinicie la instalación con una base de datos vacía.";

	if( isset( $_GET[ 'servidor' ] ) ) 		$contador_variables_llegada ++;
	if( isset( $_GET[ 'usuario' ] ) ) 		$contador_variables_llegada ++;
	if( isset( $_GET[ 'contrasena' ] ) ) 	$contador_variables_llegada ++;
	if( isset( $_GET[ 'bd' ] ) ) 			$contador_variables_llegada ++;

	if( $imprimir_mensajes_prueba == 1 ) echo "<br>Llegaron ".$contador_variables_llegada." variables.";
	
	//Tienen que llegar cuatro variables para poder dar continuación al proceso de instalación.
	if( $contador_variables_llegada >= 3 && $contador_variables_llegada <= 4 ) // Super if - inicio
	{
		if( $imprimir_mensajes_prueba == 1 ) echo "<br>Entrando al bloque de instalaci&oacute;n.";

		//Se realiza una sola conexión para la ejecución de todas las consultas SQL.-------------------------------
		//$conexion = @mysqli_connect( $_GET[ 'servidor' ], $_GET[ 'usuario' ], $_GET[ 'contrasena' ], $_GET[ 'bd' ] ); //Linea anterior, salía error de conexión.
		$conexion = @mysqli_connect( $_GET[ 'servidor' ], $_GET[ 'usuario' ], $_GET[ 'contrasena' ], $_GET[ 'bd' ] ); //Ojo, con el arroba no sale el mensaje de error.

		if( !$conexion ) //Verificamos que la conexion esté establecida preguntando si hay error o conexión no existe.
		{
			$interrupcion_proceso = 1; //Si pasa a este bloque, la conexión no se ha establecido, quiere decir que activaremos la variable de interrupción.
			$cadena_informe_instalacion .= "<br>Error: no se ha podido establecer una conexión con la base de datos. ";

		}else{

				//echo "1 fds<br>".$objeto_verificador->mostrar_tablas( $conexion, 2 );

				if( $objeto_verificador->mostrar_tablas( $conexion, 2 ) != 0 ) //Aquí se verifica que no hayan tablas existentes.
				{
					//echo "2 fds<br>";

					echo "Ya hay tablas creadas, por favor cree una base de datos nueva.<br>"; 
					$interrupcion_proceso = 1;
				}
			}

		if( $interrupcion_proceso == 0 ) //Si esta variable cambia, la instalación será interrumpida para cada bloque sql.
		{
			$tmp_nombre_objeto_o_tabla = "tb_usuario";


			$sql  = " CREATE TABLE IF NOT EXISTS $tmp_nombre_objeto_o_tabla ( ";
			$sql .= " documento varchar(50) NOT NULL, ";
			$sql .= " nombre varchar(50) NOT NULL, ";
			$sql .= " id_relacion int(11) NOT NULL, ";
			$sql .= " id_ayuda int(11) NOT NULL, ";
			$sql .= " fecha_ingreso date NOT NULL, ";
			$sql .= " PRIMARY KEY (documento), ";
			$sql .= " KEY indice_id_relacion (id_relacion), ";
			$sql .= " KEY indice_id_ayuda (id_ayuda) ";
			$sql .= " ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1  ";



			
			$resultado = $conexion->query( $sql );

			//Si se creó la tabla, el sistema cargará los datos pertienentes del informe.
			if( verificar_existencia_tabla( $tmp_nombre_objeto_o_tabla, $_GET[ 'servidor' ], $_GET[ 'usuario' ], $_GET[ 'contrasena' ], $_GET[ 'bd' ], $imprimir_mensajes_prueba ) == 1 )
			{
				$cadena_informe_instalacion .= "<br>La tabla $tmp_nombre_objeto_o_tabla se ha creado con éxito.";	
				$resultado = $conexion->query( $sql_usuario );
			}else{
					$cadena_informe_instalacion .= "<br>Error: La tabla $tmp_nombre_objeto_o_tabla no se ha creado. ".$mensaje1;	
					$interrupcion_proceso = 1;
				}
		}

		if( $interrupcion_proceso == 0 ) //Si esta variable cambia, la instalación será interrumpida para cada bloque sql.
		{
			$tmp_nombre_objeto_o_tabla = "tb_sintomas";

			//El sistema procederá a crear la primera tabla si no existe.			
			$sql  = " CREATE TABLE IF NOT EXISTS $tmp_nombre_objeto_o_tabla ( ";
			$sql .= " id_sintomas int(11) NOT NULL, ";
			$sql .= " sintomas varchar(999) NOT NULL, ";
			$sql .= " PRIMARY KEY (id_sintomas), ";
			$sql .= " KEY indice_sintomas (sintomas) ";
			$sql .= " ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1  ";
			$resultado = $conexion->query( $sql );

			//Si se creó la tabla, el sistema cargará los datos pertienentes del informe.
			if( verificar_existencia_tabla( $tmp_nombre_objeto_o_tabla, $_GET[ 'servidor' ], $_GET[ 'usuario' ], $_GET[ 'contrasena' ], $_GET[ 'bd' ], $imprimir_mensajes_prueba ) == 1 )
			{
				$cadena_informe_instalacion .= "<br>La tabla $tmp_nombre_objeto_o_tabla se ha creado con éxito.";	
				$resultado = $conexion->query( $sql_sintomas );
			}else{
					$cadena_informe_instalacion .= "<br>Error: La tabla $tmp_nombre_objeto_o_tabla no se ha creado. ".$mensaje1;	
					$interrupcion_proceso = 1;
				}
		}



		if( $interrupcion_proceso == 0 ) //Si esta variable cambia, la instalación será interrumpida para cada bloque sql.
		{
			$tmp_nombre_objeto_o_tabla = "tb_relacion";


			$sql  = " CREATE TABLE IF NOT EXISTS $tmp_nombre_objeto_o_tabla ( ";
			$sql .= " id_relacion int(11) NOT NULL, ";
			$sql .= " id_sintomas int(11) NOT NULL, ";
			$sql .= " id_enfermedad int(11) NOT NULL, ";
			$sql .= " PRIMARY KEY (id_relacion), ";
			$sql .= " KEY indice_id_relacion (id_sintomas), ";
			$sql .= " KEY indice_id_ayuda (id_enfermedad) ";
			$sql .= " ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1  ";



			
			$resultado = $conexion->query( $sql );

			//Si se creó la tabla, el sistema cargará los datos pertienentes del informe.
			if( verificar_existencia_tabla( $tmp_nombre_objeto_o_tabla, $_GET[ 'servidor' ], $_GET[ 'usuario' ], $_GET[ 'contrasena' ], $_GET[ 'bd' ], $imprimir_mensajes_prueba ) == 1 )
			{
				$cadena_informe_instalacion .= "<br>La tabla $tmp_nombre_objeto_o_tabla se ha creado con éxito.";	
				$resultado = $conexion->query( $sql_relacion );
			}else{
					$cadena_informe_instalacion .= "<br>Error: La tabla $tmp_nombre_objeto_o_tabla no se ha creado. ".$mensaje1;	
					$interrupcion_proceso = 1;
				}
		}


		if( $interrupcion_proceso == 0 ) //Si esta variable cambia, la instalación será interrumpida para cada bloque sql.
		{
			$tmp_nombre_objeto_o_tabla = "tb_enfermedad";


			$sql  = " CREATE TABLE IF NOT EXISTS $tmp_nombre_objeto_o_tabla ( ";
			$sql .= " id_enfermedad int(11) NOT NULL, ";
			$sql .= " enfermedad varchar(999) NOT NULL, ";
			$sql .= " url varchar(50) NOT NULL, ";
			$sql .= " PRIMARY KEY (id_enfermedad) ";
			$sql .= " ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1  ";

			$resultado = $conexion->query( $sql );

			//Si se creó la tabla, el sistema cargará los datos pertienentes del informe.
			if( verificar_existencia_tabla( $tmp_nombre_objeto_o_tabla, $_GET[ 'servidor' ], $_GET[ 'usuario' ], $_GET[ 'contrasena' ], $_GET[ 'bd' ], $imprimir_mensajes_prueba ) == 1 )
			{
				$cadena_informe_instalacion .= "<br>La tabla $tmp_nombre_objeto_o_tabla se ha creado con éxito.";	
				$resultado = $conexion->query( $sql_enfermedad );
			}else{
					$cadena_informe_instalacion .= "<br>Error: La tabla $tmp_nombre_objeto_o_tabla no se ha creado. ".$mensaje1;	
					$interrupcion_proceso = 1;
				}
		}




		if( $interrupcion_proceso == 0 ) //Si esta variable cambia, la instalación será interrumpida para cada bloque sql.
		{
			$tmp_nombre_objeto_o_tabla = "tb_ayuda";


			$sql  = " CREATE TABLE IF NOT EXISTS $tmp_nombre_objeto_o_tabla ( ";
			$sql .= " id_ayuda int(11) NOT NULL, ";
			$sql .= " ayuda varchar(100) NOT NULL, ";
			$sql .= " texto text NOT NULL, ";
			$sql .= " url varchar(100) NOT NULL, ";
			$sql .= " palabras_claves text NOT NULL, ";
			$sql .= " PRIMARY KEY (id_ayuda) ";
			$sql .= " ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1  ";



			
			
			$resultado = $conexion->query( $sql );


			//Si se creó la tabla, el sistema cargará los datos pertienentes del informe.
			if( verificar_existencia_tabla( $tmp_nombre_objeto_o_tabla, $_GET[ 'servidor' ], $_GET[ 'usuario' ], $_GET[ 'contrasena' ], $_GET[ 'bd' ], $imprimir_mensajes_prueba ) == 1 )
			{
				$cadena_informe_instalacion .= "<br>La tabla $tmp_nombre_objeto_o_tabla se ha creado con éxito.";	
				
				$resultado = $conexion->query( $sql_ayuda );
			}else{
					$cadena_informe_instalacion .= "<br>Error: La tabla $tmp_nombre_objeto_o_tabla no se ha creado. ".$mensaje1;	
					$interrupcion_proceso = 1;
				}
		}



















		if( $interrupcion_proceso == 0 ) //Si esta variable cambia, la instalación será interrumpida para cada bloque sql.
				{
					$tmp_nombre_objeto_o_tabla = "tb_relacion_ibfk_2";
		
					//El sistema procederá a crear una de las restricciones por llave foranea.				
		
				 	$sql ="ALTER TABLE tb_relacion";
		 		 	$sql .=" ADD CONSTRAINT tb_relacion_ibfk_2 FOREIGN KEY (id_sintomas) REFERENCES tb_sintomas (id_sintomas) ON DELETE CASCADE ON UPDATE CASCADE,";
		 		 	$sql .=" ADD CONSTRAINT tb_relacion_ibfk_3 FOREIGN KEY (id_enfermedad) REFERENCES tb_enfermedad (id_enfermedad) ON DELETE CASCADE ON UPDATE CASCADE;";
		
		
				
				$resultado = $conexion->query( $sql );

			//Si se creó el objeto, el sistema cargará los datos pertienentes del informe.
			if( verificar_existencia_objeto( $tmp_nombre_objeto_o_tabla, $_GET[ 'servidor' ], $_GET[ 'usuario' ], $_GET[ 'contrasena' ], $_GET[ 'bd' ], $imprimir_mensajes_prueba ) == 1 )
			{
				$cadena_informe_instalacion .= "<br>La restricción $tmp_nombre_objeto_o_tabla se ha creado con éxito.";	

			}else{
					$cadena_informe_instalacion .= "<br>Error: La restricción $tmp_nombre_objeto_o_tabla no se ha creado. ".$mensaje1;	
					$interrupcion_proceso = 1;
				}
		}
				
				 							

if( $interrupcion_proceso == 0 ) //Si esta variable cambia, la instalación será interrumpida para cada bloque sql.
		{
			$tmp_nombre_objeto_o_tabla = "tb_usuario_ibfk_1";

			//El sistema procederá a crear una de las restricciones por llave foranea.				

		 	$sql ="ALTER TABLE tb_usuario";
  			$sql .=" ADD CONSTRAINT tb_usuario_ibfk_1 FOREIGN KEY (id_relacion) REFERENCES tb_relacion (id_relacion) ON DELETE CASCADE ON UPDATE CASCADE,";
  			$sql .=" ADD CONSTRAINT tb_usuario_ibfk_2 FOREIGN KEY (id_ayuda) REFERENCES tb_ayuda (id_ayuda) ON DELETE CASCADE ON UPDATE CASCADE;";




			//echo $sql;
			


			$resultado = $conexion->query( $sql );

			//Si se creó el objeto, el sistema cargará los datos pertienentes del informe.
			if( verificar_existencia_objeto( $tmp_nombre_objeto_o_tabla, $_GET[ 'servidor' ], $_GET[ 'usuario' ], $_GET[ 'contrasena' ], $_GET[ 'bd' ], $imprimir_mensajes_prueba ) == 1 )
			{
				$cadena_informe_instalacion .= "<br>La restricción $tmp_nombre_objeto_o_tabla se ha creado con éxito.";	

			}else{
					$cadena_informe_instalacion .= "<br>Error: La restricción $tmp_nombre_objeto_o_tabla no se ha creado. ".$mensaje1;	
					$interrupcion_proceso = 1;
				}
		}




		if( $interrupcion_proceso == 0 )
			{
				//ojo aquí se usa la clase verificadora para imprimir lo que se ha creado.
				echo $objeto_verificador->mostrar_tablas( $conexion ); //Hay que recordar que la conexión ya se creó arriba.
	
				echo "Se han creado ".$objeto_verificador->mostrar_tablas( $conexion, 2 )." tablas de ".NUMERO_DE_TABLAS." que se deb&iacute;an crear.  ";
				
				echo "<br><br>";
				echo "<a href='borrando_archivos.php' target='_self'>Proceder a borrar archivos de intalaci&oacute;n</a>";
				echo "<br><br>";
			}
			
			echo $cadena_informe_instalacion; //Se imprime un sencillo informe de la instalación.
		
	}else{ 									// Super if - else 
			echo "<br>Por favor ingresa el valor de los campos solicitados: Servidor, usuario, base de datos.<br>";
		}

		// Super if - final

	/*******************************************f u n c i o n e s*********************************************************************/

	/**
	*	Esta función se encarga de verificar si existe una tabla en el catálogo del sistema.
	*	@param 		texto 		el nombre de la tabla a buscar	
	*	@param 		texto 		el servidor para la conexión 
	*	@param 		texto 		el usuario para la conexión
	*	@param 		texto 		la contraseña para la conexión
	*	@param 		texto 		el nombre de la base de datos
	*	@return 	número 		un número con valores 0 o 1 para indicar o no la existencia de una tabla.
	*/
	function verificar_existencia_tabla( $tabla, $servidor, $usuario, $clave, $bd, $imp_pruebas = null )
	{
		$conteo = 0;

		$sql = " SELECT COUNT( * ) AS conteo FROM information_schema.tables WHERE table_schema = '$bd' AND table_name = '$tabla' ";
		if( $imp_pruebas == 1 ) echo "<br><strong>".$sql."</strong><br>";
		$conexion = mysqli_connect( $servidor, $usuario, $clave, $bd  );
		$resultado = $conexion->query( $sql );

		while( $fila = mysqli_fetch_assoc( $resultado ) )
		{
			$conteo = $fila[ 'conteo' ]; //Si hay resultados la variable será afectada.
		}

		return $conteo;
	}

	/**
	*	Esta función se encarga de verificar si existe una restricción en el catálogo del sistema. Por supuesto esta función y la
	*	de búsqueda de tablas podría ser una sola, generalizando mejor y refactorizando el código.
	*	@param 		texto 		el nombre del objeto a buscar	
	*	@param 		texto 		el servidor para la conexión 
	*	@param 		texto 		el usuario para la conexión
	*	@param 		texto 		la contraseña para la conexión
	*	@param 		texto 		el nombre de la base de datos
	*	@return 	número 		un número con valores 0 o 1 para indicar o no la existencia de una tabla.
	*/
	function verificar_existencia_objeto( $objeto, $servidor, $usuario, $clave, $bd, $imp_pruebas = null )
	{
		$conteo = 0;

		//$sql = " SELECT COUNT( * ) AS conteo FROM information_schema.tables WHERE table_schema = '$bd' AND table_name = '$tabla' ";
		$sql = " SELECT COUNT( * ) AS conteo FROM information_schema.TABLE_CONSTRAINTS WHERE TABLE_SCHEMA = '$bd' AND CONSTRAINT_NAME = '$objeto'; ";
		if( $imp_pruebas == 1 ) echo "<br><strong>".$sql."</strong><br>";
		$conexion = mysqli_connect( $servidor, $usuario, $clave, $bd  );
		$resultado = $conexion->query( $sql );

		while( $fila = mysqli_fetch_assoc( $resultado ) )
		{
			$conteo = $fila[ 'conteo' ]; //Si hay resultados la variable será afectada.
		}

		return $conteo;
	}

?>
