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
    if($_SESSION['class']!="profesor"){
        echo '<script>window.location="../../index.html"</script>';
    }
    else{
        
        $id_profesor = $_SESSION['codigo'];
    
        $sql = "SELECT idCurso FROM profesor_cursotbl WHERE codigoProfesor='$id_profesor'";
        $result = mysql_query($sql) or die("La consulta no se pudo realizar");

        if(mysql_num_rows($result)>0){
        
            while($row = mysql_fetch_array($result)){
                $id_curso = $row['idCurso'];

                $sql_aux = "SELECT * FROM cursotbl WHERE id='$id_curso'";

                $result_aux = mysql_query($sql_aux) or die("La consulta no se pudo realizar");

                $row_aux = mysql_fetch_array($result_aux);

                $id_semestre = $row_aux['idSemestre'];


                $sql = "SELECT * FROM semestre WHERE id='$id_semestre' AND estado='ON'";
                $result2 = mysql_query($sql) or die("La consulta no se pudo realizar");

                //Validar si el semestre se encuentra activo

                if(mysql_num_rows($result2)>0){

                    $respuesta["cadena"]=$respuesta["cadena"].'<li><button type="button" tipo="link_curso" class="btn btn-link" idcurso="'.$id_curso
                        .'">'
                        .$row_aux['nombre']
                        .' NRC: '
                        .$row_aux['NRC']
                        . '</button>'
                        . '</li>';

                        $respuesta['exito']="exito";  

                }
                else{
                    $respuesta['exito']="vacio"; 
                }    
            }
   
        }
        else{
            $respuesta['exito']="vacio";

        } 
        
    }
}



echo json_encode($respuesta);
mysql_close();
?>