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
    
    <link href="https://rawgithub.com/hayageek/jquery-upload-file/master/css/uploadfile.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="../../sb-admin-2/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../sb-admin-2/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../sb-admin-2/css/sb-admin-2.css" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link href="../../sb-admin-2/css/plugins/dataTables.bootstrap.css" rel="stylesheet">
	
	<!-- DataTables:TableTools Plugin CSS -->
	<link href="../../sb-admin-2/css/plugins/dataTables.tableTools.css" rel="stylesheet">
	
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
		tr.selected td{
			background-color: #b0bed9 !important;
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
                        <li>
                            <a href="inicio_admin_edu.php"><i class="glyphicon glyphicon-home fa-fw"></i> Inicio</a>
                        </li>
                        <li>
                            <a class="active" href="#"><i class="glyphicon glyphicon-list-alt fa-fw"></i> Rúbricas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li>
                                    <a class="active" href="rubricas.php">Revisar</a>
                                </li>
                                <li>
                                    <a href="rubrica_crear.php">Crear</a>
                                </li>
                                <!--
                                <li>
                                    <a href="morris.html">Morris.js Charts</a>
                                </li>
                                -->
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
                    <h1 class="page-header">Rúbricas</h1>
					<div class="panel-body">
						<a id="botonCrear" href="rubrica_crear.php" class="btn btn-primary btn-large">
							Nuevo
						</a>						
						<button id="botonBorrar" class="btn btn-primary btn-large">
							Borrar
						</button>
						<button id="botonAgregar" class="btn btn-primary btn-large">
							Agregar a semestre
						</button>
						<!--
						<button type='submit' id="botonVer" class="btn btn-primary btn-large">
							Ver detalles
						</button>
						-->
						<!--Modal:Borrar Rúbrica-->
							<div id="borrarRubrica" class="modal fade">
							   <div class="modal-dialog">   
								  <div class="modal-content"> 
									 <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										×
										</button>
										<h3>Borrar Rúbrica</h3>
										<p>¿Está seguro que quiere borrar de la base de datos a esta rúbrica? Si la acción resulta ser exitosa, no se podrá deshacer.</p>
									 </div>
									 <div class="modal-footer">
										<a href="#" data-dismiss="modal" id="confirmarBorrarRubrica" class="btn btn-success">Borrar</a>
										<a href="#" data-dismiss="modal" class="btn">Cerrar</a>
									 </div>
								</div>
							   </div>
							</div>
						<!--Fin Modal:Borrar Rúbrica-->
						<!--Modal:Agregar Rúbrica a Semestre-->
							<div id="agregarRubrica" class="modal fade">
							   <div class="modal-dialog">   
								  <div class="modal-content">				
									 <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										×
										</button>
										<h3>Agregar rúbrica a semestre</h3>
									 </div>
									 <div class="modal-body">

										<div class="form-group">
											<label for="seleccionSemestre">Asignar a semestre:</label>
											<select class="form-control" id="seleccionSemestre" name="seleccionSemestre">                                                    
											</select>											
										</div>

									 </div>
									 <div class="modal-footer">
										<button type='button' id="confirmarAgregarSemestre" class="btn btn-success">Asignar</button>
										<a href="#" data-dismiss="modal" class="btn">Cancelar</a>
									 </div>								
								</div>
							   </div>
							</div>
							<!--Fin Modal:Agregar Rúbrica a Semestre-->   
									
						
					</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
										<th>Nombre</th>
										<th>Usado en un semestre</th>
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

    <!-- bootstrapValidator JavaScript -->
    <script src="../../bootstrapValidator/js/bootstrapValidator.js"></script>

    <!-- bootstrapValidator Validation Script: Check out validation rules here -->
    <script src="../../bootstrapValidator/js/formValidation.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../sb-admin-2/js/plugins/metisMenu/metisMenu.min.js"></script>
    
    <!-- DataTables JavaScript -->
    <script src="../../sb-admin-2/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="../../sb-admin-2/js/plugins/dataTables/dataTables.bootstrap.js"></script>
	
	<!-- DataTables:TableTools Plugin JavaScript -->
	<script src="../../sb-admin-2/js/plugins/dataTables/dataTables.tableTools.js"></script>
	
    <!-- Custom Theme JavaScript -->
    <script src="../../sb-admin-2/js/sb-admin-2.js"></script>
    
    <script src="https://rawgithub.com/hayageek/jquery-upload-file/master/js/jquery.uploadfile.min.js"></script>
    
    <script type="text/javascript">
	
	$(document).ready(function(){
	
		//$("#confirmarNuevoEstudiante").attr("disabled", true);
		
		var table = $('#dataTables-example').dataTable();
		cargar_informacion(table);
				
		$('#dataTables-example tbody').on( 'click', 'tr', function (){
			if ($(this).hasClass('selected')){
				$(this).removeClass('selected');
			}
			else {
				table.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
			}
		});
		
		$("#botonBorrar").click(function(){
			if (verificarSeleccion(table)==true){
				$('#borrarRubrica').modal('show');				
			}else{
				alert('No ha seleccionado una rúbrica para borrar su información');
			}	
		});
		
		$("#confirmarBorrarRubrica").click(function(){
			borrar(table);
		});
		
		$("#botonAgregar").click(function(){
			if (verificarSeleccion(table)==true){
				cargarSeleccion(table);				
			}else{
				alert('No ha seleccionado una rúbrica para ser agregada a un semestre');
			}
		});
		
		$("#confirmarAgregarSemestre").click(function(){
			agregar(table);
			generar_lista_semestres();
		});
		
		/*
		$("#botonVer").click(function(){
			if (verificarSeleccion(table)==true){
				//Ejecutar AJAX -> rubrica_detalle.php
				leer(table);
			}else{
				alert('No ha seleccionado una rúbrica para verse en detalle');
			}
		});
		*/
		
	});
	
	
	function cargar_informacion(table){
	
		$.ajax({
			type:"POST",
			data:{},
			url:"../Back/cargar_informacion_rubricas.php",
			dataType:'JSON',
			success: function(h){
			
				if(h.exito=="exito"){
					var i;
					table.fnClearTable();
					for(i=0;i<h.n;i++){
						table.fnAddData([h[i][0],h[i][1],h[i][2]]);
					}
				}
				else if(h.exito=='listavacia'){
					alert("No hay rúbricas estándar en la base de datos.");
				}
				else{
					alert("Tenemos problemas con nuestro servicio. Inténtelo más tarde por favor.");
				}
				
			},
			error: function(i,j,k){
				alert("Error en la transacción. Inténtelo más tarde por favor.");
			}
		});	
		
		
	}
	
	function verificarSeleccion(table){
		if (table.$('tr.selected').length==0){
			return false;
		}else{
			return true;
		}
	}
	
	function cargarSeleccion(table){
		//AJAX: Revisar semestres sin rúbrica
		generar_lista_semestres();
	}
	
	function generar_lista_semestres(){

		$.ajax({
			type:"POST",
			data:{},
			url:"../Back/generar_lista_semestres.php",
			dataType:'json',
			success: function(response){
				if(response.exito=='exito'){					
					var i;    
					$("#seleccionSemestre").find('option').remove();                 
					for (i=0;i<response.n;i++){						
						$("#seleccionSemestre").append("<option>"+response[i][0]+" - "+response[i][1]+"</option>");
					}					
					if ($("#seleccionSemestre").find('option').length==0){
						//$("#confirmarAgregarSemestre").attr('disabled',true);
						alert('No existen más semestres que requieran una rúbrica.');
					}else{
						$('#agregarRubrica').modal('show');
						//$("#confirmarAgregarSemestre").attr('disabled',false);
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
	
	function agregar(table){
	
		//Generate JSON
		var rubrica = new Object();
		
		var id = table.$('tr.selected').find('td:nth-child(1)').text();
		var semestre = $('#seleccionSemestre').val();
		var periodo = semestre.substring(semestre.indexOf('-')+2,semestre.length);
		var anho = semestre.substring(0,semestre.indexOf('-')-1);

		rubrica.id = id;
		rubrica.semestre = semestre;
		rubrica.periodo = periodo;
		rubrica.anho = anho;
		
		$.ajax({
			type:"POST",
			url:"../Back/asignar_rubrica_semestre.php",                
			data: {datos: JSON.stringify(rubrica)},
			dataType: "JSON",
			success: function(response){				
				if(response.exito=='exito'){
					table.$('tr.selected').removeClass('selected');
					cargar_informacion(table);
					alert('Se ha agregado la rúbrica seleccionada a la base de datos de manera exitosa.');
					if (response.semestre=='null'){
						alert("No se ha agregado la rúbrica a ningún semestre.");
					}else{
						alert('Se ha agregado la rúbrica al semestre '+response.semestre);
					}
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
	
	/*
	function leer(table){
	
		//Generate JSON
		var info = new Object();
		info.id = table.$('tr.selected').find('td:first-child').text();
		info.nombre = table.$('tr.selected').find('td:nth-child(2)').text();
		//alert(JSON.stringify(info));	

		$.ajax({
			type:"POST",
			url:"rubrica_detalle.php",
			data: {datos: JSON.stringify(info)},
			success: function(response){
				window.location="rubrica_detalle.php";
				
				if(response.exito=='exito'){
				table.$('tr.selected').removeClass('selected');
				cargar_informacion(table);
				alert('Se ha borrado la rúbrica '+response.nombre+' de la base de datos de manera exitosa.');
				}else if(response.exito=='fracaso'){
					alert('La consulta no se pudo realizar:\n'+response.mysql);
				}else{						
					alert("Hubo un problema con la transacción. Inténtelo más tarde por favor.");
					//alert(response);
				} 
				
				               
			},
			error: function(i,j,k){
				//alert("EPIC FAIL: "+i+" "+j+" "+k);
				alert("Tenemos problemas con nuestro servicio. Inténtelo más tarde por favor.");
			}

		});

	
	}
	*/
	
	function borrar(table){
	
	//Generate JSON
		var info = new Object();
		info.id = table.$('tr.selected').find('td:first-child').text();
		info.nombre = table.$('tr.selected').find('td:nth-child(2)').text();
		//alert(JSON.stringify(info));
		
		$.ajax({
			type:"POST",
			url:"../Back/borrar_rubrica.php",
			data: {datos: JSON.stringify(info)},
			dataType: "JSON",
			success: function(response){
				if(response.exito=='exito'){
				table.$('tr.selected').removeClass('selected');
				cargar_informacion(table);
				alert('Se ha borrado la rúbrica '+response.nombre+' de la base de datos de manera exitosa.');
				}else if(response.exito=='fracaso'){
					alert('La consulta no se pudo realizar:\n'+response.mysql);
				}else{						
					alert("Hubo un problema con la transacción. Inténtelo más tarde por favor.");
					//alert(response);
				}                    
			},
			error: function(i,j,k){
				//alert("EPIC FAIL: "+i+" "+j+" "+k);
				alert("Tenemos problemas con nuestro servicio. Inténtelo más tarde por favor.");
			}

		});
		
		
	}

    
    
    </script>

</body>

</html>


