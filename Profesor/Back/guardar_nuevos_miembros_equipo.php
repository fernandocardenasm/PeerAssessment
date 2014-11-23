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
            $nuevo_num_equipo = $_POST['nuevo_num_equipo'];

            //Obtener el número del equipo indicado.

            for($i=0;$i<$num_estudiantes;$i++){
                    $sql = "UPDATE equipotbl SET numeroEquipo=$nuevo_num_equipo WHERE codigoEstudiante='$codigo_estudiantes[$i]' AND idCurso=$id_curso";
                    $result = mysql_query($sql) or die("La consulta no se pudo realizar");
            }

            $respuesta['exito']="exito";
            
        }
    }
}


echo json_encode($respuesta);
mysql_close();
?>
