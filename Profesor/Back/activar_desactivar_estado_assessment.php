<?php

/* 
 * Activa si es 0, desactiva si es 1 el estado del assesment.
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
            $accion = $_POST['accion']; //0:activa, 1:desactiva
            $id_assesment = $_POST['id'];

            if($accion==0){

                $sql = "UPDATE assessment SET estado='ON' WHERE id=$id_assesment";
                $result = mysql_query($sql) or die("La consulta no se pudo realizar");

            }
            else if($accion==1){
                $sql = "UPDATE assessment SET estado='OFF' WHERE id=$id_assesment";
                $result = mysql_query($sql) or die("La consulta no se pudo realizar");
            }

            $respuesta['exito']="exito";
            
        }
    }
}



echo json_encode($respuesta);
mysql_close();
?>

