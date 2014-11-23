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
    
            $sql = "SELECT e.nombre,e.codigo,e.apellidos "
                    . "FROM estudiantetbl AS e "
                    . "INNER JOIN equipotbl AS eq ON e.codigo=eq.codigoEstudiante "
                    . "WHERE eq.idCurso=$id_curso AND eq.numeroEquipo IS NULL "
                    . "ORDER BY e.nombre";

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
