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
    
    <!-- DataTables CSS -->
    <link href="../../sb-admin-2/css/plugins/dataTables.bootstrap.css" rel="stylesheet">

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
                            <a href="curso_lista_estudiantes.php"><i class="fa fa-table fa-fw"></i> Lista</a>
                        </li>
                        <li>
                            <a class="active"  href="equipos.php"><i class="glyphicon glyphicon-list fa-fw"></i> Equipos</a>
                        </li>
                        <li>
                            <a href="peer_assessment.php"><i class="glyphicon glyphicon-check fa-fw"></i> Peer Assesment</a>
                        </li>
                        <li>
                            <a href="graficas.php"><i class="glyphicon glyphicon-stats fa-fww"></i> Gr&aacute;ficas</a>
                        </li>
                        
                        <!--<li>
                            <a href="graficas.php"><i class="fa fa-wrench fa-fww"></i> Gr&aacute;ficas</a>
                        </li>
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
                    <h1 class="page-header">Equipos</h1>
                    
                    <div class="panel-body">
                            <!-- Button trigger modal -->
                            
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Lista de estudiantes</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Apellidos</th>
                                                            <th>Nombre</th>
                                                            <th>Agregar</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        <!-- /.table-responsive -->                                           
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button id="guardar_cambios" type="button" class="btn btn-primary">Guardar cambios</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            
                            <!-- Modal -->
                            <div class="modal fade" id="myModalModEquipos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel2">Lista de estudiantes</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover" id="dataTables-mod_equipos">
                                                    <thead>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Apellidos</th>
                                                            <th>Nombre</th>
                                                            <th>Agregar</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        <!-- /.table-responsive -->                                           
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button id="guardar_cambios_mod_equipos" type="button" class="btn btn-primary">Guardar cambios</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            
                            <p></p>
                            
                            <div id="sub_lista_equipos">
                                
                            </div>
                            <button id="agregar_equipo" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-small">
                                Agregar Equipo
                            </button>
                    
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
        
        var t2 = $('#dataTables-mod_equipos').dataTable();
        
        $("#agregar_equipo").click(cargar_lista_de_estudiantes);
        
        cargar_equipos();
        
        function cargar_lista_de_estudiantes(){
            
            
            //Carga la lista de estudiantes que todavia no tienen equipo en la ventana modal para que se les asigne un equipo.
            $.ajax({
                type:"POST",
                data:{},
                url:"../Back/cargar_lista_de_estudiantes_equipo.php",
                dataType:'json',
                success: function(h){
                if(h.exito=="exito"){
                    
                    $('#guardar_cambios').attr("disabled", false);
                    var i,j;
                    t.fnClearTable();
                    for(i=0;i<h.n;i++){
                        t.fnAddData([
                            h[i][0],
                            h[i][1],
                            h[i][2],
                            '<input type="checkbox" class="checkbox" value="'+h[i][0]+'">'
                            
                        ]);
                    }
                    $("#guardar_cambios").click(function(){
                        
                        
                        
                        $('#guardar_cambios').attr("disabled", true);
                        //Obtener los estudiantes seleccionados
                        
                        var ids = [];
                        $("input.checkbox:checked").each(function() {
                                ids.push($(this).val());
                        });
                       if(ids.length!=0){
                           
                           $.ajax({
                            type:"POST",
                            data:{codigos_estudiantes:ids,num_estudiantes:ids.length},
                            url:"../Back/guardar_miembros_equipo.php",
                            dataType:'json',
                            success: function(g){
                            if(g.exito=="exito"){
                                $('#guardar_cambios').attr("disabled", false);
                                //cargar_lista_de_estudiantes();
                                $('#myModal').modal('hide');
                                window.location.reload(true);
                                
                            }
                            else{
                                alert("Actualmente presentamos problemas técnicas, por favor inténtelo de nuevo.");
                            }
                            },
                            error: function(o){
                                alert("Todo mal");
                            }
                            });
                       }
                       else{
                           alert("No ha seleccionado ningún estudiante.");
                       }
                       

                    });
                    
                }
                else if(h.exito=='listavacia'){
                    alert("Ya todos los estudiantes fueron incluidos dentro de un equipo.");
                    $('#guardar_cambios').attr("disabled", true);
                }
                else{
                    alert("Tenemos problemas con nuestro servicio. Inténtelo más tarde por favor.");
                    $('#guardar_cambios').attr("disabled", true);
                }
                },
                error: function(i){
                    alert("Todo mal");
                }
            });
        }
        
        
        //Cargar lista de equipos.
        
        
        function cargar_equipos(){
            
            $.ajax({
                type:"POST",
                data:{},
                url:"../Back/cargar_lista_equipos.php",
                dataType:'json',
                success: function(h){
                if(h.exito=="exito"){
                    $("#sub_lista_equipos").empty();
                    $("#sub_lista_equipos").append(h.cadena);       
                    $('#guardar_cambios_mod_equipos').attr("disabled", true);
                    
                    //Agregar estudiante en nuevo equipo
                    
                    $("a[tipo=link_agregar_estudiante]").click(function(){
                        var numero_equipo=$(this).attr('numero_equipo');
                        
                        $('#myModalModEquipos').modal('show');
                        
                        
                        $.ajax({
                            type:"POST",
                            data:{},
                            url:"../Back/cargar_lista_de_estudiantes_equipo.php",
                            dataType:'json',
                            success: function(g){
                            if(g.exito=="exito"){
                    
                                $('#guardar_cambios_mod_equipos').attr("disabled", false);
                                var i,j;
                                t2.fnClearTable();
                                for(i=0;i<g.n;i++){
                                    t2.fnAddData([
                                    g[i][0],
                                    g[i][1],
                                    g[i][2],
                                    '<input type="checkbox" class="checkbox" value="'+g[i][0]+'">'
                            
                                    ]);
                                }
    
                                $("#guardar_cambios_mod_equipos").click(function(){
                        
                                    $('#guardar_cambios').attr("disabled", true);
                                    //Obtener los estudiantes seleccionados
                        
                                    var ids = [];
                                    $("input.checkbox:checked").each(function() {
                                        ids.push($(this).val());
                                    });
                                    if(ids.length!=0){
                                        
                                        $.ajax({
                                            type:"POST",
                                            data:{codigos_estudiantes:ids,num_estudiantes:ids.length,nuevo_num_equipo:numero_equipo},
                                            url:"../Back/guardar_nuevos_miembros_equipo.php",
                                            dataType:'json',
                                            success: function(p){
                                            if(h.exito=="exito"){
                                                $('#guardar_cambios_mod_equipos').attr("disabled", false);
                                                $('#myModalModEquipos').modal('hide');
                                                window.location.reload(true);
                                            }
                                            else{
                                                alert("Actualmente presentamos problemas técnicas, por favor inténtelo de nuevo.");
                                            }
                                            },
                                            error: function(u){
                                                alert("Todo mal");
                                            }
                                        });
                                        
                                    }
                                    else{
                                        alert("No ha seleccionado ningún estudiante.");
                                    }
                                });
                    
                            }
                            else if(g.exito=='listavacia'){
                                alert("Ya todos los estudiantes fueron incluidos dentro de un equipo.");
                                $('#guardar_cambios').attr("disabled", true);
                            }
                            else{
                                alert("Tenemos problemas con nuestro servicio. Inténtelo más tarde por favor.");
                                $('#guardar_cambios').attr("disabled", true);
                            }
                            },
                            error: function(i){
                                alert("Todo mal");
                            }
                        });
                        
                        
                    });
                    
                    //Eliminar estudiante del equipo
                    
                    $("a[tipo=link_eliminar_estudiante]").click(function(){
                        var codigo_estudiante = $(this).attr('id_estudiante');
                        $.ajax({
                        type:"POST",
                        data:{codigos_estudiante:codigo_estudiante},
                        url:"../Back/eliminar_miembro_equipo.php",
                        dataType:'json',
                        success: function(a){
                        if(a.exito=="exito"){
                            alert("Estudiante eliminado.");
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
                else if(h.exito=='listavacia'){
                    $("#sub_lista_equipos").empty();
                    alert("No hay ningún equipo creado. Por favor cree uno.");
                }
                else{
                    $("#sub_lista_equipos").empty();
                    alert("Tenemos problemas con nuestro servicio. Inténtelo más tarde por favor.");
                }
                },
                error: function(i){
                    alert("Todo mal");
                }
            });
            
        }
        
        
        
    });
    
    </script>

</body>

</html>