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
            $respuesta['criterios'] = $json->criterios;
            $respuesta['rangos'] = $json->rangos;
            $respuesta['descripciones'] = $json->descripciones;
			$respuesta['semestre'] = $json->semestre;
			$respuesta['periodo'] = $json->periodo;
			$respuesta['anho'] = $json->anho;
			$respuesta['nombre'] = $json->nombre;

            //Crear rúbrica
            $sql = "INSERT INTO rubricaestandar VALUES (0,'$json->nombre');";
            $result = mysql_query($sql) or die(0);            

            //Obtener ID rúbrica
            $sql = "SELECT LAST_INSERT_ID();";
            $result = mysql_query($sql) or die(0);
            $row = mysql_fetch_array($result);
            $idRubrica = $row[0];

			$idCriterios;
			$idsCriterios = 0;
			$idRangos;
			$idsRangos = 0;
			
            foreach ( $json->criterios as $crit ){

                $sql = "INSERT INTO criterioestandar VALUES (0,$idRubrica,'$crit->nombre',$crit->numero,'$crit->abreviatura','$crit->descriptor')";
                $result = mysql_query($sql) or die(0);
				
				//Obtener ID criterio
                $sql = "SELECT LAST_INSERT_ID();";
                $result = mysql_query($sql) or die(0);
				$row = mysql_fetch_array($result);
				$idCriterio = $row[0];
				$idCriterios[$idsCriterios] = $idCriterio;
				$idsCriterios++;
			}
				
			//Crear rangos
			foreach ( $json->rangos as $rang ){
				
				$sql = "INSERT INTO rango_rubrica VALUES (0,'$rang->nombre',$rang->puntajeMinimo,$rang->puntajeMaximo,$idRubrica)";
				$result = mysql_query($sql) or die(0);

				//Obtener ID rango
				$sql = "SELECT LAST_INSERT_ID();";
				$result = mysql_query($sql) or die(0);
				$row = mysql_fetch_array($result);
				$idRango = $row[0];
				$idRangos[$idsRangos] = $idRango;
				$idsRangos++;
			}
			
			$cr = 0;
			//Crear descripciones
			foreach ( $idCriterios as $criterio ){
				foreach ( $idRangos as $rango ){
					$desc = $json->descripciones[$cr];
                    $sql = "INSERT INTO descripcion_crit_rango VALUES ($criterio,$rango,'$desc->nombre')";
                    $result = mysql_query($sql) or die(0);					
					$cr = $cr + 1;
					
				}			
			}  
			
			if ($json->semestre=='null'){
				//No agregar rúbrica a ningún semestre.
			}else{
				$sql = "UPDATE semestre SET idRubrica=$idRubrica WHERE periodo='$json->periodo' AND anho=$json->anho";
				$result = mysql_query($sql) or die(0);
				//Agregar rúbrica al semestre seleccionado.
			}			
			
            $respuesta['exito'] = 'exito';
            
			
            /*

    		$n=mysql_num_rows($result);

                $i=0;

                while($row = mysql_fetch_array($result)){

                    $respuesta[$i][0]=$row['anho'];
                    $respuesta[$i][1]=$row['periodo'];
                    $i++;
                }

                $respuesta['n']=$n;

            */
            
        }
    }
    
	echo json_encode($respuesta);
	mysql_close(); 
?>










  
	   


    


