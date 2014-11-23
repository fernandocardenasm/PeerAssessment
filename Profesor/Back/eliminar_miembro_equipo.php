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
            $codigo_estudiante = $_POST['codigos_estudiante'];

            $sql = "UPDATE equipotbl SET numeroEquipo=NULL WHERE codigoEstudiante='$codigo_estudiante' AND idCurso=$id_curso";

            $result = mysql_query($sql) or die("La consulta no se pudo realizar");
            $respuesta['exito']="exito";
        }
    }
}



echo json_encode($respuesta);
mysql_close();
?>

