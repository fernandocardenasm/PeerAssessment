<?php

session_start();
        
    require_once('../../funciones.php');
    conectar();
    
    if(empty($_SESSION['user'])||empty($_SESSION['logged'])||empty($_SESSION['class'])){
        echo '<script>window.location="../../index.html"</script>';
    }else{
        if($_SESSION['class']!="admin"){
            echo '<script>window.location="../../index.html"</script>';
        }else{
        	
            $profesor = $_POST['datos'];
            $json = json_decode($profesor);

			$respuesta['exito'] = 'fracaso';
			$respuesta['mysql'] = 'none';

            $respuesta['codigo'] = $json->codigo;
            $respuesta['nombres'] = $json->nombres;
            $respuesta['apellidos'] = $json->apellidos;
            $respuesta['usuario'] = $json->usuario;
			//or die(json_encode($respuesta));
            //Crear profesor
			$sql = "INSERT INTO profesortbl VALUES ($json->codigo,'$json->apellidos','$json->nombres','$json->usuario', NULL)";
			if (mysql_query($sql)){
				$respuesta['mysql'] = 'success';
				$respuesta['exito'] = 'exito';
			}else{
				$respuesta['mysql'] = mysql_error();
			}
        }
    }
    
	echo json_encode($respuesta);
	mysql_close(); 
?>










  
	   


    



