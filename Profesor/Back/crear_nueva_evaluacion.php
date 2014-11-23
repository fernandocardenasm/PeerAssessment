<?php

/* 
 * Crear una nueva evaluación por pares
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
            
            $sql = "SELECT numeroEquipo,COUNT(*) AS num_equipo "
                            . "FROM equipotbl "
                            . "WHERE idCurso=$id_curso AND numeroEquipo IS NOT NULL "
                            . "GROUP BY numeroEquipo "
                            . "ORDER BY num_equipo DESC,numeroEquipo DESC";
            
            $result = mysql_query($sql) or die("La consulta no se pudo realizar");
            
            if(mysql_num_rows($result)>0){
                $sw=1;
                while($row = mysql_fetch_array($result)){
                    if($row['num_equipo']<2){
                        $sw=0;
                    }
                }
                
                if($sw==1){
                    $sql = "SELECT MAX(numero) FROM assessment WHERE idCurso=$id_curso AND numero IS NOT NULL";
                    $result = mysql_query($sql) or die("La consulta no se pudo realizar");

                    if(mysql_num_rows($result)>0){
                        $numero_max_assess = mysql_result($result,0,0)+1;

                    }
                    else{
                        $numero_max_assess=1;
                    }
                    $sql = "INSERT INTO assessment (idCurso,estado,numero) VALUES('$id_curso','OFF',$numero_max_assess)";
                    $result = mysql_query($sql) or die("La consulta no se pudo realizar");

                    $sql = "SELECT e.codigoEstudiante,e.numeroEquipo, a.id "
                        . "FROM equipotbl AS e "
                        . "INNER JOIN assessment AS a ON e.idCurso=a.idCurso "
                        . "WHERE e.idCurso=$id_curso AND e.numeroEquipo IS NOT NULL AND a.numero=$numero_max_assess "
                        . "ORDER BY a.id";

                    $result = mysql_query($sql) or die("La consulta no se pudo realizar");

                    if(mysql_num_rows($result)>0){

                        while($row = mysql_fetch_array($result)){

                            $id_assesment = $row['id'];
                            $cod_estudiante = $row['codigoEstudiante'];
                            $num_equipo = $row['numeroEquipo'];

                            $sql2 = "INSERT INTO entregasremitentes (idAssessment,codigoEstudiante,estadoEntrega,numeroEquipo) VALUES($id_assesment,$cod_estudiante,'INCOMPLETED',$num_equipo)";
                            $result2 = mysql_query($sql2) or die("La consulta no se pudo realizar");
                        }
                        $respuesta['exito']='exito';

                    }
                    else{
                    //Si no hay ningún equipo creado no crea la evaluación

                        $sql = "DELETE from assessment WHERE idCurso=$id_curso AND numero=$numero_max_assess";
                        $result = mysql_query($sql) or die("La consulta no se pudo realizar");

                        $respuesta['exito']='vacio';
                    }
                }
                else{
                    $respuesta['exito']='equipo_incompleto';
                }

            }
            else{
                $respuesta['exito']='equipo_vacio';
            }

            
            
        }
    }
}



echo json_encode($respuesta);
mysql_close();
?>
