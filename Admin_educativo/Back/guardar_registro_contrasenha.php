<?php

session_start();
        
    require_once('../../funciones.php');
    conectar();
	//Recibir
    
    
    if(empty($_SESSION['user'])||empty($_SESSION['logged_aux'])||empty($_SESSION['class'])){
        echo '<script>window.location="../../index.html"</script>';
    }
    else{
        if($_SESSION['class']!="admin_edu"){
            echo '<script>window.location="../../index.html"</script>';
        }
        else{
            
            if(empty($_POST['pass'])||empty($_POST['pass2'])||empty($_POST['codigo'])){
                echo '<script>window.location="../../index.html"</script>';
            }
            else{
            
                $user= $_SESSION['user'];
                $pass= strip_tags($_POST['pass']);
                $pass2= strip_tags($_POST['pass2']);
                $codigo = strip_tags($_POST['codigo']);
                
                $password1 = crypt_blowfish_bydinvaders($pass);

                $query1= @mysql_query('SELECT * FROM admin_educativo WHERE usuario="'.mysql_real_escape_string($user).'" AND codigo="'.mysql_real_escape_string($codigo).'"');

                if ($existe=@mysql_fetch_object($query1)){

                    if($pass==$pass2){
                        $_SESSION['codigo']=$codigo; 
                        $_SESSION['logged']=true;            
                        $sql = "UPDATE admin_educativo SET contrasenha='$password1' WHERE usuario='$user'";
                        $result = mysql_query($sql) or die("La consulta no se pudo realizar");
                        unset($_SESSION['logged_aux']);
                        echo '<script>window.location="../Front/inicio_admin_edu.php";</script>';    

                    }
                    else{
                        echo '<script>window.location="../Front/registro_contrasenha.php";alert("Las contraseñas ingresadas no son iguales.");</script>'; 
                    }
                }
                else{
                    echo '<script>alert("Los datos ingresados no son validos.");window.location="../../index.html";</script>';  
                }
            }
        }
    }
    
	
	mysql_close(); 
?>
