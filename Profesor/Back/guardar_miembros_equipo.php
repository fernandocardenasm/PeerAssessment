<?php

session_start();
require_once('../../funciones.php');
conectar();

$respuesta['exito']="";

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
            $codigo_estudiantes = $_POST['codigos_estudiantes'];
            $num_estudiantes = $_POST['num_estudiantes'];

            $num_equipo=1;

            //Obtener el número del equipo indicado.

            /*$sql = "SELECT DISTINCT numeroEquipo FROM equipotbl WHERE idCurso=$id_curso AND numeroEquipo IS NOT NULL ORDER BY numeroEquipo";
            $result = mysql_query($sql) or die("La consulta no se pudo realizar");
             * 
             */

            $sql = "SELECT DISTINCT numeroEquipo FROM equipotbl WHERE idCurso=$id_curso UNION SELECT DISTINCT er.numeroEquipo FROM "
                    . "entregasremitentes AS er "
                    . "INNER JOIN assessment AS a ON er.idAssessment=a.id "
                    . "WHERE a.idCurso=$id_curso "
                    . "ORDER BY numeroEquipo";

                $result = mysql_query($sql) or die("La consulta no se pudo realizar");


            if(mysql_num_rows($result)>0){

                $n=mysql_num_rows($result);
                $i=0;

                //Pasar los valores del equipo a un vector.
                while($row = mysql_fetch_array($result)){
                    $valores_equipos[$i]=$row['numeroEquipo'];
                    $i++;
                } 

                $i=0;

                while($i<$n){
                    $sw=0;
                    $j=0;
                    while($j<$n && $sw==0){
                        if($valores_equipos[$j]==$num_equipo){
                            $sw=1;
                            $num_equipo++;
                        }
                        $j++;
                    }
                    if($sw==0){
                        $i=$n;
                    }

                    $i++;
                }
                $respuesta['n'] = $n;
                //Actualizar el registro del estudiante
                for($i=0;$i<$num_estudiantes;$i++){
                    $sql = "UPDATE equipotbl SET numeroEquipo=$num_equipo WHERE codigoEstudiante='$codigo_estudiantes[$i]' AND idCurso=$id_curso";
                    $result = mysql_query($sql) or die("La consulta no se pudo realizar");
                }

            }
            else{
                //Actualizar el registro del estudiante
                for($i=0;$i<$num_estudiantes;$i++){
                    $sql = "UPDATE equipotbl SET numeroEquipo=$num_equipo WHERE codigoEstudiante='$codigo_estudiantes[$i]' AND idCurso=$id_curso";
                    $result = mysql_query($sql) or die("La consulta no se pudo realizar");
                }
            }

            $respuesta['exito']="exito";
            
        }
    }
}


echo json_encode($respuesta);
mysql_close();
?>
