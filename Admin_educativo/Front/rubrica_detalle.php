<?php
session_start();

if(empty($_SESSION['user'])||empty($_SESSION['logged'])||empty($_SESSION['class'])){
    echo '<script>window.location="../../index.html"</script>';
}
else{
    if($_SESSION['class']!="admin_edu"){
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

        <!-- Bootstrap Core CSS -->
        <link href="../../sb-admin-2/css/bootstrap.min.css" rel="stylesheet">

        <!-- Fuelux: Latest compiled and minified CSS -->
        <!-- Needed to add extra components to Bootstrap -->
        <!-- <link rel="../../sb-admin-2/css/plugins/fuelux/fuelux.min.css"> -->

        <!-- MetisMenu CSS -->
        <link href="../../sb-admin-2/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../../sb-admin-2/css/sb-admin-2.css" rel="stylesheet">
		
		<!-- bootstrapValidator Custom CSS -->
		<link rel="stylesheet" type="text/css" href="../../bootstrapValidator/css/bootstrapValidator.css">

        <!-- Custom Fonts -->
        <link href="../../sb-admin-2/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->

        <style type="text/css">
            @media (max-width: 768px) {
                li.dropdown{
                    float: right;
                }
            }
        </style>

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
                    <a class="navbar-brand" href="inicio_admin_edu.php">Peer Assessment</a>
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
							<li>
								<a href="inicio_admin_edu.php"><i class="glyphicon glyphicon-home fa-fw"></i> Inicio</a>
							</li>
							<li>
								<a class="active" href="#"><i class="glyphicon glyphicon-list-alt fa-fw"></i> Rúbricas<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
								<li>
                                    <a href="rubricas.php">Revisar</a>
                                </li>
                                <li>
                                    <a href="rubrica_crear.php">Crear</a>
                                </li>
								</ul>
								<!-- /.nav-second-level -->
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

                    <h1 class="page-header">Información de Rúbrica</h1>

                    <div class="panel-body"><!--Main Panel-->

                        <div class="row" id="panelDetalle">

                            <div class="col-sm-12">

                                <div class="row">

                                    <div class="col-sm-12">

                                        <h2 class="sub-header">
										nombre
										</h2>
										<h3 class="sub-header">Detalles de la Rúbrica</h3>

                                        <div class="table-responsive">

                                            <table id="infoRubrica" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                      <th>Criterio</th>
													  <th>Descriptor</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>

                                        </div><!--Fin de tabla de descripciones-->
										
										<h3 class="sub-header">Semestres Asignados</h3>

                                        <div class="table-responsive">

                                            <table id="infoRubrica" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                      <th>Año</th>
													  <th>Período</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>

                                        </div><!--Fin de tabla de descripciones-->

                                    </div><!--Fin de division 12-->


                                </div>


                            </div><!-- /.col-sm-12 -->


                        </div>


                    </div><!-- /.col-lg-12 -->


                </div><!-- /.row -->
            </div><!-- /#page-wrapper -->
        <!-- End Page Content -->
        </div><!-- /#wrapper -->
		
	</div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="../../sb-admin-2/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../sb-admin-2/js/bootstrap.min.js"></script>

    <!-- Fuelux: Latest compiled and minified JavaScript -->
    <!-- Needed to add extra components to Bootstrap -->
    <!-- <script src="../../sb-admin-2/js/plugins/fuelux/fuelux.min.js"></script> -->
	
	<!-- bootstrapValidator JavaScript -->
    <script src="../../bootstrapValidator/js/bootstrapValidator.js"></script>

    <!-- bootstrapValidator Validation Script: Check out validation rules here -->
    <script src="../../bootstrapValidator/js/formValidation.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../sb-admin-2/js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../sb-admin-2/js/sb-admin-2.js"></script>

    <script>

    $(document).ready(function(){

	/*
        $("#confirmarNuevoCriterio").click(function(){
			$('#addCriteriaForm').bootstrapValidator('validate');
			//alert(validatorResponse);
			if (criteriaValidatorResponse==false){
				//ERROR. NO HAGA NADA HASTA CORREGIR LOS CAMPOS.
				alert('Por favor llene los campos que están en blanco.');
			}else{
				//EXITO. CONTINUAR.	
				var numeroCriterio = $('#tablaCriterios tr').length;
				var nombreCriterio = $("#nombreCriterio").val();
				var abreviaturaCriterio = $("#abreviaturaCriterio").val();
				var descriptorCriterio = $("#descriptorCriterio").val();

				$("#tablaCriterios tbody").append("<tr><td>"+numeroCriterio+"</td><td>"+nombreCriterio+" ["+abreviaturaCriterio+"]</td><td>"+descriptorCriterio+"</td></tr>");
				
				//Modificar tabla de descripciones
				var fila = "<tr><td>"+nombreCriterio+" ["+abreviaturaCriterio+"]</td>";
				//Iterar con respecto al número de columnas en la tabla de descripciones:
					$("#tablaDescripciones thead th").each(function(index){
						//Añadir fila a la tabla de descripciones de acuerdo con el número actual de columnas:
						if (index>0){
							fila = fila + "<td></td>";
						}                    
					});
				fila = fila + "</tr>";
				$("#tablaDescripciones tbody").append(fila);

				//Añadir al listado de criterios a seleccionar para escribir una descripción
				$("#seleccionCriterio").append("<option>"+nombreCriterio+" ["+abreviaturaCriterio+"]"+"</option>");
				
				$("#confirmarNuevoCriterio").attr("disabled", false);

				//NO HACE NADA
				//$("#nombreCriterio").text("");
				//$("#abreviaturaCriterio").text("");
            }
        });
		
		*/


/*
        $("#confirmarNuevoRango").click(function(){
			$('#addRangeForm').bootstrapValidator('validate');
			if (rangeValidatorResponse==false){
				//ERROR. NO HAGA NADA HASTA CORREGIR LOS CAMPOS.
				alert('Por favor asegúrese que ningún campo quede en blanco y que cumplan con las especificaciones dadas.');
			}else{
				if ($("#puntajeMaximo").val()<obtenerLimiteInferiorPuntajeMaximo()){
					alert('Por favor asigne un puntaje máximo mayor o igual a '+obtenerLimiteInferiorPuntajeMaximo());
					$("#puntajeMinimo").text(" "+obtenerPuntajeMinimo());
					$("#puntajeMaximo").val(obtenerLimiteInferiorPuntajeMaximo());
					$("#puntajeMaximo").attr('min',obtenerLimiteInferiorPuntajeMaximo());
				}else{			
					//EXITO. CONTINUAR.
					
					var nombreRango = $("#nombreRango").val();
					var puntajeMinimoRango = obtenerPuntajeMinimo();
					//Caso particular: Puntaje máximo de 4.9 -> Aproximar a 5
					if ($("#puntajeMaximo").val()==4.9){
					
						$("#tablaRangos tbody").append("<tr><td>"+nombreRango+"</td><td>["+puntajeMinimoRango+" - 5]</td></tr>");
						$("#puntajeMinimo").text(" "+puntajeMinimoRango);						
						
						//Modificar tabla de descripciones
						//Añadir columna a la tabla de descripciones de acuerdo con el número actual de filas:
						$("#tablaDescripciones thead tr").append("<th>"+nombreRango+" ["+puntajeMinimoRango+" - 5]</th>");

							//Iterar con respecto al número de filas en la tabla de descripciones:
							$("#tablaDescripciones tbody tr").each(function(i){
								//alert(i);                   
								var datoCriterio = $(this).find("td:first-child").text();
								//alert(datoCriterio);
								var fila = "<td>"+datoCriterio+"</td>";
								//alert(fila);
								//Iterar con respecto al número de columnas en la tabla de descripciones:
									$("#tablaDescripciones thead th").each(function(j){
										//alert(j);
										//Añadir fila a la tabla de descripciones de acuerdo con el número actual de columnas:
										if (j>0){
											fila = fila + "<td></td>";
											//alert(fila);
										}                    
									});
								//fila = fila + "</tr>";
								//alert(fila);
								//alert($(this).html());
								$(this).html(fila);
								//alert($(this).html());                  
													
							});

						//Añadir al listado de rangos a seleccionar para escribir una descripción
						$("#seleccionRango").append("<option>"+nombreRango+" ["+puntajeMinimoRango+" - 5]"+"</option>");
						
						$("#puntajeMinimo").text(" "+obtenerPuntajeMinimo());
						$("#puntajeMaximo").val(obtenerLimiteInferiorPuntajeMaximo());
						$("#puntajeMaximo").attr('min',obtenerLimiteInferiorPuntajeMaximo());
						
					}else{		
						
						var puntajeMaximoRango = $("#puntajeMaximo").val();

						$("#tablaRangos tbody").append("<tr><td>"+nombreRango+"</td><td>["+puntajeMinimoRango+" - "+puntajeMaximoRango+"]</td></tr>");
						$("#puntajeMinimo").text(" "+puntajeMinimoRango);

						//Modificar tabla de descripciones
						//Añadir columna a la tabla de descripciones de acuerdo con el número actual de filas:
						$("#tablaDescripciones thead tr").append("<th>"+nombreRango+" ["+puntajeMinimoRango+" - "+puntajeMaximoRango+"]</th>");

							//Iterar con respecto al número de filas en la tabla de descripciones:
							$("#tablaDescripciones tbody tr").each(function(i){
								//alert(i);                   
								var datoCriterio = $(this).find("td:first-child").text();
								//alert(datoCriterio);
								var fila = "<td>"+datoCriterio+"</td>";
								//alert(fila);
								//Iterar con respecto al número de columnas en la tabla de descripciones:
									$("#tablaDescripciones thead th").each(function(j){
										//alert(j);
										//Añadir fila a la tabla de descripciones de acuerdo con el número actual de columnas:
										if (j>0){
											fila = fila + "<td></td>";
											//alert(fila);
										}                    
									});
								//fila = fila + "</tr>";
								//alert(fila);
								//alert($(this).html());
								$(this).html(fila);
								//alert($(this).html());                  
													
							});

						//Añadir al listado de rangos a seleccionar para escribir una descripción
						$("#seleccionRango").append("<option>"+nombreRango+" ["+puntajeMinimoRango+" - "+puntajeMaximoRango+"]"+"</option>");

						//NO HACE NADA
						//$("#nombreRango").text("");
						//$("#puntajeMaximo").text("");
						$("#puntajeMinimo").text(" "+obtenerPuntajeMinimo());
						$("#puntajeMaximo").val(obtenerLimiteInferiorPuntajeMaximo());
						$("#puntajeMaximo").attr('min',obtenerLimiteInferiorPuntajeMaximo());
						
					}					

				}
			}
        });
		
		*/

/*


        $("#confirmarNuevaDescripcion").click(function(){
            var numCriterio = $("#seleccionCriterio option:selected").index();
            //alert(numCriterio);
            var numRango = $("#seleccionRango option:selected").index();
            //alert(numRango + 1);
            //var celda = $("#tablaDescripciones tbody tr:nth-child("+numCriterio+") td:nth-child("+numRango+")");
            $("#tablaDescripciones tbody tr").each(function(i){
                //alert(i);
                if ( i == numCriterio ){
                    //alert("OK");
                    $(this).find("td").each(function(j){
                        //alert(j);
                        if ( j == numRango + 1){
                            // alert("OK2");
                            // alert($("textarea#descripcion").val());
                            // alert($(this).text());
                            $(this).text($("textarea#descripcion").val());
                            //alert($(this).text());
                        }

                    });
                }

            });
            //alert(celda);
            //celda.text($("textarea#descripcion").text());
            //alert(celda);

        });
		
		*/






    });

    </script>


    </body>

</html>

