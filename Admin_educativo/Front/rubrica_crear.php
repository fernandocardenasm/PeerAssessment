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
                                    <a class="active" href="rubrica_crear.php">Crear</a>
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

                    <h1 class="page-header">Creaci&oacute;n de r&uacute;bricas</h1>

                    <div class="panel-body"><!--Main Panel-->

                        <div class="row" id="panelEdicionCriteriosRangos">

                            <div class="col-sm-12">

                                <div class="row">

                                    <a data-toggle="modal" id="botonNuevoCriterio" href="#nuevoCriterio" class="btn btn-default btn-large">
                                        Nuevo criterio
                                    </a>
                                    <a data-toggle="modal" id="botonNuevoRango" href="#nuevoRango" class="btn btn-default btn-large">
                                        Nuevo rango
                                    </a>
                                    <button type="button" id="botonContinuar" class="btn btn-primary">Continuar</button>

                                    <!--Modal:Nuevo criterio-->
                                    <div id="nuevoCriterio" class="modal fade">
                                       <div class="modal-dialog">   
                                          <div class="modal-content"> 
										  <form id="addCriteriaForm">
                                             <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                ×
                                                </button>
                                                <h3>Nuevo criterio</h3>
                                             </div>
                                             <div class="modal-body">

                                                <div class="form-group">
                                                    <label>Ingrese el nombre del nuevo criterio:</label>
                                                    <input id="nombreCriterio" class="form-control" placeholder="Ingrese el nombre" name="nombreCriterio">
                                                    <!--<h4>Ingrese el nombre del nuevo criterio:</h4><p>Mas texto en la ventana.</p>-->
                                                </div>

                                                <div class="form-group">
                                                    <label>Ingrese la abreviatura del nuevo criterio:</label>
                                                    <input id="abreviaturaCriterio" class="form-control" placeholder="Ingrese la abreviatura" name="abreviaturaCriterio">
                                                    <p class="help-block">Por ejemplo: C para Compromiso.</p>    
                                                </div>
												
												<div class="form-group">
                                                    <label for="descriptorCriterio">Ingrese el descriptor del nuevo criterio:</label>
                                                    <textarea class="form-control" rows="5" placeholder="Ingrese el descriptor" id="descriptorCriterio" name="descriptorCriterio" style="resize:none"></textarea>
                                                </div>

                                             </div>
                                             <div class="modal-footer">
                                                <button type='button' switch='editarCriterio' id="confirmarNuevoCriterio" class="btn btn-success">Generar</button>
                                                <a href="#" data-dismiss="modal" class="btn">Cerrar</a>
                                             </div>
											</form>
                                        </div>
                                       </div>
                                    </div>
                                    <!--Fin Modal:Nuevo criterio-->
                                    <!--Modal:Nuevo rango-->
                                    <div id="nuevoRango" class="modal fade">
                                        <div class="modal-dialog">   
                                            <div class="modal-content">
                                                <form role="form" id="addRangeForm">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                        ×
                                                        </button>
                                                        <h3>Nuevo rango</h3>
                                                    </div>
                                                    <div class="modal-body">                                                

                                                        <div class="form-group">
                                                            <label>Ingrese el nombre del nuevo rango:</label>                                                
                                                            <input id="nombreRango" class="form-control" placeholder="Ingrese el nombre" name="nombreRango">
                                                            <p class="help-block">Por ejemplo: Excelente</p>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Ingrese el puntaje máximo para este rango de valoración:</label>                                                                                                                 
                                                            <input type="number" min="0" max="5" step="0.1" id="puntajeMaximo" class="form-control" placeholder="Ingrese el puntaje máximo" name="puntajeMaximo" data-bv-greaterthan="true" data-bv-lessthan="true">
                                                            <h6 class="help-block">Puntaje mínimo asignado para este rango de valoración:<span id="puntajeMinimo"></span></h6>
                                                            <p class="help-block">Tenga en cuenta emplear una escala de valoración entre 0 y 5 para la rúbrica.</p>                                                      
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type='button' switch='editarRango' id="confirmarNuevoRango" class="btn btn-success">Generar</button>
                                                        <a href="#" data-dismiss="modal" class="btn">Cerrar</a>
                                                    </div>
													
												</form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Fin Modal:Nuevo rango-->

                                </div>

                                <div class="row">

                                    <div class="col-sm-6">

                                        <h2 class="sub-header">Criterios</h2>

                                        <div class="table-responsive">

                                            <table id="tablaCriterios" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                      <th>No.</th>
                                                      <th>Nombre</th>
													  <th>Descriptor</th>
                                                    </tr>
                                                </thead>
                                                <tbody>                                                   
                                                </tbody>
                                            </table>

                                        </div><!--Fin de tabla de criterios-->

                                    </div><!--Fin de division 6-->
                                    <div class="col-sm-6">

                                    <h2 class="sub-header">Rangos</h2>

                                        <div class="table-responsive">

                                            <table id="tablaRangos" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                      <th>Nombre</th>
                                                      <th>Rango</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div><!--Fin de tabla de rangos-->


                                    </div>

                                </div>


                            </div><!-- /.col-sm-12 -->


                        </div>


                        <div class="row" id="panelEdicionDescripciones"><!-- El segundo paso para crear la rúbrica comienza aquí -->

                            <div class="col-sm-12">

                                <div class="row">

                                    <button type="button" id="botonAtras" class="btn btn-danger">Atrás</button>
                                    <a data-toggle="modal" href="#editarDescripciones" class="btn btn-default btn-large">
                                        Editar descripción
                                    </a>
                                    <a id="botonConfirmacionFinal" data-toggle="modal" href="#confirmar" class="btn btn-primary btn-large">
                                        Continuar
                                    </a>

                                    <!--Modal:Editar descripciones-->
                                    <div id="editarDescripciones" class="modal fade">
                                       <div class="modal-dialog">   
                                          <div class="modal-content"> 
                                             <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                ×
                                                </button>
                                                <h3>Editar descripciones</h3>
                                             </div>
                                             <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="seleccionCriterio">Seleccione un criterio:</label>
                                                    <select class="form-control" id="seleccionCriterio" name="seleccionCriterio">                                                        
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="seleccionRango">Seleccione un rango de valoración:</label>
                                                    <select class="form-control" id="seleccionRango" name="seleccionRango">                                                        
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="descripcion">Escriba la descripción asociada al criterio y al rango seleccionados:</label>
                                                    <textarea class="form-control" rows="5" placeholder="Ingrese la descripción" id="descripcion" name="descripcion" style="resize:none"></textarea>
                                                </div>

                                             </div>
                                             <div class="modal-footer">
                                                <a id="confirmarNuevaDescripcion" href="#" class="btn btn-success">Guardar y continuar</a>
                                                <a href="#" data-dismiss="modal" class="btn">Cerrar</a>
                                             </div>
                                        </div>
                                       </div>
                                    </div>
                                    <!--Fin Modal:Editar descripciones-->
                                    <!--Modal:Terminar-->
                                    <div id="confirmar" class="modal fade">
                                       <div class="modal-dialog">   
                                          <div class="modal-content">
										  <form id="addRubricForm">
                                             <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                ×
                                                </button>
                                                <h3>Confirmar creación de rúbrica</h3>
                                             </div>
                                             <div class="modal-body">
											 
												<div class="form-group">
													<label>Ingrese el nombre de esta rúbrica:</label>                                                
													<input id="nombreRubrica" class="form-control" placeholder="Ingrese el nombre de la rúbrica" name="nombreRubrica">
												</div>

                                                <div class="form-group">
                                                    <label for="seleccionSemestre">¿Desea asignar esta rúbrica a un semestre ahora?</label>
                                                    <select class="form-control" id="seleccionSemestre" name="seleccionSemestre">
                                                        <option>No asignar</option>                                                        
                                                    </select>
                                                    <p class="help-block">Si lo prefiere, puede hacer esto más tarde.</p>
                                                    
                                                </div>

                                             </div>
                                             <div class="modal-footer">
                                                <button type='button' switch='editarRubrica' id="botonTerminar" class="btn btn-success">Terminar</button>
                                                <a href="#" data-dismiss="modal" class="btn">Cancelar</a>
                                             </div>
										 </form>
                                        </div>
                                       </div>
                                    </div>
                                    <!--Fin Modal:Terminar-->                        

                                </div>

                                <div class="row">

                                    <div class="col-sm-12">

                                        <h2 class="sub-header">Descripciones</h2>

                                        <div class="table-responsive">

                                            <table id="tablaDescripciones" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                      <th>Criterio</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>

                                        </div><!--Fin de tabla de descripciones-->

                                    </div><!--Fin de division 12-->


                                </div>


                            </div><!-- /.col-sm-12 -->


                        </div><!-- El segundo paso para crear la rúbrica termina aquí -->


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

        // $("#click_crear_nuevo_curso").click(function(){
        //     $("#subform1").append('<label>');
        // });
		
		var criteriaValidatorResponse = false;
		var rangeValidatorResponse = false;
		var rubricValidatorResponse = false;
		
		$('#addCriteriaForm').bootstrapValidator({
			// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			submitButtons: 'button[switch="editarCriterio"]',
			live: 'enabled',
			fields: {
				nombreCriterio:{
					validators: {
						notEmpty: {
							message: 'Este campo no puede quedar vacío.'
						}
					}
				},
				abreviaturaCriterio:{
					validators: {
						notEmpty: {
							message: 'Este campo no puede quedar vacío.'
						}
					}
				},
				descriptorCriterio:{
					validators: {
						notEmpty: {
							message: 'Este campo no puede quedar vacío.'
						}
					}
				}
			}
		}).on('error.form.bv', function(e) {
			setCriteriaValidationResponse(false);

		}).on('success.form.bv', function(e) {
			// Prevent form submission
			e.preventDefault();
			setCriteriaValidationResponse(true);
		});
		
		$('#addRangeForm').bootstrapValidator({
			// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			submitButtons: 'button[switch="editarRango"]',
			live: 'enabled',
			fields: {
				nombreRango:{
					validators: {
						notEmpty: {
							message: 'Este campo no puede quedar vacío.'
						}
					}
				},
				puntajeMaximo:{
					validators: {
						notEmpty: {
							message: 'Este campo no puede quedar vacío.'
						},
						regexp: {
							regexp: /^[0-9]+(\.[0-9])?$/,
							message: 'El puntaje máximo no puede ser negativo y debe ser expresado en máximo 1 decimal.'
						}
					}
				}
			}
		}).on('error.form.bv', function(e) {
			setRangeValidationResponse(false);

		}).on('success.form.bv', function(e) {
			// Prevent form submission
			e.preventDefault();
			setRangeValidationResponse(true);
		});

		$('#addRubricForm').bootstrapValidator({
			// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			submitButtons: 'button[switch="editarRubrica"]',
			live: 'enabled',
			fields: {
				nombreRubrica:{
					validators: {
						notEmpty: {
							message: 'Este campo no puede quedar vacío.'
						}
					}
				}
			}
		}).on('error.form.bv', function(e) {
			setRubricValidationResponse(false);
		}).on('success.form.bv', function(e) {
			// Prevent form submission
			e.preventDefault();
			setRubricValidationResponse(true);
		});
		
		function setCriteriaValidationResponse(response){
			criteriaValidatorResponse = response;
		}
		
		function setRangeValidationResponse(response){
			rangeValidatorResponse = response;
		}
		
		function setRubricValidationResponse(response){
			rubricValidatorResponse = response;
		}
		
        generar_lista_semestres();

        $("#panelEdicionDescripciones").hide();

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

        function obtenerPuntajeMinimo(){
            //Validar los valores de la tabla de rangos.
            if ($('#tablaRangos tr').length == 1){
                //No hay nada. Asúmase puntaje mínimo inicial de 0.
                return 0;
            }else{
                //Hay valores en la tabla. Buscar el puntaje máximo del último elemento de la tabla 
                var puntajeMinimo = $('#tablaRangos tbody tr:last-child td:last-child').text();
                //Indice del substring a hacer para extraer el puntaje mínimo
                var puntajeMinimo = puntajeMinimo.slice(puntajeMinimo.indexOf('-')+2,puntajeMinimo.indexOf(']'));
                //Sumar 0.1 para obtener el puntaje mínimo del siguiente componente o rango
                var resultado = (parseFloat(puntajeMinimo)+ 0.1).toFixed(1);
                return resultado;
            }

        };
		
		function obtenerLimiteInferiorPuntajeMaximo(){
            //Validar los valores de la tabla de rangos.
            if ($('#tablaRangos tr').length == 1){
                //No hay nada. Asúmase puntaje mínimo inicial de 0.1
                return 0.1;
            }else{
                //Hay valores en la tabla. Buscar el puntaje máximo del último elemento de la tabla 
                var puntajeMinimo = $('#tablaRangos tbody tr:last-child td:last-child').text();
                //Indice del substring a hacer para extraer el puntaje mínimo
                var puntajeMinimo = puntajeMinimo.slice(puntajeMinimo.indexOf('-')+2,puntajeMinimo.indexOf(']'));
                //Sumar 0.2 para obtener el puntaje mínimo del siguiente componente o rango
                var resultado = (parseFloat(puntajeMinimo)+ 0.2).toFixed(1);
                return resultado;
            }

        };

        $("#botonNuevoRango").click(function(){
            $("#puntajeMinimo").text(" "+obtenerPuntajeMinimo());
			$("#puntajeMaximo").val(obtenerLimiteInferiorPuntajeMaximo());
			$("#puntajeMaximo").attr('min',obtenerLimiteInferiorPuntajeMaximo());
        });

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

        $("#botonContinuar").click(function(){
			//Sólo habilitar cuando exista al menos un criterio (2 filas o más en la tabla) y la nota máxima dada por los rangos es de 5.
			if ($('#tablaCriterios tr').length > 1){
				if (obtenerLimiteInferiorPuntajeMaximo()>=5){
					$("#panelEdicionCriteriosRangos").hide();
					$("#panelEdicionDescripciones").show();
				}else{
					alert('Por favor asegúrese que la nota máxima de los rangos alcance el 5.0');
				} 
            }else{
				alert('Por favor asegúrese de agregar al menos un criterio');
			}		           
        });

        $("#botonAtras").click(function(){
            $("#panelEdicionDescripciones").hide();
            $("#panelEdicionCriteriosRangos").show();
        });

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

        $("#botonTerminar").click(function(){
			$('#addRubricForm').bootstrapValidator('validate');
			if (rubricValidatorResponse==false){
				alert('Por favor escriba el nombre de esta rúbrica.');
			}else{
				crearRubrica();
			}
        });

        //Se encarga de generar el listado de semestres para añadirse a la página
        function generar_lista_semestres(){

            $.ajax({
                type:"POST",
                data:{},
                url:"../Back/generar_lista_semestres.php",
                dataType:'json',
                success: function(response){
                    if(response.exito=='exito'){
                        //alert("SUCCESS");
                        var i;                        
                        for (i=0;i<response.n;i++){
                            $("#seleccionSemestre").append("<option>"+response[i][0]+" - "+response[i][1]+"</option>");
                        }                        
                    }
                    else{
                        alert("FAIL");
                    }                    
                },
                error: function(i,j){
                    alert("EPIC FAIL: "+j);
                }

            });

        }

        function crearRubrica(){

            //Generate JSON
            var rubrica = new Object();

            var criterios = new Array();
            var rangos = new Array();
            var descripciones = new Array();

            var numCriterios = $('#tablaCriterios tr').length;
            var numRangos = $('#tablaRangos tr').length;

            $("#tablaCriterios tbody tr").each(function(i){//OK
                var numeroCriterio;
                var nombreCriterio;
                var abreviaturaCriterio;
				var descriptorCriterio;
                $(this).find("td").each(function(j){
                    if (j==0){
                        numeroCriterio = $(this).text();
                    }else if(j==1){
                        var info = $(this).text();
                        //alert(info);
                        nombreCriterio = info.substring(0,info.indexOf('[')-1);
                        //alert(nombreCriterio);
                        abreviaturaCriterio = info.slice(info.indexOf('[')+1,info.indexOf(']'));
                        //alert(abreviaturaCriterio);
                    }else{
						descriptorCriterio = $(this).text();
					}              
                });
                var criterio = new Object();
                criterio.numero = numeroCriterio;
                criterio.nombre = nombreCriterio;
                criterio.abreviatura = abreviaturaCriterio;
				criterio.descriptor = descriptorCriterio;
                //alert(criterio.numero);
                //alert(criterio.nombre);
                //alert(criterio.abreviatura);
                criterios.push(criterio);          
            });

            $("#tablaRangos tbody tr").each(function(i){
                var nombreRango;
                var minimo;
                var maximo;
                $(this).find("td").each(function(j){
                    if (j==0){
                        nombreRango = $(this).text();
                    }else{
                        var info = $(this).text();
                        //alert(info);
                        minimo = info.slice(info.indexOf('[')+1,info.indexOf('-')-1);
                        //alert(minimo);
                        maximo = info.slice(info.indexOf('-')+2,info.indexOf(']'));
                        //alert(maximo);
                    }                    
                });
                var rango = new Object();
                rango.nombre = nombreRango;
                rango.puntajeMinimo = minimo;
                rango.puntajeMaximo = maximo;
                //alert(rango.nombre);
                //alert(rango.puntajeMinimo);
                //alert(rango.puntajeMaximo);
                rangos.push(rango);
            });

            $("#tablaDescripciones tbody tr").each(function(i){
                $(this).find("td").each(function(j){
                    if (j>0){
                        //alert($(this).text());
                        var descripcion = new Object();                        
                        descripcion.nombre = $(this).text();
                        descripciones.push(descripcion);
                    }                 
                });                
            });
			
			var semestre = '';
			var periodo = '';
			var anho = '';
			
			if ($('#seleccionSemestre').val()=='No asignar'){
				semestre = 'null';
			}else{
				semestre = $('#seleccionSemestre').val();
				periodo = semestre.substring(semestre.indexOf('-')+2,semestre.length);
				anho = semestre.substring(0,semestre.indexOf('-')-1);
			}
			
			var nombre = $('#nombreRubrica').val();

            rubrica.criterios = criterios;
            rubrica.rangos = rangos;
            rubrica.descripciones = descripciones;
			rubrica.semestre = semestre;
			rubrica.periodo = periodo;
			rubrica.anho = anho;
			rubrica.nombre = nombre;
            //alert(JSON.stringify(rubrica));
			
            $.ajax({
                type:"POST",
                url:"../Back/crear_rubrica.php",                
                data: {datos: JSON.stringify(rubrica)},
                dataType: "JSON",
                success: function(response){
                    if(response.exito=='exito'){
                        alert('Se ha agregado la rúbrica '+response.nombre+' a la base de datos de manera exitosa.');
						if (response.semestre=='null'){
							alert("No se ha agregado la rúbrica a ningún semestre.");
						}else{
							alert('Se ha agregado la rúbrica al semestre '+response.semestre);
						}						
						//Recargar página.
						location.reload();			
						
                        //alert(response.rubrica);
                        //alert(JSON.stringify(response.criterios[0].nombre));
                        //alert(JSON.stringify(response.criterios[1].nombre));
                        //alert(JSON.stringify(response.criterios[2].nombre));
                        //alert(JSON.stringify(response.criterios[3].nombre));
                        //alert(JSON.stringify(response.criterios));
                        //alert(JSON.stringify(response.rangos));
                        //alert(JSON.stringify(response.descripciones));
                    }else if(response.exito=='fail'){
                        alert("La consulta no se pudo realizar");
                    }else{
                        alert("FAIL");
                        alert(response);
                    }                    
                },
                error: function(i,j,k){
                    alert("EPIC FAIL: "+i+" "+j+" "+k);
                }

            });
	
        }


    });

    </script>


    </body>

</html>

