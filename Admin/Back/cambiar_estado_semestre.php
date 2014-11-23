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

		$respuesta['admin'] = $json->admin;
		$respuesta['razon'] = $json->razon;
		$respuesta['fecha'] = $json->fecha;
		$respuesta['periodo'] = $json->periodo;
		$respuesta['anho'] = $json->anho;
		$respuesta['accion'] = $json->accion;
		
		$accion = $json->accion;
		
		$idsemestre;
		$codigoadmin;
		
		//Buscar id del semestre
		
		$sql = "SELECT id FROM semestre WHERE periodo='$json->periodo' AND anho=$json->anho";
		
		if (mysql_query($sql)){
			$result = mysql_query($sql);
			if ($row = mysql_fetch_array($result)){
				$idsemestre = $row['id'];
				
				//Buscar id del admin
		
				$sql2 = "SELECT codigo FROM admin_sistema WHERE usuario='$json->admin'";
				
				if (mysql_query($sql2)){
					$result2 = mysql_query($sql2);
					if ($row2 = mysql_fetch_array($result2)){
						$codigoadmin = $row2['codigo'];
						
						//Escribir registro de activación/desactivación del semestre
		
						if ($accion=='activado'){
							$sql3 ="INSERT INTO historial_estados_sem VALUES (0,$idsemestre,$codigoadmin,'$json->fecha','$json->razon','ON')";
						}else if ($accion=='desactivado'){
							$sql3 ="INSERT INTO historial_estados_sem VALUES (0,$idsemestre,$codigoadmin,'$json->fecha','$json->razon','OFF')";
						}else{
							$respuesta['mysql'] = 'Acción no encontrada';
						}						
						if (mysql_query($sql3)){
						
							//Actualizar estado del semestre
							
							if ($accion=='activado'){
								$sql4 = "UPDATE semestre SET estado='ON' WHERE periodo='$json->periodo' AND anho=$json->anho";
							}else if($accion=='desactivado'){
								$sql4 = "UPDATE semestre SET estado='OFF' WHERE periodo='$json->periodo' AND anho=$json->anho";
							}else{
								$respuesta['mysql'] = 'Acción no encontrada';
							}
							if (mysql_query($sql4)){
								$respuesta['mysql'] = 'success';
								$respuesta['exito'] = 'exito';
							}else{
								$respuesta['mysql'] = mysql_error();
							}					
							
						}else{
							$respuesta['mysql'] = mysql_error();
						}
						
					}else{
						$respuesta['mysql'] = 'ID del admin no encontrado';
					}				
					
				}else{
					$respuesta['mysql'] = mysql_error();
				}
				
			}else{
				$respuesta['mysql'] = 'ID del semestre no encontrado';
			}			

		}else{
			$respuesta['mysql'] = mysql_error();
		}
		
  
    }
}


echo json_encode($respuesta);
mysql_close();
?>
