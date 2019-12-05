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
function getGrupo($carrera){
	global $wpdb;
	$val=getIdCarrera($carrera);
	$table_grupo = $wpdb ->prefix . 'grupo';
	$grupos = $wpdb->get_results("SELECT nombre FROM $table_grupo WHERE id_carrera = $val ORDER BY nombre ASC");
	foreach ($grupos as $value) {
		# code...
		$grupo = esc_textarea($value->nombre);
		echo '<option>' . $grupo . '</option>';
	}
}
function getAllGrupo(){
	global $wpdb;
	$table_grupo = $wpdb ->prefix . 'grupo';
	$grupos = $wpdb->get_results("SELECT DISTINCT nombre FROM $table_grupo ORDER BY nombre ASC");
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
		echo esc_textarea($value->id);
		return esc_textarea($value->id);
	}
}
function getIdGrupo($grupo){
	global $wpdb;
	$table_grupos = $wpdb ->prefix . 'grupo';
	$id = $wpdb->get_results("SELECT id FROM $table_grupos WHERE nombre = '$grupo'");
	foreach ($id as $value) {
		# code...
		echo esc_textarea($value->id);
		return esc_textarea($value->id);
	}
}