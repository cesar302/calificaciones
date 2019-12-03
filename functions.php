<?php
function getCarrera(){
	global $wpdb;
	$table_carrera = $wpdb ->prefix . 'carrera';
	$carreras = $wpdb->get_results("SELECT nombre FROM $table_carrera ORDER BY nombre ASC");
	foreach ($carreras as $value) {
		# code...
		$carrera = esc_textarea($value->nombre);
		echo '<option>' . $carrera . '</option>';
	}
}
function getGrupo(){
	global $wpdb;
	$table_grupo = $wpdb ->prefix . 'grupo';
	$grupos = $wpdb->get_results("SELECT nombre FROM $table_grupo ORDER BY nombre ASC");
	foreach ($grupos as $value) {
		# code...
		$grupo = esc_textarea($value->nombre);
		echo '<option>' . $grupo . '</option>';
	}
}
function getIdCarrera($carrera){
	global $wpdb;
	$table_carreras = $wpdb ->prefix . 'carrera';
	$id = $wpdb->get_results("SELECT id FROM $table_carreras WHERE nombre = '$carrera'");
	foreach ($id as $value) {
		# code...
		return esc_textarea($value->id);
	}
}