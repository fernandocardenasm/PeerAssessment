<?php

/* 
 * Devuelve todos los equipos que se han creado con sus respectivos estudiantes y ordenados segun el número de equipo Ascendentemente
 */

session_start();
require_once('../../funciones.php');
conectar();

$respuesta['exito']="";
$cadena = "";

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
    
            //Identificamos los numeros de equipos diferentes en la tabla equipo

            $sql_no_equipos = "SELECT DISTINCT numeroEquipo FROM equipotbl WHERE idCurso=$id_curso AND numeroEquipo IS NOT NULL ORDER BY numeroEquipo";

            $result = mysql_query($sql_no_equipos) or die("La consulta no se pudo realizar");

            $m=mysql_num_rows($result);

            $i=0;
            if($m>0){
                while($row = mysql_fetch_array($result)){

                    $no_equipo[$i] = $row['numeroEquipo'];
                    $i++;
                }


                $sql = "SELECT e.nombre,e.codigo,eq.numeroEquipo,e.apellidos "
                    . "FROM estudiantetbl AS e "
                    . "INNER JOIN equipotbl AS eq ON e.codigo=eq.codigoEstudiante "
                    . "WHERE eq.idCurso=$id_curso AND eq.numeroEquipo IS NOT NULL "
                    . "ORDER BY e.nombre";

                $result = mysql_query($sql) or die("La consulta no se pudo realizar");

                $n=mysql_num_rows($result);

                if($n>0){
                    $i=0;

                    while($row = mysql_fetch_array($result)){

                        $lista[$i][0]=$row['codigo'];
                        $lista[$i][1]=$row['nombre'];
                        $lista[$i][2]=$row['numeroEquipo'];
                        $lista[$i][3]=$row['apellidos'];
                        $i++;
                    }

                    for($i=0;$i<$m;$i++){



                        $cadena = $cadena.'<div class="row">'
                                . '<div class="col-lg-4">'
                                    . '<div class="panel panel-info">'
                                    . '<div class="panel-heading">'
                                    . '<h4 class="panel-title">'
                                    . '<a data-toggle="collapse" href="#'
                                    . $no_equipo[$i]
                                    . '">'
                                    . 'Equipo: '
                                    . $no_equipo[$i]
                                    . '</a>'
                                    . '<a href="#" tipo="link_agregar_estudiante" numero_equipo="'
                                    . $no_equipo[$i]
                                    . '">'
                                    . '<img class="pull-right width="20" height="20" src="../../Iconos/agregar_estudiante_equipo.png"/>'
                                    . '</a>'
                                    . '</h4>'
                                    . '</div>'
                                    . '<div id="'
                                    . $no_equipo[$i]
                                    . '" class="panel-collapse collapse">'
                                    . '<div class="panel-body">'
                                . '<div class="panel-group" id="accordion">';

                        for($j=0;$j<$n;$j++){

                            if($no_equipo[$i]==$lista[$j][2]){
                                $cadena = $cadena

                                    . '<div class="form-group">'
                                    . '<label>'
                                    . $lista[$j][1]." ".$lista[$j][3]
                                    . '</label>'
                                    . '<a href="#" tipo="link_eliminar_estudiante" id_estudiante="'
                                    . $lista[$j][0]
                                    . '">'
                                    . '<img width="20" height="20" src="../../Iconos/eliminar.png"/>'
                                    . '</a>'
                                    . '</div>';

                            }

                        }
                        $cadena = $cadena.'</div>'
                                    . '</div>'
                                    . '</div>'
                                    . '</div>'
                                . '</div>'
                                . '</div>';
                    }

                    $respuesta['cadena']=$cadena;
                    $respuesta['exito']="exito";
                    $respuesta['n']=$n;
                }
                else{
                    $respuesta['exito']="listavacia"; 
                }
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