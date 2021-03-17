<div class="row">
    <div class="col-12 col-m-12 col-sm-12">
        <!-- <div class="card"> -->
        <h2>Lista de usuarios</h2>
		<div class="barra__buscador">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="buscar nombre o apellidos" 
				value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar">
				<a href="insert.php" class="btn btn__nuevo">Nuevo</a>
			</form>
		</div>
		<table>
			<tr class="head">
				<td>Id</td>
                <td>Tipo Documento</td>
				<td>Número documento</td>
                <td>Nombres</td>
				<td>Apellidos</td>
                <td>Dirección</td>
				<td>Teléfono</td>
				<td>Género</td>
				<td>Cuenta</td>
                <td>Correo</td>
                <td>Contraseña</td>
                <td>Rol</td>
                <td>Estado</td>

				<td colspan="2">Acciónes</td>
			</tr>
			<!-- <?php foreach($resultado as $fila):?> -->
				<tr >
					<td><?php echo $fila['id']; ?></td>
					<td><?php echo $fila['nombre']; ?></td>
					<td><?php echo $fila['apellidos']; ?></td>
					<td><?php echo $fila['telefono']; ?></td>
					<td><?php echo $fila['ciudad']; ?></td>
					<td><?php echo $fila['correo']; ?></td>
					<td><a href="update.php?id=<?php echo $fila['id']; ?>"  class="btn__update" >Editar</a></td>
					<td><a href="delete.php?id=<?php echo $fila['id']; ?>" class="btn__delete">Eliminar</a></td>
				</tr>
			<?php endforeach ?>

		</table>
            
        </div>
    </div>
</div>
</div>

                            
<script src="<?php echo SERVERURL; ?>assets/script/calendar.js"></script>