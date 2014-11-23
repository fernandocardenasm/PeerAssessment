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
	
		$sql = "SELECT codigo,nombre,apellidos,usuario,contrasenha FROM estudiantetbl";

		$result = mysql_query($sql) or die("La consulta no se pudo realizar");

		$n=mysql_num_rows($result);

		if($n>0){
			$i=0;

			while($row = mysql_fetch_array($result)){

				$respuesta[$i][0]=$row['codigo'];
				$respuesta[$i][1]=$row['nombre'];
				$respuesta[$i][2]=$row['apellidos'];
				$respuesta[$i][3]=$row['usuario'];
				if (empty($row['contrasenha'])){
					$respuesta[$i][4]='No';
				}else{
					$respuesta[$i][4]='Sí';
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
