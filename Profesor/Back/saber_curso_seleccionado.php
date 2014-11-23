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
    else {
        $idcurso =$_POST['idcurso'];
        $_SESSION["curso_seleccionado"]=$idcurso;
        $respuesta['exito']="exito";
    }
}


echo json_encode($respuesta);
mysql_close();
?>