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
            
            //Obtener criterios de la rubrica especificada
            
    
            $sql = "SELECT c.nombrecriterio,c.numero "
                    . "FROM criterioestandar AS c "
                    . "INNER JOIN semestre AS s ON s.idRubrica=c.idRubricaEstandar "
                    . "INNER JOIN cursotbl AS ct ON s.id=ct.idSemestre "
                    . "WHERE ct.id=$id_curso "
                    . "ORDER BY c.numero";

            $result = mysql_query($sql) or die("La consulta no se pudo realizar");

            $num_criterios=mysql_num_rows($result);

            if($num_criterios>0){
                $i=0;

                while($row = mysql_fetch_array($result)){

                    $respuesta['criterio'][$i]=$row['nombrecriterio'];
                    $i++;
                }
                
                $respuesta['num_criterios']=$num_criterios;
                
                
                //Obter el # de los assessment realizados
                
                $sql = "SELECT DISTINCT a.numero,a.id "
                    . "FROM assessment AS a "
                    . "INNER JOIN entregasremitentes AS er ON er.idAssessment=a.id "
                    . "WHERE (a.estado='OFF' OR a.estado='DONE') AND a.idCurso=$id_curso AND er.estadoEntrega='COMPLETED' "
                    . "ORDER BY a.numero";

                $result = mysql_query($sql) or die("La consulta no se pudo realizar");
                
                $num_de_assessment = mysql_num_rows($result);
                
                $i=1;
                if($num_de_assessment>0){
                    
                    while($row = mysql_fetch_array($result)){

                        $respuesta['assess']['numero'][$i]=$row['numero'];
                        $respuesta['assess']['id'][$i]=$row['id'];
                        $i++;
                    }
                    $respuesta['num_de_assessment']=$num_de_assessment;
                    
                    //Obtener los equipos asociados al assessment
                    
                    
                    for($i=1;$i<=$num_de_assessment;$i++){
                        $id_assess = $respuesta['assess']['id'][$i];

                        $sql = "SELECT DISTINCT er.numeroEquipo "
                        . "FROM entregasremitentes AS er "
                        . "INNER JOIN assessment AS a ON er.idAssessment=a.id "
                        . "WHERE (a.estado='OFF' OR a.estado='DONE') AND a.idCurso=$id_curso AND a.id=$id_assess AND er.estadoEntrega='COMPLETED' "
                        . "ORDER BY er.numeroEquipo";

                        $result = mysql_query($sql) or die("La consulta no se pudo realizar");
                        
                        $respuesta['n_equipo'][$id_assess]=mysql_num_rows($result);
                                
                        $j=0;
                        
                        //Obtener los estudiantes asociados al equipo seleccionado
                        
                        while($row = mysql_fetch_array($result)){

                            $respuesta['num_equipo'][$id_assess][$j]=$row['numeroEquipo'];
                            $num_equipo = $row['numeroEquipo'];
                            
                            
                            $sql2 = "SELECT DISTINCT e.nombre,e.codigo,e.apellidos "
                            . "FROM estudiantetbl AS e "
                            . "INNER JOIN resultados AS r ON e.codigo=r.codigoDestinatario "
                            . "INNER JOIN entregasremitentes AS er ON er.id=r.idEntregaRemitente "
                            . "INNER JOIN assessment AS a ON a.id=er.idAssessment "
                            . "WHERE (a.estado='OFF' OR a.estado='DONE') AND er.numeroEquipo=$num_equipo AND a.id=$id_assess AND er.estadoEntrega='COMPLETED' "
                            . "ORDER BY e.nombre";

                            $result2 = mysql_query($sql2) or die("La consulta no se pudo realizar");
                            
                            $respuesta['n_estudiantes'][$id_assess][$num_equipo]=mysql_num_rows($result2);
                            
                            $k=0;
                            
                            while($row2 = mysql_fetch_array($result2)){
                                $respuesta['nombre'][$id_assess][$num_equipo][$k] = $row2['nombre'];
                                $respuesta['apellidos'][$id_assess][$num_equipo][$k] = $row2['apellidos'];
                                $respuesta['codigo'][$id_assess][$num_equipo][$k] = $row2['codigo'];
                                $k++;
                            }
                            
                            
                            $j++;
                        }

                        
                    }
                    $respuesta['exito']="exito";

                }
                else{
                    $respuesta['exito']="assessvacio";
                }
                
                

            }
            else{
                $respuesta['exito']="criteriovacio"; 
            }
            
    }
}


echo json_encode($respuesta);
mysql_close();
?>
