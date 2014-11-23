<?php

session_start();
require_once('../../funciones.php');
conectar();

$respuesta['exito']="";

if(empty($_SESSION['user'])||empty($_SESSION['logged'])||empty($_SESSION['class'])){
    echo '<script>window.location="../../index.html"</script>';
}
else{
    if($_SESSION['class']!="admin"){
        echo '<script>window.location="../../index.html"</script>';
    }
    else{
	
		$info = $_POST['datos'];
		$json = json_decode($info);

		$respuesta['exito'] = 'fracaso';
		$respuesta['mysql'] = 'none';

		$respuesta['periodo'] = $json->periodo;
		$respuesta['anho'] = $json->anho;
		$respuesta['rubrica'] = '';
		$respuesta['estado'] = '';
	
		$sql = "SELECT idRubrica,estado FROM semestre WHERE periodo='$json->periodo' AND anho=$json->anho";
		
		if (mysql_query($sql)){
			$result = mysql_query($sql);
			if ($row = mysql_fetch_array($result)){
				$respuesta['rubrica'] = $row['idRubrica'];
				$respuesta['estado'] = $row['estado'];
			}else{
				$respuesta['rubrica'] = 'No encontrado';
				$respuesta['estado'] = 'No encontrado';
			}			
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
