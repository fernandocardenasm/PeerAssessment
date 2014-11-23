<?php

session_start();
require_once('../../funciones.php');
conectar();

$respuesta['exito']="";

if(empty($_SESSION['user'])||empty($_SESSION['logged'])||empty($_SESSION['class'])){
    echo '<script>window.location="../../index.html"</script>';
}
else{
    if($_SESSION['class']!="admin_edu"){
        echo '<script>window.location="../../index.html"</script>';
    }
    else{
        
            
    
            $sql = "SELECT c.nombre,c.NRC,c.id "
                    . "FROM cursotbl AS c "
                    . "INNER JOIN semestre AS s ON c.idSemestre=s.id "
                    . "WHERE s.estado='ON' "
                    . "ORDER BY c.nombre ASC";

            $result = mysql_query($sql) or die("La consulta no se pudo realizar");

            $n=mysql_num_rows($result);

            if($n>0){
                $i=0;

                while($row = mysql_fetch_array($result)){

                    $respuesta[$i][0]=$row['nombre'];
                    $respuesta[$i][1]=$row['NRC'];
                    $respuesta[$i][2]=$row['id'];
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


echo json_encode($respuesta);
mysql_close();
?>
