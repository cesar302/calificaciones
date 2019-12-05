<?php
function upd_alumno(){
	require_once (dirname( __FILE__ ) .'/functions.php'       );
	//require_once (dirname( __FILE__ ) .'/css/extension_styles.php');
	//extension_files();
	ob_start();
	global $wpdb;

	if (!empty($_POST)
		AND $_POST['nombre'] != ''
		AND $_POST['parcial'] != ''
		ANd $_POST['cal'] != ''
	) {
		$tabla_carrera = $wpdb->prefix.'carrera';
		$nombre = sanitize_text_field($_POST['nombre']);
		$grupo = sanitize_text_field($_POST['grupo']);
		
		
		$wpdb ->update($tabla_carrera,
			array('id_grupo'=>$grupo),
			array('nombre'=>$nombre),
		);
		echo "<div id='div_form'>";
		echo "<p class='exito'>Datos actualizados</p>";
		unset($_POST);
		echo "<form class='form-add' action='".get_the_permalink()."' method='post'><input class='text-body' type='submit' value='Actualizar otro dato'></form>";
					echo "</div>";

	}else{
		//Formulario para Actualizar Carreras----******************
		?>
		<div id="div_form">
			<form class="form-add" action="<?php get_the_permalink(); ?>" method="post" enctype="multipart/form-data" />
				<label class="text-small-uppercase" for="Nombre">Nombre del alumno: </label><input class="text-body" type="text" name="nombre" required="required" />
				<label class="text-small-uppercase" for="parcial">Parcial </label><select name="parcial"><option value="parcial1">1er Parcial</option><option value="parcial2">2do Parcial</option></select>
				<label class="text-small-uppercase" for="cal">Nuevo calificacion: </label><input class="text-body" type="text" name="cal" required="required" />
				<br /><br /><input class="text-body" type="submit" name="submit" value="Agregar Carrera">
			</form>
		</div>
		<?php
	}
	return ob_get_clean();
}