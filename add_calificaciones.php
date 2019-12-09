<?php
function add_calificaciones(){
	require_once (dirname( __FILE__ ) .'/functions.php'       );
	//require_once (dirname( __FILE__ ) .'/../css/extension_styles.php');
	//extension_files();
	global $wpdb;
	$tabla_alumno = $wpdb->prefix . 'alumno';
	ob_start();
	if (!empty($_POST)
		AND $_POST['nombre'] != ''
		AND $_POST['carrera'] != ''
		AND $_POST['grupo'] != ''
		AND $_POST['parcial'] != ''
		AND $_POST['calificacion'] != ''
	) {
		$parcial;
		if ($_POST['parcial'] == '1er Parcial' ) {
			# code...
			$parcial = 'parcial1';
		}
		else if ($_POST['parcial'] == '2do Parcial') {
			# code...
			$parcial = 'parcial2';
		}
		else{
			$parcial = 'parcial1';
		}
		$nombre =  sanitize_text_field($_POST['nombre']);
		
		$calificacion =  (int)sanitize_text_field($_POST['calificacion']);
		$grupo = (int)getIdGrupo(sanitize_text_field($_POST['grupo']));
		$id_alumno = getIdAlumno($grupo,$nombre);
		$wpdb ->update($tabla_alumno,
			array($parcial => $calificacion),
			array('id'=>$id_alumno)
		);
		echo "<div id='form-add'>";
		echo "<p class='exito'>Calificación agregada con éxito</p>";
		unset($_POST);
		echo "<form clas='form-add' action='".get_the_permalink()."' method='post'><input type='submit' value='Agregar otra Calificación'></form>";
		echo "</div>";

	}
	else if (!empty($_POST)
		AND $_POST['nombre'] == ''
		AND $_POST['carrera'] != ''
		AND $_POST['grupo'] == ''
		AND $_POST['parcial'] == ''
		AND $_POST['calificacion'] == ''
	) {
		$carr=$_POST['carrera'];
		?>
		<div id="div_form">
			<form class="form-add" action="<?php get_the_permalink(); ?>" method="post" >
				<label class="text-small-uppercase" for="Nombre">Nombre: </label><input class="text-body" type="text" name="nombre" required="required" />
				<label class="text-small-uppercase" for="carrera">Grupo: </label><select class="text-body" name="grupo"><?php getGrupo($carr);?></select>
				<label class="text-small-uppercase" for="parcial">Parcial: </label><select class="text-body" name="parcial"><option>1er Parcial</option><option>2do Parcial</option></select>
				<label class="text-small-uppercase" for="calificacion">calificacion: </label><input class="text-body" type="text" name="calificacion" required="required" />
				<input type="hidden" name="carrera" value="<?php echo $_POST['carrera']; ?>">
				<br /><input class="text-body" type="submit" name="submit" value="Agregar alumno">
			</form>
		</div>
		<?php
		
	}else{
		//Formulario para Agregar alumnos
		?>
		<div id="div_form">
			<form class="form-add" action="<?php get_the_permalink(); ?>" method="post" >
				<label class="text-small-uppercase" for="carrera">Elige la Carrera: </label><select class="text-body" name="carrera"><?php getCarrera();?></select>
				<input type="hidden" name="grupo" value="">
				<input type="hidden" name="nombre" value="">
				<input type="hidden" name="parcial" value="">
				<input type="hidden" name="calificacion" value="">
				<br /><input class="text-body" type="submit" name="submit" value="Entrar">
			</form>
		</div>
		<?php
		
	}
	return ob_get_clean();
}

?>