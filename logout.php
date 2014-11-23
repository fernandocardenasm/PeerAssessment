<?php
session_start();

if(empty($_SESSION['user'])||empty($_SESSION['logged'])||empty($_SESSION['class'])){
    echo '<script>window.location="index.html"</script>';
}
else{
    if(!empty($_SESSION['user'])){
        unset($_SESSION['user']);
    }
    if(!empty($_SESSION['logged'])){
        unset($_SESSION['logged']);
    }
    if(!empty($_SESSION['codigo'])){
        unset($_SESSION['codigo']);
    }
    if(!empty($_SESSION['class'])){
        unset($_SESSION['class']);
    }
    if(!empty($_SESSION['semestre'])){
        unset($_SESSION['semestre']);
    }
    if(!empty($_SESSION['id_curso'])){
        unset($_SESSION['id_curso']);
    }
    if(!empty($_SESSION['curso_seleccionado'])){
        unset($_SESSION['curso_seleccionado']);
    }
    if(!empty($_SESSION['semestre'])){
        unset($_SESSION['semestre']);
    }
    session_destroy();
    echo '<script>window.location="index.html"</script>';
    
}
  
  ?>
