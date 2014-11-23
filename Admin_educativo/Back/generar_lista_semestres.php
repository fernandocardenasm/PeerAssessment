<?php

session_start();
        
    require_once('../../funciones.php');
    conectar();
	//Recibir  

	$respuesta['exito']='';
    
    if(empty($_SESSION['user'])||empty($_SESSION['logged'])||empty($_SESSION['class'])){
        echo '<script>window.location="../../index.html"</script>';
    }
    else{
        if($_SESSION['class']!="admin_edu"){
            echo '<script>window.location="../../index.html"</script>';
        }else{

        	$respuesta['exito']='exito';
    		$sql = "SELECT * FROM semestre WHERE idRubrica IS NULL";
    		$result = mysql_query($sql) or die("La consulta no se pudo realizar");
    		$n=mysql_num_rows($result);

                $i=0;

                while($row = mysql_fetch_array($result)){

                    $respuesta[$i][0]=$row['anho'];
                    $respuesta[$i][1]=$row['periodo'];
                    $i++;
                }

                $respuesta['exito']="exito";
                $respuesta['n']=$n;
            
        }
    }
    
	echo json_encode($respuesta);
	mysql_close(); 
?>










  
	   


    


