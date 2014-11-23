<?php

session_start();
        
    require_once('../../funciones.php');
    conectar();
	//Recibir
    
    if(empty($_SESSION['user'])||empty($_SESSION['logged'])||empty($_SESSION['class'])){
        echo '<script>window.location="../../index.html"</script>';
    }else{
        if($_SESSION['class']!="admin_edu"){
            echo '<script>window.location="../../index.html"</script>';
        }else{
        	
            $rubrica = $_POST['datos'];
            $json = json_decode($rubrica);

            $respuesta['exito'] = 'fail';
            $respuesta['tipo_error'] = 0;

            $respuesta['rubrica'] = $rubrica;
			$respuesta['id'] = $json->id;
			$respuesta['semestre'] = $json->semestre;
			$respuesta['periodo'] = $json->periodo;
			$respuesta['anho'] = $json->anho;
			
			if ($json->semestre=='null'){
				//No agregar rúbrica a ningún semestre.
			}else{
				//Agregar rúbrica al semestre seleccionado.
				$sql = "UPDATE semestre SET idRubrica=$json->id WHERE periodo='$json->periodo' AND anho=$json->anho";
				$result = mysql_query($sql) or die(0);				
			}			
			
            $respuesta['exito'] = 'exito';

            
        }
    }
    
	echo json_encode($respuesta);
	mysql_close(); 
?>










  
	   


    


