<?php
session_start();

if(empty($_SESSION['user'])||empty($_SESSION['logged'])||empty($_SESSION['class'])){
    echo '<script>window.location="../../index.html"</script>';
}
else{
    
    if(empty($_SESSION['curso_seleccionado'])){
        echo '<script>window.location="../../inicio_profesor.php"</script>';
    }
    else{
        if(!empty($_SESSION['class'])){
            if($_SESSION['class']!="profesor"){
                echo '<script>window.location="../../index.html"</script>';
            }
        }
    }
    
}


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Peer Assessment</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../sb-admin-2/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../sb-admin-2/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../sb-admin-2/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../sb-admin-2/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="inicio_profesor.php">Peer Assessment</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <!--<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        -->
                        <li><a href="../../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <!--<li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group 
                        </li>
                        -->
                        <li>
                            <a class="active" href="curso_lista_estudiantes.php"><i class="fa fa-table fa-fw"></i> Lista</a>
                        </li>
                        <li>
                            <a href="equipos.php"><i class="glyphicon glyphicon-list fa-fw"></i> Equipos</a>
                        </li>
                        <li>
                            <a href="peer_assessment.php"><i class="glyphicon glyphicon-check fa-fw"></i> Peer Assesment</a>
                        </li>
                       <li>
                            <a href="graficas.php"><i class="glyphicon glyphicon-stats fa-fww"></i> Gr&aacute;ficas</a>
                        </li>
                        
                        <!--
                        <li>
                            <a href="mostrar_rubrica.php"><i class="fa fa-wrench fa-fww"></i> Rubrica</a>
                        </li>
                        <li>
                            <a href="inicio_profesor.php"><i class="fa fa-wrench fa-fww"></i> Volver</a>
                        </li>
                        -->
                        <li>
                            <a href="cursos_actuales.php"><i class="glyphicon glyphicon-arrow-left fa-fww"></i> Volver</a>
                        </li>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Lista</h1>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Apellidos</th>
                                        <th>Nombre</th>
                                        <th>Usuario</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div> 
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="../../sb-admin-2/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../sb-admin-2/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../sb-admin-2/js/plugins/metisMenu/metisMenu.min.js"></script>
    
    <!-- DataTables JavaScript -->
    <script src="../../sb-admin-2/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="../../sb-admin-2/js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../sb-admin-2/js/sb-admin-2.js"></script>
    
    <script type="text/javascript">
    
    $(document).ready(function() {
        
        var t = $('#dataTables-example').dataTable();
        
        cargar_lista_de_estudiantes();
        
        function cargar_lista_de_estudiantes(){
            
            //Carga la lista de estudiantes que todavia no tienen equipo en la ventana modal para que se les asigne un equipo.
            $.ajax({
                type:"POST",
                data:{},
                url:"../Back/cargar_lista_de_estudiantes.php",
                dataType:'json',
                success: function(h){
                if(h.exito=="exito"){
                    
                    var i,j;
                    t.fnClearTable();
                    for(i=0;i<h.n;i++){
                        t.fnAddData([
                            h[i][0],
                            h[i][1],
                            h[i][2],
                            h[i][3]
                        ]);
                    }
                }
                else if(h.exito=='listavacia'){
                    alert("No hay estudiantes asignados al curso.");
                }
                else{
                    alert("Tenemos problemas con nuestro servicio. Inténtelo más tarde por favor.");
                }
                },
                error: function(i){
                }
            });
        }
        
    });
    
    </script>

</body>

</html>

