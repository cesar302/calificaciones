<?php
/*
Plugin Name: Califications
Plugin URI: cesarsalas.mx
Description: Control Escolar
Version: 1.0
Author: César Salas Casas
Author URI: cesarsalas.mx
License: GPL2
*/
//Funciones de hooks para crear bases de datos
function carreras(){
	
	global $wpdb;
	$t_carreras = $wpdb->prefix.'carrera';
	$charset_collate = $wpdb->get_charset_collate();
	//consulta sql
	$query = "CREATE TABLE IF NOT EXISTS $t_carreras (
		id int auto_increment,
		nombre varchar(25),
		UNIQUE(id)
		) $charset_collate";
	include_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta($query);
}
function grupos(){
	
	global $wpdb;
	$t_grupos = $wpdb->prefix.'grupo';
	$charset_collate = $wpdb->get_charset_collate();
	//consulta sql
	$query = "CREATE TABLE IF NOT EXISTS $t_grupos (
		id int auto_increment,
		nombre varchar(25),
		id_carrera int,
		UNIQUE(id)
		) $charset_collate";
	include_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta($query);
}
function alumnos(){
	
	global $wpdb;
	$t_alumnos = $wpdb->prefix.'alumno';
	$charset_collate = $wpdb->get_charset_collate();
	//consulta sql
	$query = "CREATE TABLE IF NOT EXISTS $t_alumnos (
		id int auto_increment,
		nombre varchar(25),
		id_grupo int,
		UNIQUE(id)
		) $charset_collate";
	include_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta($query);
}
function calificaciones(){
	
	global $wpdb;
	$t_calificaciones = $wpdb->prefix.'calificaciones';
	$charset_collate = $wpdb->get_charset_collate();
	//consulta sql
	$query = "CREATE TABLE IF NOT EXISTS $t_calificaciones (
		id int  auto_increment,
		id_alumno int,
		parcial1 varchar(5),
		parcial2 varchar(5),
		UNIQUE(id)
		) $charset_collate";
	include_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta($query);
}
register_activation_hook(__FILE__, "carreras" );
register_activation_hook(__FILE__, "grupos" );
register_activation_hook(__FILE__, "alumnos" );
register_activation_hook(__FILE__, "calificaciones" );


require_once( dirname(__FILE__).'/add_carrera.php'    );

require_once( dirname(__FILE__).'/add_grupo.php'      );

require_once( dirname(__FILE__).'/add_alumnos.php'     );

require_once( dirname(__FILE__).'/upd_alumno.php'     );


add_shortcode("upd_alumno","upd_alumno");
add_shortcode("add_carrera","add_carrera" );
add_shortcode("add_grupo","add_grupo"     );
add_shortcode("add_alumno","add_alumno"   );



