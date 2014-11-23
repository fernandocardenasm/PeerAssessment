<?php
session_start();

if((!$_SESSION["logged"]) && !$_SESSION['class']=='profesor'){
    
    echo '<script>window.location="../../index.html"</script>';
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

    <title>Peer Assesment</title>

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
                <a class="navbar-brand" href="inicio_profesor.php">Peer Assesment</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
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
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a class="active" href="curso_lista_estudiantes.php"><i class="fa fa-dashboard fa-fw"></i> Lista</a>
                        </li>
                        <li>
                        </li>
                        <li>
                            <a href="equipos.php"><i class="fa fa-table fa-fw"></i> Equipos</a>
                        </li>
                        <li>
                            <a href="peer_assesment.php"><i class="fa fa-wrench fa-fww"></i> Peer Assesment</a>
                        </li>
                        <li>
                            <a href="graficas.php"><i class="fa fa-wrench fa-fww"></i> Gr&aacute;ficas</a>
                        </li>
                        <li>
                            <a href="mostrar_rubrica.php"><i class="fa fa-wrench fa-fww"></i> Rubrica</a>
                        </li>
                        <li>
                            <a href="inicio_profesor.php"><i class="fa fa-wrench fa-fww"></i> Volver</a>
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
                    <h1 class="page-header">Evaluciones por pares</h1>
                    
                    <div id="sub_lista_evaluaciones">
                                
                    </div>
                    <button data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-small">
                        Agregar Evaluaci&oacute;n
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Agregar nueva evaluaci&oacute;n</h4>
                                </div>
                                <div class="modal-body">
                                    ¿Está seguro que desea agrega una nueva evaluaci&oacute;n por pares?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <button type="button" id="crear_nueva_evaluacion" class="btn btn-primary">S&iacute;</button>
                                </div>
                            </div>
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

    <!-- Custom Theme JavaScript -->
    <script src="../../sb-admin-2/js/sb-admin-2.js"></script>
    
    <script type="text/javascript">
        
    $(document).ready(function() {
        
        cargar_evaluaciones();
        
        function cargar_evaluaciones(){
            $.ajax({
                type:"POST",
                data:{},
                url:"../Back/cargar_lista_evaluaciones.php",
                dataType:'json',
                success: function(h){
                if(h.exito=="exito"){
                    $("#sub_lista_evaluaciones").empty();
                    $("#sub_lista_evaluaciones").append(h.cadena); 
                    
                    $("button[tipo=activar_evaluacion]").click(function(){
                        var id_assesment = $(this).attr('id');
                        $.ajax({
                            type:"POST",
                            data:{id:id_assesment,accion:0},
                            url:"../Back/activar_desactivar_estado_assessment.php",
                            dataType:'json',
                            success: function(h){
                            if(h.exito=="exito"){
                                window.location.reload(true);
                            }
                            else{
                                alert("Actualmente presentamos problemas técnicas, por favor inténtelo de nuevo.");
                            }
                            },
                            error: function(i){
                                alert("Todo mal");
                            }
                        });
                        
                    });
                    
                    $("button[tipo=desactivar_evaluacion]").click(function(){
                        var id_assesment = $(this).attr('id');
                        $.ajax({
                            type:"POST",
                            data:{id:id_assesment,accion:1},
                            url:"../Back/activar_desactivar_estado_assessment.php",
                            dataType:'json',
                            success: function(h){
                            if(h.exito=="exito"){
                                window.location.reload(true);
                            }
                            else{
                                alert("Actualmente presentamos problemas técnicas, por favor inténtelo de nuevo.");
                            }
                            },
                            error: function(i){
                                alert("Todo mal");
                            }
                        });
                        
                    });
                         
                }
                else if(h.exito=="vacio"){
                    alert("No hay ninguna evaluacion por pares creada por el momento.");
                }
                else{
                    alert("Actualmente presentamos problemas técnicas, por favor inténtelo de nuevo.");
                }
                },
                error: function(i){
                    alert("Todo mal");
                }
            });
        }
        
        //Crear nueva evaluacion por pares
        
        $("#crear_nueva_evaluacion").click(function(){
            
            $.ajax({
                type:"POST",
                data:{},
                url:"../Back/crear_nueva_evaluacion.php",
                dataType:'json',
                success: function(h){
                if(h.exito=="exito"){
                    
                    window.location.reload(true);       
                }
                else{
                    alert("Actualmente presentamos problemas técnicas, por favor inténtelo de nuevo.");
                }
                },
                error: function(i){
                    alert("Todo mal");
                }
            });
            
        });
        
    });
    </script>
</body>

</html>

