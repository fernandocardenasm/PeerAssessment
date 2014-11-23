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

    <!-- Bootstrap Core CSS -->
    <link href="../../sb-admin-2/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../sb-admin-2/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../sb-admin-2/css/sb-admin-2.css" rel="stylesheet">

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
                            <a  href="inicio_admin.php"><i class="glyphicon glyphicon-home fa-fw"></i> Inicio</a>
                        </li>
                        <li>
                            <a class="active" href="semestres_actuales.php"><i class="glyphicon glyphicon-list fa-fw"></i> Semestres</a>
                        </li>
                        <!--<li>
                            <a href="tables.html"><i class="fa fa-table fa-fw"></i> Por definir</a>
                        </li>
                        <li>
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
                    <h1 class="page-header">Semestres</h1>
                    
                        <div class="panel-body">
                            <div id="sub_form1">
                            </div>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Agregar Semestre</button>
                                
                                <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Agregar nuevo semestre</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="panel-body">
                                                <form role="form">
                                                    <div class="form-group">
                                                        <label>Periodo:</label>
                                                        <select name="periodo" class="form-control">
                                                            <option value="P">Primero</option>
															<option value="I1">Intersemestral I</option>
                                                            <option value="S">Segundo</option>                                                            
                                                            <option value="I2">Intersemestral II</option>
                                                         </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Anho</label>
                                                        <label class="form-control" id="anho"></label>
                                                    </div>
                                                    
                                                    
                                                </form>
                                                
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button id="click_crear_nuevo_semestre" type="button" class="btn btn-primary">Crear semestre</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
							
							<!--Modal:Eliminar Semestre-->
							<div id="cambiarEstadoSemestre" class="modal fade">
							   <div class="modal-dialog">   
								  <div class="modal-content">
								  <form id='estadoSemestreForm'>
									 <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										×
										</button>
										<h3>Cambiar estado del semestre</h3>
										<p>¿Desea <span id='textoMensaje'>activar</span> el semestre? Es necesario escribir una razón para ello.</p>
									 </div>
									 <div class="modal-body">
										<div class="form-group">
											<label for="razon">Escriba la razón del cambio:</label>
											<textarea class="form-control" rows="5" placeholder="Ingrese la razón aquí" id="razon" name="razon" style="resize:none"></textarea>
										</div>
									 </div>
									 <div class="modal-footer">
										<button type='button' switch='editarEstadoSemestre' id="confirmarCambiarEstadoSemestre" class="btn btn-success"><span id='textoBoton'>Activar</span></button>
										<a href="#" data-dismiss="modal" class="btn">Cerrar</a>
									 </div>
								 </form>
								</div>
							   </div>
							</div>
						<!--Fin Modal:Borrar Administrador Sistema-->
							
							<!--Modal:Eliminar Semestre-->
							<div id="eliminarSemestre" class="modal fade">
							   <div class="modal-dialog">   
								  <div class="modal-content"> 
									 <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										×
										</button>
										<h3>Borrar Semestre</h3>
										<p>¿Está seguro que quiere borrar este semestre de la base de datos? Si la acción resulta ser exitosa, no se podrá deshacer.</p>
									 </div>
									 <div class="modal-footer">
										<a href="#" data-dismiss="modal" id="confirmarEliminarSemestre" class="btn btn-success">Borrar</a>
										<a href="#" data-dismiss="modal" class="btn">Cerrar</a>
									 </div>
								</div>
							   </div>
							</div>
						<!--Fin Modal:Borrar Administrador Sistema-->

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
    
    $(document).ready(function(){
	
        cargar_semestres();
		
		//cargar semestres
	
		function cargar_semestres(){
		
			var fecha = new Date();
			var anho = fecha.getFullYear();
			$("#anho").text(anho);
		
			var SESSION = {
			 "user": "<?php echo $_SESSION["user"]; ?>"
			};
		
			var semestre = '';
			var periodo = '';
			var anio = '';
			
			$.ajax({
				type:"POST",
				data:{},
				url:"../Back/cargar_semestres.php",
				dataType:'json',
				success: function(h){
				if(h.exito=="exito"){
					$("#sub_form1").empty();
					$("#sub_form1").append(h.cadena);
					//alert($(".btn-warning").length);
					//alert($("#sub_form1").find('li').length);
					
					//var validatorResponse = false;
					
					//$("#confirmarCambiarEstadoSemestre").attr("disabled", true);
										
					$('#sub_form1').on( 'click', '.btn-warning', function (){
						semestre = $(this).parent().find('button').text();
						periodo = semestre.slice(semestre.indexOf(':')+2,semestre.indexOf('--'));
						if (periodo=='Primero'){
							periodo = 'P';
						}else if(periodo=='Intersemestral I'){
							periodo = 'I1';
						}else if(periodo=='Segundo'){
							periodo = 'S';
						}else if(periodo=='Intersemestral II'){
							periodo = 'I2';
						}
						anio = semestre.slice(semestre.indexOf('Año:')+5);
						//alert(periodo);
						//alert(anio);
						//Consultas de validación para cambiar estado de semestre
							//1. Saber en qué estado se encuentra
							revisarEstadoSemestre(periodo,anio);//OK
						
					});
					
					$("#confirmarCambiarEstadoSemestre").click(function(){
						if ($('#razon').val().trim().length==0){
							alert('Por favor escriba una razón.');
						}else{
							cambiarEstadoSemestre(SESSION,fecha,periodo,anio);
						}						
					});
					
					/*
					$('#sub_form1').on( 'click', '.btn-danger', function (){
						semestre = $(this).parent().find('button').text();
						periodo = semestre.slice(semestre.indexOf(':')+2,semestre.indexOf('--'));
						if (periodo=='Primero'){
							periodo = 'P';
						}else if(periodo=='Intersemestral I'){
							periodo = 'I1';
						}else if(periodo=='Segundo'){
							periodo = 'S';
						}else if(periodo=='Intersemestral II'){
							periodo = 'I2';
						}
						anio = semestre.slice(semestre.indexOf('Año:')+5);
						//alert(periodo);
						//alert(anio);					
						$('#eliminarSemestre').modal('show');
					});
					
					
					$("#confirmarEliminarSemestre").click(function(){
						eliminarSemestre(periodo,anio);
					});					
					*/
					
					$("button[tipo=link_semestre]").click(function(){
						var idsemestre=$(this).attr('idsemestre');
						$.ajax({
							type:"POST",
							data:{idsemestre:idsemestre},
							url:"../Back/saber_semestre_seleccionado.php",
							dataType:'json',
							success: function(h){
							if(h.exito=="exito"){
								window.location="semestre_crear_curso.php"
							}
							},
							error: function(i){
								alert("Todo mal");
							}
						});
						
					});
				}
				else if(h.exito=='vacio'){
					$("#sub_form1").empty();
					alert("No hay ningún semestre creado. Por favor cree uno.");
				}
				else{
					$("#sub_form1").empty();
					alert("Tenemos problemas con nuestro servicio. Inténtelo más tarde por favor.");
				}
				},
				error: function(i){
				}
			});
			
		}
		
        //Crear nuevo semestre
        
        $("#click_crear_nuevo_semestre").click(function(){
            
            $.ajax({
                type:"POST",
                data:{periodo:$("select[name=periodo]").val(),anho:anho},
                url:"../Back/crear_nuevo_semestre.php",
                dataType:'json',
                success: function(h){
                if(h.exito=="repetido"){
                    
                    alert("El semestre ya existe, no se pueden crear un mismo periodo en un mismo anho.");
                }
                else if(h.exito=='creado'){
                    
                    alert("El semestre fue creado con éxito.");
                    window.location.reload(true);
                }
                else{
                    
                    alert("Tenemos problemas con nuestro servicio. Inténtelo más tarde por favor.");
                }
                },
                error: function(i){
                    alert("Todo mal");
                }
            });
            
        });
       
        /*
        cargar_cursos_actuales();
        
        //En la ventada modal de agregar curso se pedirá si ya existe una columna con el número de equipo al que pertenece el estudiante7
        
        $("input[name=si_no_columna_equipos]").change(function () { 
            
            $("#no_equipos").empty();
            if($(this).val()=="No"){
                $("#no_equipos").append('<input type="number" name="quantity" min="1" max="200" step="1">');
            }
            
        });
        
        
        */
    });
	
	function revisarEstadoSemestre(periodo,anho){
	
		//Generate JSON
		var info = new Object();		
		info.periodo = periodo;
		info.anho = anho;
		//alert(JSON.stringify(info));
		
		$.ajax({
			type:"POST",
			url:"../Back/revisar_estado_semestre.php",
			data: {datos: JSON.stringify(info)},
			dataType: "JSON",
			success: function(response){
				if(response.exito=='exito'){
					//alert(response.periodo);
					//alert(response.anho);
					//var estado = response.estado;
					//var estado = 'hola';
					//alert(estado);
					//alert(estado.charAt(0).toUpperCase() + estado.slice(1));
					//Cambiar los mensajes de activar/desactivar dependiendo de estado obtenido
					//alert(response.rubrica);
					if (response.estado=='ON'){
						$('#cambiarEstadoSemestre').find('span#textoMensaje').text('desactivar');
						$('#cambiarEstadoSemestre').find('span#textoBoton').text('Desactivar');
						$('#cambiarEstadoSemestre').modal('show');
					}else{						
						if (response.rubrica==null){
							//No existe rúbrica para este semestre. Denegar el cambio de estado de semestre.
							alert('No se ha asignado rúbrica alguna para este semestre. Por lo tanto no se permite activar este semestre. Por favor contáctese con un administrador educativo y pídale que le asigne una rúbrica.');
						}else{
							//Existe rúbrica para este semestre. Permitir el cambio de estado de semestre.
							$('#cambiarEstadoSemestre').find('span#textoMensaje').text('activar');
							$('#cambiarEstadoSemestre').find('span#textoBoton').text('Activar');
							$('#cambiarEstadoSemestre').modal('show');
						}
					}
					
										
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
	
	function cambiarEstadoSemestre(SESSION,fecha,periodo,anho){
		
		//Generate JSON
		var info = new Object();
		info.admin = SESSION.user;
		info.fecha = fecha.getDate()+'/'+fecha.getMonth()+'/'+fecha.getFullYear();
		info.periodo = periodo;
		info.anho = anho;
		info.razon = $('#razon').val().trim();
		
		//NOTA: VALIDAR FECHA!!!
		
		if ($('#cambiarEstadoSemestre').find('span#textoBoton').text()=='Activar'){
			info.accion = 'activado';
		}else{  //$('#cambiarEstadoSemestre').find('span#textoBoton').text()=='Desactivar'
			info.accion = 'desactivado';
		}		
		
		//alert(JSON.stringify(info));
		
		$.ajax({
			type:"POST",
			url:"../Back/cambiar_estado_semestre.php",
			data: {datos: JSON.stringify(info)},
			dataType: "JSON",
			success: function(response){
				if(response.exito=='exito'){
					alert('La operación ha sido exitosa. El semestre '+response.anho+'-'+response.periodo+' se encuentra '+response.accion+' en este momento.');
					location.reload();					
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
	
	/*
	function eliminarSemestre(periodo,anho){
	
		//Generate JSON
		var info = new Object();		
		info.periodo = periodo;
		info.anho = anho;
		//alert(JSON.stringify(info));
		
		$.ajax({
			type:"POST",
			url:"../Back/borrar_semestre.php",
			data: {datos: JSON.stringify(info)},
			dataType: "JSON",
			success: function(response){
				if(response.exito=='exito'){
					alert('El semestre '+response.anho+'-'+response.periodo+' se ha eliminado de la base de datos con éxito');
					location.reload();					
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
	/*
	function setValidationResponse(validatorResponse,response){
		validatorResponse = response;
	}
    */
    
    
    
    </script>

</body>

</html>

