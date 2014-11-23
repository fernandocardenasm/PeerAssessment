<?php

/* 
 * Guarda las notas mandadas por el estudiante X del peer evaluation.
 */


session_start();
require_once('../../funciones.php');
conectar();

$respuesta['exito']="";


if(empty($_SESSION['user'])||empty($_SESSION['logged'])||empty($_SESSION['class'])){
    echo '<script>window.location="../../index.html"</script>';
}
else{
    if($_SESSION['class']!="estudiante"){
        echo '<script>window.location="../../index.html"</script>';
    }
    else{
        
        $codigos = $_POST['codigos'];
        $notas = $_POST['notas'];
        $num_notas = $_POST['num_notas'];
        $num_estudiantes = $_POST['num_estudiantes'];
        $id_er = $_POST['id_er'];
        $id_assesment = $_POST['id_assess'];

        for($i=0;$i<$num_estudiantes;$i++){
            $codigo = $codigos[$i];
            for($j=0;$j<$num_notas;$j++){
                $nota=$notas[$i][$j];
                $num_criterio=$j+1;
                $sql = "INSERT INTO resultados (idEntregaRemitente,codigoDestinatario,calificacion,numeroCriterio) VALUES($id_er,'$codigo',$nota,$num_criterio)";
                $result = mysql_query($sql) or die("La consulta no se pudo realizar");
            }
        }
    
        $sql = "UPDATE entregasremitentes SET estadoEntrega='COMPLETED' WHERE id='$id_er'";

        $result = mysql_query($sql) or die("La consulta no se pudo realizar");
        
        
        //Pasar estado a DONE cuando todas estén listas
        
        $sql2 = "SELECT COUNT(id) FROM entregasremitentes WHERE idAssessment='$id_assesment' AND estadoEntrega='COMPLETED'";
        $result2 = mysql_query($sql2) or die("La consulta no se pudo realizar");

        $no_entregas_hechas = mysql_result($result2,0,0);

        $sql2 = "SELECT COUNT(id) FROM entregasremitentes WHERE idAssessment='$id_assesment'";
        $result2 = mysql_query($sql2) or die("La consulta no se pudo realizar");

        $no_total_entregas = mysql_result($result2,0,0);
        
        if($no_total_entregas==$no_entregas_hechas){
            $sql = "UPDATE assessment SET estado='DONE' WHERE id='$id_assesment'";
            $result = mysql_query($sql) or die("La consulta no se pudo realizar");
        }
         
        

        $respuesta['exito']="exito";
        
    }
}


echo json_encode($respuesta);
mysql_close();
?>