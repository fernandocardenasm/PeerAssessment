<?php

/*
 * Devuelve una cadena con una matriz con los nombres y codigos de los estudiantes del equipo del
 *  que tiene cada estudiante, además dentro de esa matriz devuelve 
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
        $id_assesment = $_POST['idassess'];
        $num_equipo = $_POST['num_equipo'];
        $id_estudiante = $_SESSION['codigo'];

        $sql = "SELECT er.codigoEstudiante,e.nombre,e.apellidos "
                . "FROM entregasremitentes AS er "
                . "INNER JOIN estudiantetbl AS e ON er.codigoEstudiante=e.codigo "
                . "WHERE er.numeroEquipo=$num_equipo AND er.codigoEstudiante<>$id_estudiante AND er.idAssessment=$id_assesment "
                . "ORDER BY e.nombre";

        $result = mysql_query($sql) or die("La consulta no se pudo realizar");
    
        if(mysql_num_rows($result)>0){
            $respuesta['num_estudiantes'] = mysql_num_rows($result);
            $i=0;

            while($row = mysql_fetch_array($result)){
                $respuesta[$i][0] = $row['codigoEstudiante'];
                $respuesta[$i][1] = $row['nombre'];
                $respuesta[$i][4] = $row['apellidos'];
                $i++;

            }



        }else{
            $respuesta['num_estudiantes'] = 0;
        }
    
    //Se traerá los criterios de la rúbrica del semestre
    
        $sql = "SELECT c.nombrecriterio,c.numero "
                . "FROM criterioestandar AS c "
                . "INNER JOIN semestre AS s ON c.idRubricaEstandar=s.idRubrica "
                . "INNER JOIN cursotbl AS ct ON s.id=ct.idSemestre "
                . "INNER JOIN assessment AS a ON a.idCurso=ct.id "
                . "WHERE a.id=$id_assesment "
                . "ORDER BY c.numero";

        $result = mysql_query($sql) or die("La consulta no se pudo realizar");

        if(mysql_num_rows($result)>0){
            $respuesta['num_criterios'] = mysql_num_rows($result);
            $i=0;

            while($row = mysql_fetch_array($result)){
                $respuesta[$i][2] = $row['nombrecriterio'];
                $respuesta[$i][3] = $row['numero'];

                $i++;

            }

        }
        $respuesta['codigo_propio']=$id_estudiante;
        $respuesta['exito']="exito";  
    }
}



echo json_encode($respuesta);
mysql_close();
?>