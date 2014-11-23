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
            $caso = $_POST['caso'];
            $cadena ="[";
            $id_curso = $_SESSION['curso_seleccionado'];
            
            
            
            //Saca el promedio del estudiante seleccionado
            if($caso==0){
            
                //Obtener criterios de la rubrica especificada
                $id_assesment = $_POST['idassess'];
                $num_equipo = $_POST['num_equipo'];
                $cod_estudiante = $_POST['cod_estudiante'];

                $sql = "SELECT AVG(r.calificacion),ce.nombrecriterio,ce.numero "
                            . "FROM assessment AS a "
                            . "INNER JOIN entregasremitentes AS er ON a.id=er.idAssessment "
                            . "INNER JOIN resultados AS r ON er.id=r.idEntregaRemitente "
                            . "INNER JOIN criterioestandar AS ce ON ce.numero=r.numeroCriterio "
                            . "WHERE a.id=$id_assesment AND er.numeroEquipo=$num_equipo AND r.codigoDestinatario=$cod_estudiante "
                            . "GROUP BY ce.nombrecriterio "
                            . "ORDER BY ce.numero";

                $result = mysql_query($sql) or die("La consulta no se pudo realizar");
                $cont=0;
                $n=mysql_num_rows($result);
                
                while($row = mysql_fetch_array($result)){
                    if($cont+1==$n){
                        $cadena=$cadena.'{"criterio":"'.$row['nombrecriterio'].'","valor":'.$row['AVG(r.calificacion)'].'}]';
                    }
                    else{
                        $cadena=$cadena.'{"criterio":"'.$row['nombrecriterio'].'","valor":'.$row['AVG(r.calificacion)'].'},';
                    }
                    $cont++;
                }
                    
                $respuesta['cadena']=$cadena;
                     
                $respuesta['exito']='exito_0';

            }
            else if($caso==1){//Saca el promedio de todos los estudiantes del equipo seleccionado
                
                $id_assesment = $_POST['idassess'];
                $num_equipo = $_POST['num_equipo'];
                
                $sql = "SELECT AVG(r.calificacion),ce.nombrecriterio,ce.numero "
                            . "FROM assessment AS a "
                            . "INNER JOIN entregasremitentes AS er ON a.id=er.idAssessment "
                            . "INNER JOIN resultados AS r ON er.id=r.idEntregaRemitente "
                            . "INNER JOIN criterioestandar AS ce ON ce.numero=r.numeroCriterio "
                            . "WHERE a.id=$id_assesment AND er.numeroEquipo=$num_equipo "
                            . "GROUP BY ce.nombrecriterio "
                            . "ORDER BY ce.numero";

                $result = mysql_query($sql) or die("La consulta no se pudo realizar");
                $cont=0;
                $n=mysql_num_rows($result);
                
                while($row = mysql_fetch_array($result)){
                    if($cont+1==$n){
                        $cadena=$cadena.'{"criterio":"'.$row['nombrecriterio'].'","valor":'.$row['AVG(r.calificacion)'].'}]';
                    }
                    else{
                        $cadena=$cadena.'{"criterio":"'.$row['nombrecriterio'].'","valor":'.$row['AVG(r.calificacion)'].'},';
                    }
                    $cont++;
                }
                    
                $respuesta['cadena']=$cadena;
                     
                $respuesta['exito']='exito_1';
            }
            else if($caso==2){
                
                $id_assesment = $_POST['idassess'];
                
                $sql = "SELECT AVG(r.calificacion),ce.nombrecriterio,ce.numero "
                            . "FROM assessment AS a "
                            . "INNER JOIN entregasremitentes AS er ON a.id=er.idAssessment "
                            . "INNER JOIN resultados AS r ON er.id=r.idEntregaRemitente "
                            . "INNER JOIN criterioestandar AS ce ON ce.numero=r.numeroCriterio "
                            . "WHERE a.id=$id_assesment "
                            . "GROUP BY ce.nombrecriterio "
                            . "ORDER BY ce.numero";

                $result = mysql_query($sql) or die("La consulta no se pudo realizar");
                $cont=0;
                $n=mysql_num_rows($result);
                
                while($row = mysql_fetch_array($result)){
                    if($cont+1==$n){
                        $cadena=$cadena.'{"criterio":"'.$row['nombrecriterio'].'","valor":'.$row['AVG(r.calificacion)'].'}]';
                    }
                    else{
                        $cadena=$cadena.'{"criterio":"'.$row['nombrecriterio'].'","valor":'.$row['AVG(r.calificacion)'].'},';
                    }
                    $cont++;
                }
                    
                $respuesta['cadena']=$cadena;
                     
                $respuesta['exito']='exito_2';
                
            }
            else if($caso==3){
                
                $sql = "SELECT AVG(r.calificacion),ce.nombrecriterio,ce.numero "
                            . "FROM assessment AS a "
                            . "INNER JOIN entregasremitentes AS er ON a.id=er.idAssessment "
                            . "INNER JOIN resultados AS r ON er.id=r.idEntregaRemitente "
                            . "INNER JOIN criterioestandar AS ce ON ce.numero=r.numeroCriterio "
                            . "INNER JOIN cursotbl AS ctbl ON ctbl.id=a.idCurso "
                            . "WHERE ctbl.id=$id_curso AND (a.estado='DONE' OR a.estado='OFF') "
                            . "GROUP BY ce.nombrecriterio "
                            . "ORDER BY ce.numero";

                $result = mysql_query($sql) or die("La consulta no se pudo realizar");
                $cont=0;
                $n=mysql_num_rows($result);
                
                while($row = mysql_fetch_array($result)){
                    if($cont+1==$n){
                        $cadena=$cadena.'{"criterio":"'.$row['nombrecriterio'].'","valor":'.$row['AVG(r.calificacion)'].'}]';
                    }
                    else{
                        $cadena=$cadena.'{"criterio":"'.$row['nombrecriterio'].'","valor":'.$row['AVG(r.calificacion)'].'},';
                    }
                    $cont++;
                }
                    
                $respuesta['cadena']=$cadena;

                     
                $respuesta['exito']='exito_3';
                
            }
        }
    }
}


echo json_encode($respuesta);
mysql_close();
?>
