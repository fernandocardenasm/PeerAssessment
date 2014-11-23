<?php

session_start();
require_once('../../funciones.php');
conectar();

$respuesta['exito']="";
if(empty($_SESSION['user'])||empty($_SESSION['logged'])||empty($_SESSION['class'])){
    echo '<script>window.location="../../index.html"</script>';
}
else{
    if($_SESSION['class']!="admin"){
        echo '<script>window.location="../../index.html"</script>';
    }
    else{
        
        if(empty($_SESSION['semestre'])){
            echo '<script>window.location="../../semestres_actuales.php"</script>';
        }
        else{
            
            $nombre_materia =$_POST['nombre'];
            $nrc =$_POST['nrc'];
            $codigo_materia=$_POST['codigo_materia'];
            $curso=$_POST['curso'];
            $codigo_primer_profesor=$_POST['codigo_primer_profesor'];
            $codigo_segundo_profesor=$_POST['codigo_segundo_profesor'];
            $id_semestre = $_SESSION['semestre'];

            
            
            $sql = "SELECT * FROM cursotbl WHERE idSemestre='$id_semestre' AND NRC=$nrc";
            $result = mysql_query($sql) or die("La consulta no se pudo realizar");
    
            if(mysql_num_rows($result)>0){      
        
                $respuesta['exito']="repetido";  
   
            }
            else{
        
                //Validar la existencia del profesor
        
                $sql = "SELECT * FROM profesortbl WHERE codigo='$codigo_primer_profesor'";
                $result = mysql_query($sql) or die("La consulta no se pudo realizar");
        
                if(mysql_num_rows($result)>0){
            
                //Insertar nuevo curso
                    $sql = "INSERT INTO cursotbl (NRC,nombre,codigoMateria,codigoCurso,idSemestre) VALUES($nrc,'$nombre_materia','$codigo_materia','$curso',$id_semestre)";
                    $result = mysql_query($sql) or die("La consulta no se pudo realizar");
        
                    //Hallar el id del nuevo curso creado
        
                    $sql = "SELECT id FROM cursotbl WHERE idSemestre='$id_semestre' AND NRC=$nrc";
                    $result = mysql_query($sql) or die("La consulta no se pudo realizar");
        
                    $id_curso_creado= mysql_result($result,0,0);
                    $_SESSION['id_curso'] = $id_curso_creado;
        
                    //Relacionar profesor al curso creado
        
                    $sql = "INSERT INTO profesor_cursotbl (codigoProfesor,idCurso) VALUES('$codigo_primer_profesor',$id_curso_creado)";
                    $result = mysql_query($sql) or die("La consulta no se pudo realizar");
        
                    //Agregar segundo profesor asociado
        
                    if($codigo_segundo_profesor!="vacio"){
                        $sql = "INSERT INTO profesor_cursotbl (codigoProfesor,idCurso) VALUES('$codigo_segundo_profesor',$id_curso_creado)";
                        $result = mysql_query($sql) or die("La consulta no se pudo realizar");
                    }
                    $respuesta['exito']="creado";
            
                }
                else{
                    $respuesta['exito']="profesorvacio";
                }
  
            } 
            
        } 
        
    }
}

mysql_close();
echo json_encode($respuesta);

?>

