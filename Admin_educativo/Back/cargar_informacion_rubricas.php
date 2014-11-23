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
	
		$sql = "SELECT id,nombre FROM rubricaestandar";

		$result = mysql_query($sql) or die("La consulta no se pudo realizar");

		$n=mysql_num_rows($result);
		
		if($n>0){
			$i=0;
			while($row = mysql_fetch_array($result)){
				$id=$row['id'];
				$respuesta[$i][0]=$row['id'];
				$respuesta[$i][1]=$row['nombre'];
				
				$sql2 = "SELECT idRubrica FROM semestre WHERE idRubrica=$id";
				$result2 = mysql_query($sql2) or die("La consulta no se pudo realizar");
				$m=mysql_num_rows($result2);
				if($m>0){
					$respuesta[$i][2]='Si';					
				}else{
					$respuesta[$i][2]='No';			
				}
				
				$i++;
			}
			$respuesta['exito']="exito";
			$respuesta['n']=$n;
		}
		else{
			$respuesta['exito']="listavacia"; 
		}
        
    }
}


echo json_encode($respuesta);
mysql_close();
?>
