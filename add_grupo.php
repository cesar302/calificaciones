<?php
function add_grupo(){
	require_once (dirname( __FILE__ ) .'/../functions.php'       );
	require_once (dirname( __FILE__ ) .'/../css/extension_styles.php');
	extension_files();
	global $wpdb;
	$tabla_grupo = $wpdb->prefix . 'grupo';
	ob_start();
	if (!empty($_POST)
		AND $_POST['nombre'] != ''
		AND $_POST['carrera'] != ''
	)) {
		$nombre =  sanitize_text_field($_POST['nombre']);
		$id_carrera = (int) getIdCarrera($_POST['carrera']);
		$wpdb ->insert(
					$tabla_grupo, 
					array(
						'nombre' => $nombre,
						'id_carrera' => $carrera,
						)
					);
		echo "<div id='form-add'>";
		echo "<p class='exito'>Grupo Agregado con éxito</p>";
		unset($_POST);
		echo "<form clas='form-add' action='".get_the_permalink()."' method='post'><input type='submit' value='Agregar otro Grupo'></form>";
		echo "</div>";
	}else{
		//Formulario para Agregar Grupos
		?>
		<div id="div_form">
			<form class="form-add" action="<?php get_the_permalink(); ?>" method="post" >
				<label class="text-small-uppercase" for="Nombre">Nombre: </label><input class="text-body" type="text" name="nombre" required="required" />
				<label class="text-small-uppercase" for="carrera">Carrera: </label><select class="text-body" name="carrera"><?php getCarrera();?></select>
				<br /><input class="text-body" type="submit" name="submit" value="Agregar Grupo">
			</form>
		</div>
		<?php
		return ob_get_clean();
	}
}

?>