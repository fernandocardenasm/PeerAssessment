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
        	
            $info = $_POST['datos'];
            $json = json_decode($info);

			$respuesta['exito'] = 'fracaso';
			$respuesta['mysql'] = 'none';

            $respuesta['id'] = $json->id;
            $respuesta['nombres'] = $json->nombres;
            $respuesta['apellidos'] = $json->apellidos;

			$sql = "DELETE FROM estudiantetbl WHERE codigo=$json->id";
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










  
	   


    



