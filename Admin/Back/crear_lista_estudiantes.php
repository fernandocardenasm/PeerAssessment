<?php

session_start();
require_once('../../funciones.php');
require_once ('../../PHPExcel_1.8.0_doc/Classes/PHPExcel/IOFactory.php');
conectar();


if(empty($_SESSION['user'])||empty($_SESSION['logged'])||empty($_SESSION['class'])){
    echo '<script>window.location="../../index.html"</script>';
}
else{
    if($_SESSION['class']!="admin"){
        echo '<script>window.location="../../index.html"</script>';
    }
    else{
        if(empty($_SESSION['semestre'])||empty($_SESSION['id_curso'])){
            echo '<script>window.location="../Front/semestres_actuales.php"</script>';
        }
        else{
            $output_dir = "./";
            $codigo_admin = $_SESSION['codigo'];
            $semestre = $_SESSION['semestre'];
            $id_curso = $_SESSION['id_curso'];
            
            if(isset($_FILES["myfile"])){
                $ret = array();
	
//              This is for custom errors;	
/*              $custom_error= array();
                $custom_error['jquery-upload-file-error']="File already exists";
                echo json_encode($custom_error);
                die();
*/
                $error =$_FILES["myfile"]["error"];
                //You need to handle  both cases
                //If Any browser does not support serializing of multiple files using FormData()
                
                
                    
                    if(!is_array($_FILES["myfile"]["name"])) //single file
                    {
                        $fileName = $codigo_admin.$_FILES["myfile"]["name"];
                        move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName);
                        $ret[]= $fileName;

                        //Cargamos archivo que vamos a leer

                        $objPHPExcel = PHPExcel_IOFactory::load($fileName);

                        //Obtenemos los datos de la hoja activa (la primera)

                        $objHoja = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
                        //$objHoja = $objPHPExcel->getActiveSheet()->toArray(null);

                        //recorremos las filas obtenidas
                        $j=0;

                        foreach($objHoja as $iIndice=>$objCelda){
                            if($j>0){
                                $obj_codigo = $objCelda['A'];
                                $obj_usuario = $objCelda['B'];
                                $obj_apellidos = $objCelda['C'];
                                $obj_nombre = $objCelda['D'];
                                
                                

                                //valida si el estudiante ya existe.
                                $sql = "SELECT * FROM estudiantetbl WHERE codigo='$obj_codigo'";
                                $result = mysql_query($sql) or die("La consulta no se pudo realizar");

                                if(mysql_num_rows($result)==0){ 
                                    $sql = "INSERT INTO estudiantetbl (codigo,nombre,usuario,apellidos) VALUES('$obj_codigo','$obj_nombre','$obj_usuario','$obj_apellidos')";
                                    $result = mysql_query($sql) or die("La consulta no se pudo realizar"); 
                                }
                                $sql = "INSERT INTO equipotbl (codigoEstudiante,idCurso) VALUES('$obj_codigo',$id_curso)";
                                $result = mysql_query($sql) or die("La consulta no se pudo realizar");

                            }
                            $j++;
                        }
                        unlink($fileName);
                        unset($_SESSION['id_curso']);

                    }
                    else  //Multiple files, file[]
                    {
                        $fileCount = count($_FILES["myfile"]["name"]);
                        for($i=0; $i < $fileCount; $i++){
                            $fileName = $_FILES["myfile"]["name"][$i];
                            move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
                            $ret[]= $fileName;
                        }

                    }
                
            echo json_encode($ret);
    
            }
 
        }
    }
}


 mysql_close();
 ?>