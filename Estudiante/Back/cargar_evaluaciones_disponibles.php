<?php

/*
 * Devuelve una cadena con las evaluaciones disponibles que tiene cada estudiante
 */

session_start();
require_once('../../funciones.php');
conectar();
$respuesta['exito']="";
$respuesta['cadena']="";
$cadena="";


if(empty($_SESSION['user'])||empty($_SESSION['logged'])||empty($_SESSION['class'])){
    echo '<script>window.location="../../index.html"</script>';
}
else{
    if($_SESSION['class']!="estudiante"){
        echo '<script>window.location="../../index.html"</script>';
    }
    else{
        
        $cod_estudiante = $_SESSION['codigo'];
    
        $sql = "SELECT a.idCurso,a.numero,er.idAssessment,er.numeroEquipo,er.id,c.NRC,c.nombre "
            . "FROM assessment AS a "
            . "INNER JOIN entregasremitentes AS er ON er.idAssessment=a.id "
            . "INNER JOIN cursotbl AS c ON a.idCurso=c.id "
            . "WHERE er.codigoEstudiante='$cod_estudiante' AND er.estadoEntrega='INCOMPLETED' AND a.estado='ON' "
            . "ORDER BY c.nombre";
    
        $result = mysql_query($sql) or die("La consulta no se pudo realizar");
    
        if(mysql_num_rows($result)>0){
        
            while($row = mysql_fetch_array($result)){
                $id_curso = $row['idCurso'];
                $numero_equipo = $row['numeroEquipo'];
                $id_assessment = $row['idAssessment'];
                $id_entrega_remitente = $row['id'];
                $nrc = $row['NRC'];
                $nombre_materia = $row['nombre'];
                $numero_assesment = $row['numero'];
            
                $cadena=$cadena.'<li>'
                    . '<button data-toggle="modal" data-target="#myModal" type="button" tipo="link_evaluacion_disponible" class="btn btn-link" idCurso="'.$id_curso
                    .'" id_assessment="'
                    . $id_assessment
                    . '" id_entrega_remitente="'
                    . $id_entrega_remitente
                    . '" num_equipo="'
                    . $numero_equipo
                    . '">'
                    . 'Materia: '
                    .$nombre_materia
                    .'--NRC: '
                    .$nrc
                    . ' Evaluación #'
                        . $numero_assesment
                        . '</button>'
                    . '</li>';
            }       
        
            $respuesta['cadena']=$cadena;
            $respuesta['exito']="exito";  
 
        }
        else{
            $respuesta['exito']="vacio";
        
        } 
        
    }
}



echo json_encode($respuesta);
mysql_close();
?>