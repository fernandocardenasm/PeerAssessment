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
                            <a href="inicio_admin.php"><i class="glyphicon glyphicon-home fa-fw"></i> Inicio</a>
                        </li>
                        <li>
                            <a href="semestres_actuales.php"><i class="glyphicon glyphicon-list fa-fw"></i> Semestres</a>
                        </li>
                        <li>
                            <a href="profesores.php"><i class="glyphicon glyphicon-user fa-fw"></i> Profesores</a>
                        </li>
                        <li>
                            <a href="estudiantes.php"><i class="glyphicon glyphicon-user fa-fw"></i> Estudiantes</a>
                        </li>
                        <li>
                            <a class="active" href="#"><i class="glyphicon glyphicon-user fa-fw"></i> Administradores<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a class="active" href="admins_sistema.php">Admins. Sistema</a>
                                </li>
                                <li>
                                    <a href="admins_educativo.php">Admins. Educativos</a>
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
                    <h1 class="page-header">Administradores del Sistema</h1>
					<div class="panel-body">
						<a data-toggle="modal" id="botonCrear" href="#nuevoAdminSistema" class="btn btn-primary btn-large">
							Nuevo
						</a>
						<button id="botonEditar" class="btn btn-primary btn-large">
							Editar
						</button>
						<button id="botonBorrar" class="btn btn-primary btn-large">
							Borrar
						</button>
						<!--Modal:Nuevo Administrador Sistema-->
							<div id="nuevoAdminSistema" class="modal fade">
							   <div class="modal-dialog">   
								  <div class="modal-content"> 
									  <form id="newUserForm">
										 <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											×
											</button>
											<h3>Nuevo Administrador del Sistema</h3>
										 </div>
										 <div class="modal-body">
											<div class="form-group">
												<label>Código:</label>
												<input id="codigoNuevo" class="form-control" placeholder="Ingrese un código" name="codigo">
											</div>

											<div class="form-group">
												<label>Nombres:</label>
												<input id="nombresNuevo" class="form-control" placeholder="Ingrese los nombres" name="nombres"> 
											</div>
											
											<div class="form-group">
												<label>Apellidos:</label>
												<input id="apellidosNuevo" class="form-control" placeholder="Ingrese los apellidos" name="apellidos">  
											</div>
											
											<div class="form-group">
												<label>Nombre de usuario:</label>
												<input id="usuarioNuevo" class="form-control" placeholder="Ingrese un nombre de usuario" name="usuario">												
											</div>
											
										 </div>
										 <div class="modal-footer">
											<button id="confirmarNuevoAdminSistema" switch="nuevoUsuario" type="button" class="btn btn-success">Crear</button>
											<!--<a href="#" id="confirmarNuevoProfesor" class="btn btn-success">Crear</a>-->
											<a href="#" data-dismiss="modal" class="btn">Cerrar</a>
										 </div>
									 </form>
							      </div>
							   </div>
							</div>
						<!--Fin Modal:Nuevo Administrador Sistema-->
						<!--Modal:Editar Administrador Sistema-->
							<div id="editarAdminSistema" class="modal fade">
							   <div class="modal-dialog">   
								  <div class="modal-content"> 
									  <form id="editUserForm">
										 <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											×
											</button>
											<h3>Editar Administrador del Sistema</h3>
										 </div>
										 <div class="modal-body">
											<div class="form-group">
												<label>Código:</label>
												<input id="codigoEditable" class="form-control" placeholder="Ingrese un código" name="codigo">
											</div>

											<div class="form-group">
												<label>Nombres:</label>
												<input id="nombresEditable" class="form-control" placeholder="Ingrese los nombres" name="nombres"> 
											</div>
											
											<div class="form-group">
												<label>Apellidos:</label>
												<input id="apellidosEditable" class="form-control" placeholder="Ingrese los apellidos" name="apellidos">  
											</div>
											
											<div class="form-group">
												<label>Nombre de usuario:</label>
												<input id="usuarioEditable" class="form-control" placeholder="Ingrese un nombre de usuario" name="usuario">
											</div>
											
											<div class="checkbox">
												<label>
												  <input id="anularContrasena" type="checkbox" name='anular'> Anular contraseña
												</label>
											</div>

										 </div>
										 <div class="modal-footer">
										    <button id="confirmarEditarAdminSistema" switch="editarUsuario" type="button" class="btn btn-success">Editar</button>
											<!--<a href="#" data-dismiss="modal" id="confirmarEditarProfesor" class="btn btn-success">Editar</a>-->
											<a href="#" data-dismiss="modal" class="btn">Cerrar</a>
										 </div>
									   </form>
							       </div>
							   </div>
							</div>
						<!--Fin Modal:Editar Administrador Sistema-->
						<!--Modal:Borrar Administrador Sistema-->
							<div id="borrarAdminSistema" class="modal fade">
							   <div class="modal-dialog">   
								  <div class="modal-content"> 
									 <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										×
										</button>
										<h3>Borrar Administrador del Sistema</h3>
										<p>¿Está seguro que quiere borrar de la base de datos a este administrador del sistema? Si la acción resulta ser exitosa, no se podrá deshacer.</p>
									 </div>
									 <div class="modal-footer">
										<a href="#" data-dismiss="modal" id="confirmarBorrarAdminSistema" class="btn btn-success">Borrar</a>
										<a href="#" data-dismiss="modal" class="btn">Cerrar</a>
									 </div>
								</div>
							   </div>
							</div>
						<!--Fin Modal:Borrar Administrador Sistema-->
									
						
					</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
										<th>Nombres</th>
                                        <th>Apellidos</th>                                        
                                        <th>Usuario</th>
										<th>Contraseña</th>
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
	
		var SESSION = { 
		 "user": "<?php echo $_SESSION["user"]; ?>"
		};
	
		$("#confirmarNuevoAdminSistema").attr("disabled", true);
		
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
		
		$("#confirmarNuevoAdminSistema").click(function(){
			crear(table);
		});
	
		$("#botonEditar").click(function(){
			if (verificarSeleccion(table)==true){
				if (verificarSesion(table,SESSION)==true){
					//alert('true');
					cargarSeleccion(table);
				}else{
					//alert('false');
					alert('No se permite la modificación de tus datos para no alterar esta sesión. Si necesitas modificar tu información, puedes pedirle a otro administrador de sistema que lo haga por tí, o modificarlo directamente de la base de datos.');
				}
			}else{
				alert('No ha seleccionado un administrador del sistema para editar su información');
			}
		});
		
		$("#botonBorrar").click(function(){
			if (verificarSeleccion(table)==true){
				if (verificarSesion(table,SESSION)==true){
					$('#borrarAdminSistema').modal('show');
				}else{
					alert('No está permitido borrar tus propios datos de la base de datos.');
				}			
			}else{
				alert('No ha seleccionado un administrador del sistema para borrar su información');
			}	
		});
		
		$("#confirmarEditarAdminSistema").click(function(){
			editar(table);					
		});
		
		$("#confirmarBorrarAdminSistema").click(function(){
			borrar(table);
		});
		
		
	});
	
	
	function cargar_informacion(table){
	
		$.ajax({
			type:"POST",
			data:{},
			url:"../Back/cargar_informacion_admins_sistema.php",
			dataType:'JSON',
			success: function(h){
				if(h.exito=="exito"){
					var i;
					table.fnClearTable();
					for(i=0;i<h.n;i++){
						table.fnAddData([h[i][0],h[i][1],h[i][2],h[i][3],h[i][4]]);
					}
				}
				else if(h.exito=='listavacia'){
					alert("No hay administradores del sistema en la base de datos.");
					//Esto no debería suceder jamás.
				}
				else{
					alert("Tenemos problemas con nuestro servicio. Inténtelo más tarde por favor.");
				}
			},
			error: function(i){
				alert("Error en la transacción. Inténtelo más tarde por favor.");
			}
		});	
		
		
	}
	
	function crear(table){

		//Generate JSON
		var usuario = new Object();		
		usuario.codigo = $('#codigoNuevo').val();
		usuario.nombres = $('#nombresNuevo').val();
		usuario.apellidos = $('#apellidosNuevo').val();
		usuario.usuario = $('#usuarioNuevo').val();
		
		$.ajax({
			type:"POST",
			url:"../Back/crear_admin_sistema.php",
			data: {datos: JSON.stringify(usuario)},
			dataType: "JSON",
			success: function(response){
				if(response.exito=='exito'){
				table.$('tr.selected').removeClass('selected');
				cargar_informacion(table);
				alert('Se ha agregado el(la) administrador(a) '+response.nombres+' '+response.apellidos+' a la base de datos de manera exitosa.');
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
	
	function verificarSeleccion(table){
		if (table.$('tr.selected').length==0){
			return false;
		}else{
			return true;
		}
	}

	function verificarSesion(table,SESSION){
		//alert(SESSION.user);
		//alert(table.$('tr.selected').find('td:nth-child(4)').text());
		//var user = SESSION.user;
		if (SESSION.user == table.$('tr.selected').find('td:nth-child(4)').text()){
			return false;
		}else{
			return true;
		}
		
	}
	
	function cargarSeleccion(table){
		$('#editarAdminSistema').modal('show');	
		$('#codigoEditable').val(table.$('tr.selected').find('td:first-child').text());
		$('#nombresEditable').val(table.$('tr.selected').find('td:nth-child(2)').text());
		$('#apellidosEditable').val(table.$('tr.selected').find('td:nth-child(3)').text());
		$('#usuarioEditable').val(table.$('tr.selected').find('td:nth-child(4)').text());		
		if (table.$('tr.selected').find('td:nth-child(5)').text()=='Sí'){
			$('.checkbox').show();			
		}else{
			$('.checkbox').hide();
			$('#anularContrasena').attr('checked', false);
		}
	}
		
	function editar(table){
	
	//Generate JSON
		var usuario = new Object();	
		usuario.id = table.$('tr.selected').find('td:first-child').text();
		usuario.codigo = $('#codigoEditable').val();
		usuario.nombres = $('#nombresEditable').val();
		usuario.apellidos = $('#apellidosEditable').val();
		usuario.usuario = $('#usuarioEditable').val();
		if ($('#anularContrasena').is(':checked')){
			//alert('ON');
			usuario.contrasena = 'NULLIFY';
		}else{
			//alert('OFF');
			usuario.contrasena = 'CONSERVE';
		}
		
		$.ajax({
			type:"POST",
			url:"../Back/actualizar_admin_sistema.php",
			data: {datos: JSON.stringify(usuario)},
			dataType: "JSON",
			success: function(response){
				if(response.exito=='exito'){
				table.$('tr.selected').removeClass('selected');
				cargar_informacion(table);
				alert('Se han actualizado los datos del(la) administrador(a) '+response.nombres+' '+response.apellidos+' en la base de datos de manera exitosa.');
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
	
	function borrar(table){
	
	//Generate JSON
		var info = new Object();
		info.id = table.$('tr.selected').find('td:first-child').text();
		info.nombres = table.$('tr.selected').find('td:nth-child(2)').text();
		info.apellidos = table.$('tr.selected').find('td:nth-child(3)').text();
			
		$.ajax({
			type:"POST",
			url:"../Back/borrar_admin_sistema.php",
			data: {datos: JSON.stringify(info)},
			dataType: "JSON",
			success: function(response){
				if(response.exito=='exito'){
				table.$('tr.selected').removeClass('selected');
				cargar_informacion(table);
				alert('Se ha borrado el(la) administrador(a) '+response.nombres+' '+response.apellidos+' de la base de datos de manera exitosa.');
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


