<?php

session_start();
require_once('../../funciones.php');
conectar();

$respuesta['exito']="";
$respuesta['cadena']="";

if(empty($_SESSION['user'])||empty($_SESSION['logged'])||empty($_SESSION['class'])){
    echo '<script>window.location="../../index.html"</script>';
}
else{
    if($_SESSION['class']!="admin"){
        echo '<script>window.location="../../index.html"</script>';
    }
    else{
        $periodo =$_POST['periodo'];
        $anho = $_POST['anho'];
        
        $sql = "SELECT * FROM semestre WHERE anho=$anho AND periodo = '$periodo'";
        $result = mysql_query($sql) or die("La consulta no se pudo realizar");
    
        if(mysql_num_rows($result)>0){      
        
            $respuesta['exito']="repetido";  
   
        }
        else{
        
            $sql = "INSERT INTO semestre (periodo,anho,estado) VALUES('$periodo',$anho,'OFF')";
            $result = mysql_query($sql) or die("La consulta no se pudo realizar");
            $respuesta['exito']="creado";
        
        } 
    }
}


echo json_encode($respuesta);
mysql_close();
?>