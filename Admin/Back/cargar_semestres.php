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
        
        $sql = "SELECT * FROM semestre";
        $result = mysql_query($sql) or die("La consulta no se pudo realizar");
    
        if(mysql_num_rows($result)>0){
        
            while($row = mysql_fetch_array($result)){
                $id_semestre = $row['id'];
            
                $periodo = $row['periodo'];
                $anho = $row['anho'];
            
                if($periodo == 'P'){
                    $periodo_aux = "Primero";
                }
                else if($periodo == 'S'){
                    $periodo_aux = "Segundo";
                }
                else if($periodo == 'I1'){
                    $periodo_aux = "Intersemestral I";
                }
                else if($periodo == 'I2'){
                    $periodo_aux = "Intersemestral II";
                }
            
                $respuesta["cadena"]=$respuesta["cadena"].'<li><button type="button" tipo="link_semestre" class="btn btn-link" idsemestre="'.$id_semestre
                    .'">Periodo: '
                    .$periodo_aux
                    .'--Año: '
                    .$anho
                    . '</button>'
					. '<a href="#cambiarEstadoSemestre" type="button" class="btn btn-warning btn-sm">Cambiar estado</a>'
					. '<span> </span>'
					. '<!--'
					. '<a href="#eliminarSemestre" type="button" class="btn btn-danger btn-sm">Eliminar</a>'
					. '-->'
                    . '</li>';
            }
        
            $respuesta['exito']="exito";  
         
          
        }
        else{
            $respuesta['exito']="vacio";
        
        } 
        
    }
}



echo json_encode($respuesta);
mysql_close();
?>