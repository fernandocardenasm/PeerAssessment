<?php

session_start();
        
    require_once('../../funciones.php');
    conectar();
    
    if(empty($_SESSION['user'])||empty($_SESSION['logged'])||empty($_SESSION['class'])){
        echo '<script>window.location="../../index.html"</script>';
    }else{
        if($_SESSION['class']!="admin_edu"){
            echo '<script>window.location="../../index.html"</script>';
        }else{
        	
            $info = $_POST['datos'];
            $json = json_decode($info);

			$respuesta['exito'] = 'fracaso';
			$respuesta['mysql'] = 'none';

            $respuesta['id'] = $json->id;
            $respuesta['nombre'] = $json->nombre;

			$sql = "DELETE FROM rubricaestandar WHERE id=$json->id";
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










  
	   


    



