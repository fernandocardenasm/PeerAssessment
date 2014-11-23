<?php
    
    session_start();
        
    require_once('funciones.php');
    conectar();
	//Recibir
    
    if(empty($_POST['user'])||empty($_POST['portal'])){
        echo '<script>window.location="index.html"</script>';
    }
    else{
        
        $user= strip_tags($_POST['user']);
        $pass= strip_tags($_POST['pass']);
        $portal = strip_tags($_POST['portal']);
        
        $posicion_contrasenha=4;
        
        //$password=mysql_real_escape_string($pass);
        
        if(mysql_real_escape_string($portal) == 'Admin'){
            $query1= @mysql_query('SELECT * FROM admin_sistema WHERE usuario="'.mysql_real_escape_string($user).'" AND contrasenha IS NOT NULL');

            if ($existe=@mysql_fetch_object($query1)){
                
                $passBD=mysql_result($query1,0,$posicion_contrasenha);
                
                if($passBD == crypt($pass, $passBD)){
                    $_SESSION['codigo']= mysql_result($query1,0,0);
                    $_SESSION['logged']=true;
                    $_SESSION['user']=$user;
                    $_SESSION['class']='admin';
                    echo '<script>window.location="Admin/Front/inicio_admin.php"</script>';  
                }
                else{
                    echo '<script>window.location="index.html";alert("Acceso denegado como administrador. Ambos campos son incorrectos o el usuario no existe. Si es necesario, solicite nuestro servicio tecnico");'
                    . '</script>';
                }
                
                 
            }
            else{

                $query1= @mysql_query('SELECT * FROM admin_sistema WHERE usuario="'.mysql_real_escape_string($user).'" AND contrasenha IS NULL');

                if ($existe=@mysql_fetch_object($query1)){

                    $_SESSION['logged_aux']=true;
                    $_SESSION['user']=$user;
                    $_SESSION['class']='admin';
                    echo '<script>window.location="Admin/Front/registro_contrasenha.php"</script>';   

                }
                else{
                    echo '<script>window.location="index.html";alert("Acceso denegado como administrador. Ambos campos son incorrectos o el usuario no existe. Si es necesario, solicite nuestro servicio tecnico");'
                    . '</script>';

                }	

            }

        }
        else if(mysql_real_escape_string($portal) == 'AdminEducativo'){

            $query1= @mysql_query('SELECT * FROM admin_educativo WHERE usuario="'.mysql_real_escape_string($user).'" AND contrasenha IS NOT NULL');

            if ($existe=@mysql_fetch_object($query1)){
                
                $passBD=mysql_result($query1,0,$posicion_contrasenha);
                
                if($passBD == crypt($pass, $passBD)){
                
                    $_SESSION['codigo']= mysql_result($query1,0,0);
                    $_SESSION['logged']=true;
                    $_SESSION['user']=$user;
                    $_SESSION['class']='admin_edu';
                    echo '<script>window.location="Admin_educativo/Front/inicio_admin_edu.php"</script>';   
                }
                else{
                    echo '<script>window.location="index.html";alert("Acceso denegado como administrador educativo. Ambos campos son incorrectos o el usuario no existe. Si es necesario, solicite nuestro servicio tecnico");'
                    . '</script>';
                }
            }
            else{

                $query1= @mysql_query('SELECT * FROM admin_educativo WHERE usuario="'.mysql_real_escape_string($user).'" AND contrasenha IS NULL');

                if ($existe=@mysql_fetch_object($query1)){

                    $_SESSION['logged_aux']=true;
                    $_SESSION['user']=$user;
                    $_SESSION['class']='admin_edu';
                    echo '<script>window.location="Admin_educativo/Front/registro_contrasenha.php"</script>';   

                }
                else{
                    echo '<script>window.location="index.html";alert("Acceso denegado como administrador educativo. Ambos campos son incorrectos o el usuario no existe. Si es necesario, solicite nuestro servicio tecnico");'
                    . '</script>';

                }	

            }

        }
        else if(mysql_real_escape_string($portal) == 'Profesor'){

            $query1= @mysql_query('SELECT * FROM profesortbl WHERE usuario="'.mysql_real_escape_string($user).'" AND contrasenha IS NOT NULL');

            if ($existe=@mysql_fetch_object($query1)){
                
                $passBD=mysql_result($query1,0,$posicion_contrasenha);
                
                if($passBD == crypt($pass, $passBD)){
                
                    $_SESSION['codigo']= mysql_result($query1,0,0);
                    $_SESSION['logged']=true;
                    $_SESSION['user']=$user;
                    $_SESSION['class']='profesor';
                    echo '<script>window.location="Profesor/Front/inicio_profesor.php"</script>';  
                }
                else{
                    echo '<script>window.location="index.html";alert("Acceso denegado como profesor. Ambos campos son incorrectos o el usuario no existe. Si es necesario, solicite nuestro servicio tecnico");'
                    . '</script>';
                }
            }
            else{

                $query1= @mysql_query('SELECT * FROM profesortbl WHERE usuario="'.mysql_real_escape_string($user).'" AND contrasenha IS NULL');

                if ($existe=@mysql_fetch_object($query1)){

                    $_SESSION['logged_aux']=true;
                    $_SESSION['user']=$user;
                    $_SESSION['class']='profesor';
                    echo '<script>window.location="Profesor/Front/registro_contrasenha_profesor.php"</script>';   

                }
                else{
                    echo '<script>window.location="index.html";alert("Acceso denegado como profesor. Ambos campos son incorrectos o el usuario no existe. Si es necesario, solicite nuestro servicio tecnico");'
                    . '</script>';

                }	

            }

        }
        else if(mysql_real_escape_string($portal) == 'Estudiante'){

            $query1= @mysql_query('SELECT * FROM estudiantetbl WHERE usuario="'.mysql_real_escape_string($user).'" AND contrasenha IS NOT NULL');

            if ($existe=@mysql_fetch_object($query1)){
                
                $passBD=mysql_result($query1,0,$posicion_contrasenha);
                
                if($passBD == crypt($pass, $passBD)){
                
                    $_SESSION['codigo']= mysql_result($query1,0,0);
                    $_SESSION['logged']=true;
                    $_SESSION['user']=$user;
                    $_SESSION['class']='estudiante';
                    echo '<script>window.location="Estudiante/Front/inicio_estudiante.php"</script>';  
                }
                else{
                    echo '<script>window.location="index.html";alert("Acceso denegado como estudiante. Ambos campos son incorrectos o el usuario no existe. Si es necesario, solicite nuestro servicio tecnico");'
                    . '</script>';
                }
            }
            else{

                $query1= @mysql_query('SELECT * FROM estudiantetbl WHERE usuario="'.mysql_real_escape_string($user).'" AND contrasenha IS NULL');

                if ($existe=@mysql_fetch_object($query1)){

                    $_SESSION['logged_aux']=true;
                    $_SESSION['user']=$user;
                    $_SESSION['class']='estudiante';
                    echo '<script>window.location="Estudiante/Front/registro_contrasenha_estudiante.php"</script>';   

                }
                else{
                    echo '<script>window.location="index.html";alert("Acceso denegado como estudiante. Ambos campos son incorrectos o el usuario no existe. Si es necesario, solicite nuestro servicio tecnico");'
                    . '</script>';

                }	

            }
        }
        
    }
    
    
    
	mysql_close(); 
?>