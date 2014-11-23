<?php

/* 
 * Devuelve todos los equipos que se han creado con sus respectivos estudiantes y ordenados segun el número de equipo Ascendentemente
 */

session_start();
require_once('../../funciones.php');
conectar();

$respuesta['exito']="";
$cadena = "";

if(empty($_SESSION['user'])||empty($_SESSION['logged'])||empty($_SESSION['class'])){
    echo '<script>window.location="../../index.html"</script>';
}
else{
    if($_SESSION['class']!="profesor"){
        echo '<script>window.location="../../index.html"</script>';
    }
    else{
        if(empty($_SESSION['curso_seleccionado'])){
            echo '<script>window.location="../Front/inicio_profesor.php"</script>';
        }
        else{
            
            $id_curso = $_SESSION['curso_seleccionado'];
    
            $sql = "SELECT id,estado,numero FROM assessment WHERE idCurso='$id_curso' ORDER BY numero";
            $result = mysql_query($sql) or die("La consulta no se pudo realizar");

            if(mysql_num_rows($result)>0){

                while($row = mysql_fetch_array($result)){
                    $id_assesment = $row['id'];
                    $estado = $row['estado'];
                    $numero_assesment = $row['numero'];

                    $sql2 = "SELECT COUNT(id) FROM entregasremitentes WHERE idAssessment='$id_assesment' AND estadoEntrega='COMPLETED'";
                    $result2 = mysql_query($sql2) or die("La consulta no se pudo realizar");

                    $no_entregas_hechas = mysql_result($result2,0,0);

                    $sql2 = "SELECT COUNT(id) FROM entregasremitentes WHERE idAssessment='$id_assesment'";
                    $result2 = mysql_query($sql2) or die("La consulta no se pudo realizar");

                    $no_total_entregas = mysql_result($result2,0,0);

                    $cadena = $cadena.'<div class="form-group">'
                                . '<label>'
                                . 'Evaluación número: '
                                . $numero_assesment
                                .' Realizadas: '
                            . $no_entregas_hechas
                            . '/'
                            . $no_total_entregas
                            . '</label>';

                    if($estado == 'DONE'){

                        $cadena = $cadena.'<button type="button" class="btn btn-primary btn-xs"> Listo'
                                . '</button>';
                    }
                    else if($estado == 'OFF'){
                        $cadena = $cadena.'<button type="button" tipo="activar_evaluacion" class="btn btn-success btn-xs" id="'
                                . $id_assesment
                                . '"> Activar'
                                . '</button>';
                    }
                    else if($estado == 'ON'){
                        $cadena = $cadena.'<button type="button" tipo="desactivar_evaluacion" class="btn btn-danger btn-xs" id="'
                                . $id_assesment
                                . '"> Desactivar'
                                . '</button>';
                    }

                    $cadena = $cadena.'</div>';
                }
                $respuesta['exito']="exito";
                $respuesta['cadena']=$cadena; 
            }
            else{
                $respuesta['exito']="vacio";

            } 

        }
    }
}


echo json_encode($respuesta);
mysql_close();
?>