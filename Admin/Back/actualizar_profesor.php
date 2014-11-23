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

			$respuesta['id'] = $json->id;
            $respuesta['codigo'] = $json->codigo;
            $respuesta['nombres'] = $json->nombres;
            $respuesta['apellidos'] = $json->apellidos;
            $respuesta['usuario'] = $json->usuario;
			$respuesta['contrasena'] = $json->contrasena;
			
            //Actualizar profesor
			if ($json->contrasena=='CONSERVE'){
				$sql = "UPDATE profesortbl SET codigo=$json->codigo,apellidos='$json->apellidos',nombre='$json->nombres',usuario='$json->usuario' WHERE codigo=$json->id";
			}else{
				$sql = "UPDATE profesortbl SET codigo=$json->codigo,apellidos='$json->apellidos',nombre='$json->nombres',usuario='$json->usuario',contrasenha=NULL WHERE codigo=$json->id";
			}	
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










  
	   


    



