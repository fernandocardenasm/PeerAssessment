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
        if(empty($_SESSION['semestre'])){
            echo '<script>window.location="../Front/inicio_profesor.php"</script>';
        }
        else{
            
            $id_semestre = $_SESSION['semestre'];
    
            $sql = "SELECT nombre,codigo,apellidos "
                    . "FROM profesortbl "
                    . "ORDER BY nombre";

            $result = mysql_query($sql) or die("La consulta no se pudo realizar");

            $n=mysql_num_rows($result);

            if($n>0){
                $i=0;

                while($row = mysql_fetch_array($result)){

                    $respuesta[$i][0]=$row['codigo'];
                    $respuesta[$i][1]=$row['apellidos'];
                    $respuesta[$i][2]=$row['nombre'];
                    $i++;
                }

                $respuesta['exito']="exito";
                $respuesta['n']=$n;
            }
            else{
                $respuesta['exito']="listavacia"; 
            }
            
        }
    }
}


echo json_encode($respuesta);
mysql_close();
?>
