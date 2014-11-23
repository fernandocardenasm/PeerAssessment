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
        $idsemestre =$_POST['idsemestre'];
        $_SESSION["semestre"]=$idsemestre;
        $respuesta['exito']="exito";     
    }
}



echo json_encode($respuesta);
mysql_close();
?>