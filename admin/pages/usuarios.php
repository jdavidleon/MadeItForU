<?php require '../../config/config.php'; ?>
<?php $titlePage = 'Usuarios'; ?>
<?php $pag = 'usuarios'; ?>
<?php require DIRECTORIO_ROOT.'admin/inc/header.php'; ?>

	
<?php $usuarios = User::usersList(); ?>


	<div class="container">	
		<h3 class="text-center text-uppercase" style="">Listado de usuarios</h3>	
	    <!-- <div class="btn-group pull-right" style="margin-right: 30px;">
	      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Dropdown <span class="caret"></span></button>
	      <ul class="dropdown-menu" role="menu">
	        <li><a href="#">Action</a></li>
	        <li><a href="#">Another action</a></li>
	        <li><a href="#">Something else here</a></li>
	        <li class="divider"></li>
	        <li><a href="#">Separated link</a></li>
	      </ul>
	    </div>
	    <div class="pull-right" style="margin-right: 1%;">
	      <button type="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#adduseruct">
	      <i class="fa fa-plus-circle" aria-hidden="true"> Agregar useructo</i>
	      </button>
	    </div> -->
	</div>
	<br><br>
	<div class="container" style="margin-bottom: 200px;">
		<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
      		<thead>
        		<tr>
                  	<th>Nombre</th>     
                   	<th>Correo</th>      
                   	<th>Fecha Nacimiento</th>
                   	<th>Rol</th>
                   	<th>Estado de cuenta</th>                         
                   	<th>Fecha Registro</th>
                   	<th>Fecha de baja</th> 
                   	<th>Acción</th> 
		        </tr>
		    </thead>
      		<tbody>   
      			<?php foreach ($usuarios as $user): ?>
      			<?php $dir = CRUD::numRows('usuarios_direcciones','*','id_usuario = ?',['i',$user['id_usuario']]); ?>
      				<tr>     
      					<td><?php echo $user['nombre'].' '.$user['apellido_usuario'];; ?></td>
      					<td><?php echo $user['correo']; ?></td>      					
      					<td><?php echo $user['fecha_nacimiento']; ?></td>
      					<td><?php echo $user['rol']; ?></td>
      					<td>
      						<?php if ($user['estado_usuario'] === 1): ?>
      							Activo
      						<?php else: ?>
      							Inactivo
      							<a class="btn btn-danger btn-xs" href="<?php echo ADMIN.'bd/usuarios/activar_cuenta.php?correo='.$user['correo'].'&empt_val=' ?>">
      								Activar
      							</a>
      						<?php endif ?>
   						</td>      					
      					<td><?php echo $user['fecha_registro']; ?></td>
      					<td><?php echo $user['tm_delete'] == null ? 'N/A' : $user['tm_delete']; ?></td>
      					<td>
	      					<a class="btn btn-xs btn-warning" onclick="editarUsuario(<?php echo $user['id_usuario']; ?>)" data-toggle="modal" data-target="#editUser" href="">		
	      						Editar
	      					</a>
	      					<?php if ($user['tm_delete'] === null): ?>
	      						<a class="btn btn-xs btn-danger" onclick="eliminarUsuario(<?php echo $user['id_usuario']; ?>)">
		      						Eliminar
		      					</a>
		      				<?php else: ?>
		      					<a class="btn btn-xs btn-danger" onclick="darAltaUsuario(<?php echo $user['id_usuario']; ?>)">
		      						Restaurar
		      					</a>
	      					<?php endif ?>
      					</td>
			        </tr> 
      			<?php endforeach ?>
	      </tbody>
    </table>
	</div>





<?php include DIRECTORIO_ROOT.'admin/inc/footer.php'; ?>
