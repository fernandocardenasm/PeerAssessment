<?php
session_start();

if(empty($_SESSION['user'])||empty($_SESSION['logged'])||empty($_SESSION['class'])){
    echo '<script>window.location="../../index.html"</script>';
}
else{
    if($_SESSION['class']!="admin"){
        echo '<script>window.location="../../index.html"</script>';
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
    
    <link href="https://rawgithub.com/hayageek/jquery-upload-file/master/css/uploadfile.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="../../sb-admin-2/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../sb-admin-2/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../sb-admin-2/css/sb-admin-2.css" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link href="../../sb-admin-2/css/plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- bootstrapValidator Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../../bootstrapValidator/css/bootstrapValidator.css">

    <!-- Custom Fonts -->
    <link href="../../sb-admin-2/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <style type="text/css">
        @media (max-width: 768px) {
            li.dropdown{
                float: right;
            }
        }
    </style>
    
    

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
                <a class="navbar-brand" href="inicio_admin.php">Peer Assessment</a>
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
                            <a href="#"><i class="glyphicon glyphicon-book"></i> Cursos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a class="active" href="semestre_crear_curso.php">Crear</a>
                                </li>
                                <!--<li>
                                    <a  href="buscar_cursos.php">Buscar</a>
                                </li>
                                <li>
                                    <a href="modificar_curso.html">Modificar</a>
                                </li>
                                <li>
                                    <a href="eliminar_curso.html">Eliminar</a>
                                </li>
                                -->
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="semestres_actuales.php"><i class="glyphicon glyphicon-arrow-left fa-fw"></i> Volver</a>
                        </li>
                        <!--<li>
                            <a href="forms.html"><i class="fa fa-wrench fa-fww"></i> Por definir</a>
                        </li>
                        -->
                        
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
                    <h1 class="page-header">Creaci&oacute;n de cursos</h1>
                    
                        <div class="panel-body">
   
                            <div class="panel-body">
                                <form role="form" id="courseCreationForm">
                                    <div class="form-group">
                                        <label>Nombre de la materia</label>
                                        <input id="nombre_materia" class="form-control" placeholder="Digite el nombre de la materia" name="subjectName">
                                    </div>
                                    <div class="form-group">
                                        <label>NRC</label>
                                        <input id="NRC" class="form-control" placeholder="Digite el NRC" name="nrc">
                                    </div>
                                    <div class="form-group">
                                        <label>C&oacute;digo de la materia</label>
                                        <input id="codigo_materia" class="form-control" name="subjectCode">
                                        <p class="help-block">Ejemplo: IST es el c&oacute;digo para las materias de Ing de Sistemas.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Curso de la materia</label>
                                        <input id="curso_materia" class="form-control" name="subjectCourse">
                                        <p class="help-block">Ejemplo: El curso para Algoritmia y programaci&oacute;n I es 2088</p>
                                    </div>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Lista de profesores</h4>
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
                                    
                                    <div class="form-group">
                                        <label>C&oacute;digo de profesores asociados a la materia(M&aacute;ximo 2)</label>
                                    </div>
                                    <div class="form-group">
                                        <!-- Control de cambio (Leandro): Quitar type="button" si algo sale mal. -->
                                        <button type="button" id="seleccionar_profesor" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-small">
                                            Seleccione profesores
                                        </button>
                                        <div id="sub_profesores">
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Seleccione la lista con los datos de los estudiantes</label>
                                        <div id="fileuploader">Adjuntar</div>
                                        <div id="eventsmessage"></div>
                                    </div>
                                    
                                    <button type="submit" id="click_crear_nuevo_curso" class="btn btn-primary">Crear curso</button>
                                    </div>
                                </form>
                                                
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

    <!-- bootstrapValidator JavaScript -->
    <script src="../../bootstrapValidator/js/bootstrapValidator.js"></script>

    <!-- bootstrapValidator Validation Script: Check out validation rules here -->
    <script src="../../bootstrapValidator/js/formValidation.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../sb-admin-2/js/plugins/metisMenu/metisMenu.min.js"></script>
    
    <!-- DataTables JavaScript -->
    <script src="../../sb-admin-2/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="../../sb-admin-2/js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../sb-admin-2/js/sb-admin-2.js"></script>
    
    <script src="https://rawgithub.com/hayageek/jquery-upload-file/master/js/jquery.uploadfile.min.js"></script>
    
    <script type="text/javascript">
    
    $(document).ready(function(){
        
        var t = $('#dataTables-example').dataTable();
        var ids = [];
        var codigo_primer_profesor;
        var codigo_segundo_profesor;
        
        //cargar archivo de excel
        var uploadObj = $("#fileuploader").uploadFile({
            url:"../Back/crear_lista_estudiantes.php",
            multiple:false,
            autoSubmit:false,
            fileName:"myfile",
            allowedTypes:"xlsx,xls,csv",
            maxFileCount:1,
            showStatusAfterSuccess:false,
            dragDropStr: "<span><b>Arrastre o adjunte su archivo.</b></span>",
            abortStr:"rendirse",
            cancelStr:"Eliminar",
            doneStr:"Terminado",
            multiDragErrorStr: "Solo es permitido un archivo.",
            extErrorStr:"Solo se aceptan las extensiones: ",
            uploadErrorStr:"Cargar no está permitido."

        }); 
        
        
        //Crea el curso asociado al semestre
        
        $("#click_crear_nuevo_curso").click(function(){
            
            var nombre_materia=$("#nombre_materia").val();
            var nrc=$("#NRC").val();
            var codigo_materia=$("#codigo_materia").val();
            var curso_materia= $("#curso_materia").val();
            
            if(ids.length!=0){
                $.ajax({
                    type:"POST",
                    data:{nombre:nombre_materia,
                        nrc:nrc,
                        codigo_materia:codigo_materia,
                        curso:curso_materia,
                        codigo_primer_profesor:codigo_primer_profesor,
                        codigo_segundo_profesor:codigo_segundo_profesor,
                    },
                    url:"../Back/crear_nuevo_curso.php",
                    dataType:'json',
                    success: function(h){
                        if(h.exito=="creado"){
                            alert("El curso fue creado exitosamente.");
                            uploadObj.startUpload();
                            window.location.reload(true);
                        }
                        else if(h.exito=="repetido"){
                            alert("El curso que desea crear ya existe.");
                        }
                        else if(h.exito=="profesorvacio"){
                            alert("El codigo del profesor asociado no existe.");
                        }
                        else{
                            alert("Actualmente tenemos problemas técnicos. Por favor inténtelo más tarde.");
                        }
                    },
                    error: function(i){
                        alert("Todo mal");
                    }
                });
            }
            else{
                alert("No ha seleccionado ningún profesor. Por favor seleccione al menos uno.");
            }
            
        });
        
        
        //Al clicar en los profesores
        
        $("#seleccionar_profesor").click(function(){
            $.ajax({
                type:"POST",
                data:{},
                url:"../Back/cargar_lista_de_profesores.php",
                dataType:'json',
                 success: function(h){
                    if(h.exito=="exito"){
                        
                        //$('#myModal').modal('hide');
                        //$('#guardar_cambios').attr("disabled", false);
                        
                        var i,j;
                        t.fnClearTable();
                        for(i=0;i<h.n;i++){
                            t.fnAddData([
                                h[i][0],
                                h[i][1],
                                h[i][2],
                                '<input type="checkbox" class="checkbox" value="'+h[i][0]+'" apellidos="'+h[i][1]+'" nombre="'+h[i][2]+'">'

                            ]);
                        }
                        $("#guardar_cambios").click(function(){
                        
                            ids = [];
                            var nombres = [];
                            var apellidos = [];
                            var cadena="";
                                $("input.checkbox:checked").each(function() {
                                    ids.push($(this).val());
                                    nombres.push($(this).attr('nombre'));
                                    apellidos.push($(this).attr('apellidos'));
                                });
                                
                                if(ids.length==0){
                                    alert("No se ha seleccionado ningún estudiante.");
                                }
                                else if(ids.length==1){
                                    codigo_primer_profesor = ids[0];
                                    codigo_segundo_profesor = "vacio";
                                    cadena="";
                                    cadena=cadena+'<div class="form-group">'+
                                            '<label>Profesor agregado: '+nombres[0]+' '+apellidos[0]+'</label>'+
                                            '</div>';
                                    $("#sub_profesores").empty();
                                    $("#sub_profesores").append(cadena);
                                    $('#myModal').modal('hide');
                                }
                                else if(ids.length==2){
                                    codigo_primer_profesor = ids[0];
                                    codigo_segundo_profesor = ids[1];
                                    
                                    cadena="";
                                    cadena=cadena+'<div class="form-group">'+
                                            '<label>Profesores agregados: '+nombres[0]+' '+apellidos[0]+' y '+nombres[1]+' '+apellidos[1]+'</label>'+
                                            '</div>';
                                    $("#sub_profesores").empty();
                                    $("#sub_profesores").append(cadena);
                                    $('#myModal').modal('hide');
                                    
                                }
                                else{
                                    alert("Solo se permiten 2 profesores por curso.");
                                }
                        });
                                
                    }
                    else{
                        alert("Actualmente presentamos problemas técnicas, por favor inténtelo de nuevo.");
                     }
                },
                error: function(o){
                    alert("Todo mal");
                }
            });
            
        });
        
        

        
    });
    
    
    </script>

</body>

</html>


