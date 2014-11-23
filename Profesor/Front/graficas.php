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
    
    <!-- Morris Charts CSS -->
    <link href="../../sb-admin-2/css/plugins/morris.css" rel="stylesheet">

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
                            <a  href="curso_lista_estudiantes.php"><i class="fa fa-table fa-fw"></i> Lista</a>
                        </li>
                        <li>
                            <a href="equipos.php"><i class="glyphicon glyphicon-list fa-fw"></i> Equipos</a>
                        </li>
                        <li>
                            <a href="peer_assessment.php"><i class="glyphicon glyphicon-check fa-fw"></i> Peer Assesment</a>
                        </li>
                        <li>
                            <a class="active" href="graficas.php"><i class="glyphicon glyphicon-stats fa-fww"></i> Gr&aacute;ficas</a>
                        </li>
                        
                        <!--<li>
                            <a href="tables.html"><i class="fa fa-table fa-fw"></i> Por definir</a>
                        </li>
                        <li>
                            <a href="forms.html"><i class="fa fa-wrench fa-fww"></i> Por definir</a>
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
                    <h1 class="page-header">Gr&aacute;ficas</h1>
                    <!-- /.col-lg-6 -->
                    </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Gr&aacute;fica de Equipos
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="morris-bar-chart"></div>
                                 
                        </div>
                         <!-- /.panel-body -->
                         
                        
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-6 -->
                </div>
                <!-- /.col-lg-12 -->
            
            
            
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="glyphicon glyphicon-cog fa-fw"></i> Especificaciones
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <div class="form-group">
                                <label>#Evaluaci&oacute;n: </label>
                                <select id="no_evaluacion">
                                </select>
                                </div>
                                <div class="form-group">
                                <label >#Equipo: </label>
                                <select id="no_equipo">
                                </select>
                                </div>
                                <div class="form-group">
                                <label>Integrante de equipo: </label>
                                <select id="integrante_equipo">
                                </select>
                                </div>
                                <button disabled="false" type="button" id="generar_grafica" class="btn btn-primary pull-right">Generar Grafica</button>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                <div class="col-lg-4 pull-right">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="glyphicon glyphicon-circle-arrow-down fa-fw"></i> Excel
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
                                <form method="POST" action="../Back/generar_excel_de_assessment.php" role="form" action="">
                                    <div class="list-group">
                                <label> Seleccione #Evaluaci&oacute;n que desea descargar: </label>
                                <select name="no_excel" id="no_evaluacion_excel">
                                </select>
                                </div>
                                    <div class="list-group">
                            <button disabled="false" type="submit" id="descargar_excel" class="btn btn-primary pull-right">Descargar excel</button>
                            </div>
                             </form>

                            
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            
            
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
    
    <!-- Morris Charts JavaScript -->
    <script src="../../sb-admin-2/js/plugins/morris/raphael.min.js"></script>
    <script src="../../sb-admin-2/js/plugins/morris/morris.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../sb-admin-2/js/sb-admin-2.js"></script>
    
    <script type="text/javascript">
    
    $(document).ready(function(){
        
        cargar_datos_curso();
        cargar_numero_evaluaciones();
        var grafica;
        //Carga el número de assessment realizados, los equipos que hicieron ese assessment y los miembros del equipo que lo hicieron.
        function cargar_datos_curso(){
            $.ajax({
                type:"POST",
                data:{},
                url:"../Back/cargar_datos_graficos.php",
                dataType:'json',
                success: function(h){
                if(h.exito=="exito"){
                    
                    var i,cadena='[';
                    for(i=0;i<h.num_criterios;i++){
                        if(i+1==h.num_criterios){
                            cadena=cadena+'{"criterio":"'+h['criterio'][i]+'","valor":0}]';
                        }
                        else{
                            cadena=cadena+'{"criterio":"'+h['criterio'][i]+'","valor":0},';
                        }
                    }
                    $("#generar_grafica").attr('disabled',false);
                    var data=$.parseJSON(cadena);
                                        
                    grafica = new Morris.Bar({
                        element: 'morris-bar-chart',
                        data: data,
                        xkey: 'criterio',
                        ykeys: ['valor'],
                        labels: ['Valor']
            
                    });
                    
                    var cad_assess="<option value='todos'>Todos</option>";
                    
                    
                    for(i=1;i<=h.num_de_assessment;i++){
                        cad_assess = cad_assess+ '<option value="'+h['assess']['id'][i]+'">'+h['assess']['numero'][i]+'</option>';
                    }
                    
                    $("#no_evaluacion").empty();
                    $("#no_evaluacion").append(cad_assess);
                    
                    var id_assess,num_equipo,cod_estudiante;
                    
                    $("#no_evaluacion").change(function(){
                        if($(this).val()=='todos'){
                            $("#no_equipo").empty();
                            $("#integrante_equipo").empty();
                        }
                        else{
                            id_assess = $(this).val();
                            
                            var cad_equipo="<option value='todos'>Todos</option>";
                            //alert(h['n_equipo'][id_assess]);
                            for(i=0;i<h['n_equipo'][id_assess];i++){
                                cad_equipo = cad_equipo + '<option value="'+h['num_equipo'][id_assess][i]+'">'+h['num_equipo'][id_assess][i]+'</option>';
                            }
                            
                            $("#no_equipo").empty();
                            $("#no_equipo").append(cad_equipo);
                            
                            $("#no_equipo").change(function(){
                                if($(this).val()=='todos'){
                                    $("#integrante_equipo").empty();
                                }
                                else{
                                    num_equipo = $(this).val();
                                    
                                    var cad_integrantes = "<option value='todos'>Todos</option>";
                                    
                                    for(i=0;i<h['n_estudiantes'][id_assess][num_equipo];i++){
                                        cad_integrantes = cad_integrantes + '<option value="'+
                                                h['codigo'][id_assess][num_equipo][i]+'">'+
                                                h['nombre'][id_assess][num_equipo][i]+' '+h['apellidos'][id_assess][num_equipo][i]+'</option>';
                                    }
                                    
                                    $("#integrante_equipo").empty();
                                    $("#integrante_equipo").append(cad_integrantes);
                                    
                                    
                                    $("#integrante_equipo").change(function(){
                                        cod_estudiante = $(this).val();
                                    });
                                }
                            });
                            
                        }
                        
                    });
                    
                    $("#generar_grafica").click(function(){
                        generar_grafico(id_assess,num_equipo,cod_estudiante);
                    });
                    
                    
                }
                else if(h.exito=='criteriovacio'){
                    alert("No hay criterios establecidos en la rúbrica por el momento.");
                }
                else if(h.exito=='assessvacio'){
                    alert("Las evaluaciones que podrán ser mostradas son aquellas que estén desactivas o que hayan sido respondidas en su totalidad. Por favor verifique el estado de sus evaluaciones.");
                }
                else{
                    alert("Tenemos problemas con nuestro servicio. Inténtelo más tarde por favor.");
                }
                },
                error: function(i){
                    alert("Todo mal.");
                }
            });
        }
        
        
        function generar_grafico (idassess,num_equipo,cod_estudiante){
            if($("#no_evaluacion").val()=="todos"){
                mandar_caso(idassess,num_equipo,cod_estudiante,3);
            }
            else{
                if($("#no_equipo").val()=="todos"){
                    mandar_caso(idassess,num_equipo,cod_estudiante,2);
                }
                else{
                    if($("#integrante_equipo").val()=="todos"){
                        mandar_caso(idassess,num_equipo,cod_estudiante,1);
                    }
                    else{
                        mandar_caso(idassess,num_equipo,cod_estudiante,0);
                    }
                }
            }
        }
        
        function mandar_caso(idassess,num_equipo,cod_estudiante,caso){
            $.ajax({
                type:"POST",
                data:{idassess:idassess,num_equipo:num_equipo,cod_estudiante:cod_estudiante,caso:caso},
                url:"../Back/cargar_resultados_estudiantes_grafica.php",
                dataType:'json',
                success: function(t){
                if(t.exito=="exito_0"){
                    grafica.setData($.parseJSON(t.cadena));
                }
                else if(t.exito=="exito_1"){
                    grafica.setData($.parseJSON(t.cadena));
                }
                else if(t.exito=="exito_2"){
                    grafica.setData($.parseJSON(t.cadena));
                }
                else if(t.exito=="exito_3"){
                    grafica.setData($.parseJSON(t.cadena));
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
        
        function cargar_numero_evaluaciones(){
            $.ajax({
                type:"POST",
                data:{},
                url:"../Back/cargar_numero_evaluaciones.php",
                dataType:'json',
                success: function(h){
                if(h.exito=="exito"){
                    var cad_assess_excel="";
                    var i,idassess_excel;
                    
                    for(i=0;i<h.num_de_assessment;i++){
                        cad_assess_excel = cad_assess_excel+ '<option value="'+h['assess']['id'][i]+'">'+h['assess']['numero'][i]+'</option>';
                    }
                    idassess_excel=h['assess']['id'][0];
                    
                    $("#no_evaluacion_excel").empty();
                    $("#no_evaluacion_excel").append(cad_assess_excel);
                    
                    $("#descargar_excel").attr('disabled',false);
                    
                    /*$("#no_evaluacion_excel").change(function(){
                        idassess_excel=$(this).val();
                    });
                    
                    $("#descargar_excel").click(function(){
                        generar_excel(idassess_excel);
                    });
                    */
                    
                    
                }
                },
                error: function(u){
                    alert("Actualmente presentamos problemas técnicas, por favor inténtelo de nuevo.");
                }
            });
        }
        
        
        //
        
    });
    
    </script>

</body>

<!-- About Morris Charts:

Copyright (c) 2013, Olly Smith
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:

1. Redistributions of source code must retain the above copyright notice, this
list of conditions and the following disclaimer.
2. Redistributions in binary form must reproduce the above copyright notice,
this list of conditions and the following disclaimer in the documentation
and/or other materials provided with the distribution.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
-->

</html>

