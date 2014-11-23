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
            
            $id_curso = $_POST['id_curso'];
            
                //Obter el # de los assessment realizados
                
                $sql = "SELECT DISTINCT a.numero,a.id "
                    . "FROM assessment AS a "
                    . "INNER JOIN entregasremitentes AS er ON er.idAssessment=a.id "
                    . "WHERE (a.estado='OFF' OR a.estado='DONE') AND a.idCurso=$id_curso AND er.estadoEntrega='COMPLETED' "
                    . "ORDER BY a.numero";

                $result = mysql_query($sql) or die("La consulta no se pudo realizar");
                
                $num_de_assessment = mysql_num_rows($result);
                
                $i=0;
                if($num_de_assessment>0){
                    
                    while($row = mysql_fetch_array($result)){

                        $respuesta['assess']['numero'][$i]=$row['numero'];
                        $respuesta['assess']['id'][$i]=$row['id'];
                        
                        $i++;
                    }
                    $respuesta['num_de_assessment']=$num_de_assessment;
                    
                    $respuesta['exito']="exito";

                }
                else{
                    $respuesta['exito']="assessvacio";
                }
                
            
        }
}


echo json_encode($respuesta);
mysql_close();
?>
