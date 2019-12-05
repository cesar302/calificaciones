<?php
function add_carrera(){
	require_once (dirname( __FILE__ ) .'/functions.php'       );
	//require_once (dirname( __FILE__ ) .'/css/extension_styles.php');
	//extension_files();
	ob_start();
	global $wpdb;

	if (!empty($_POST)
		AND $_POST['nombre'] != ''
	) {
		$tabla_carrera = $wpdb->prefix.'carrera';
		$nombre = sanitize_text_field($_POST['nombre']);
		
		
		$wpdb ->insert(
		$tabla_carrera, 
			array(
				'nombre' => $nombre,
			)
		);
		echo "<div id='div_form'>";
		echo "<p class='exito'>Carrera Agregada</p>";
		unset($_POST);
		echo "<form class='form-add' action='".get_the_permalink()."' method='post'><input class='text-body' type='submit' value='Agregar otra carrera'></form>";
					echo "</div>";

	}else{
		//Formulario para agregar Carreras----******************
		?>
		<div id="div_form">
			<form class="form-add" action="<?php get_the_permalink(); ?>" method="post" enctype="multipart/form-data" />
				<label class="text-small-uppercase" for="Nombre">Nombre: </label><input class="text-body" type="text" name="nombre" required="required" />
				<br /><br /><input class="text-body" type="submit" name="submit" value="Agregar Carrera">
			</form>
		</div>
		<?php
	}
	return ob_get_clean();
}