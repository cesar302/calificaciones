<?php
function consult_alumnos(){
	require_once (dirname( __FILE__ ) .'/../includes/functions.php'       );
	//require_once (dirname( __FILE__ ) .'/../css/extension_styles.php');
	extension_files_table();
	global $wpdb;
	ob_start();
	
	
	
	$t_alumno = $wpdb->prefix.'alumno';
	$t_carrera = $wpdb->prefix.'carrera';
	$t_grupo = $wpdb->prefix.'grupo';
	if (!empty($_POST) AND $_POST['opc'] == 'alumnos') {
		# code...
		$id_grupo = $_POST['id'];
		$history = $wpdb->get_results("SELECT id,nombre,parcial1,parcial2 FROM $t_alumno WHERE id_grupo = $id_grupo ORDER BY nombre ASC");
		?>
		<div class="table-motors">
	  		<div class="header">Alumnos</div>
			<table class="responsive-table">
				<tr class="table-header">
					<th class="table-th">#</th>
					<th class="table-th">Nombre</th>
					<th class="table-th">1er Parcial</th>
					<th class="table-th">2do Parcial</th>
				</tr>
				<?php 

				$num=1;
				foreach ($history as $value) {
					$id = esc_textarea($value->id);
					$nombre = esc_textarea($value->nombre);
					$parcial1 = esc_textarea($value->url_parcial1);
					$parcial2 = esc_textarea($value->parcial2);
					$prom = ($parcial1+$parcial2)/2 
					?>
					
				<tr class="table-row">
					<td class="table-td col1"><?php echo $num; ?></td>
					<td class="table-td col2"><?php echo $nombre; ?></td>
					<td class="table-td col2"><?php echo $parcial1; ?></td>
					<td class="table-td col2"><?php echo $parcial2; ?></td>
					<td class="table-td col3"><span style="background-color: <?php getStyleColor(getColor_Estado($estado));?>;color:black;padding: 3px;"><?php echo getColor_Estado($estado); ?></span></td>
					
				</tr >
					
					<?php
					}
					 ?>
			</table>
		</div>
		<?php
	}
	elseif (!empty($_POST) AND $_POST['opc'] == 'grupos') {
		$id_carrera = $_POST['id'];
		$grupos = $wpdb->get_results("SELECT id,nombre FROM $t_grupo WHERE id_carrera = $id_carrera ");
		$num=1;
		?>
		<div class="table-motors">
	  		<div class="header">Grupos</div>
			<table  class="responsive-table">
				<tr class="table-header">
					<th class="table-th">#</th>
					<th class="table-th">Grupo</th>
					<th class="table-th">-</th>
				</tr>
				<?php 
				foreach ($grupos as $value) {
					$id = esc_textarea($value->id);
					$nombre = esc_textarea($value->nombre);
					
					?>
						<tr>
							<td class="table-td col1"><?php echo $num; ?></td>
							<td class="table-td col2"><?php echo $nombre; ?></td>
							<td class="table-td col3">
								<form action="<?php get_the_permalink(); ?>" method="post" class="form-sub">
									<input type="hidden" name="opc" value="alumnos" />
									<input type="hidden" name="id" value="<?php echo $id; ?>" />
									<input type="submit" name="submit" value="Ver Lista de alumnos" />
								</form>
							</td>
						</tr>
					
					<?php
					$num+=1;
				}
				 ?>
			</table>
		</div>
		<?php
	}
	else{
		$carreras = $wpdb->get_results("SELECT id, nombre FROM $t_carrera");

		?>
		<div class="table-motors">
	  		<div class="header">Carreras</div>
			<table class="responsive-table">
				<tr class="table-header">
					<th class="table-th">#</th>
					<th class="table-th">Carrera</th>
					<th class="table-th">-</th>
				</tr>

				<?php 
				foreach ($carreras as $value) {
					$id = esc_textarea($value->id);
					$nombre = esc_textarea($value->nombre);
					
					?>
					
						<tr>
							<td class="table-td col1"><?php echo $id; ?></td>
							<td class="table-td col2"><?php echo $nombre; ?></td>
							
							<td class="table-td col3">
								<form action="<?php get_the_permalink(); ?>" method="post" class="form-sub">
									<input type="hidden" name="opc" value="grupos" />
									<input type="hidden" name="id" value="<?php echo $id; ?>" />
									<input type="submit" name="submit" value="Ver grupos" />
								</form>
							</td>
						</tr>
					
					<?php
				}
				 ?>
			</table>
		</div>
		<?php
	}
	return ob_get_clean();
}

?>