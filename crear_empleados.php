<!DOCTYPE html>
<html lang="en">
<?php
		require_once 'default/head.php';

		if( isset($_REQUEST['id']) ) {
			$id = $_REQUEST['id'];

			if( isset($id) ) {
				$empleado = $oGlobals->verOpcionesPor("empleados", " AND id = ".$id." ORDER BY id DESC ", 0);
			}
		}

?>
<body>
	<div class="container py-5">
	    <div class="row">
	        <div class="col-md-12">
	            <div class="row">
	                <div class="col-md-12 mx-auto">
	                    <div class="card rounded-0">
	                        <div class="card-header">
	                            <h3 class="mb-0">Los campos con asterisco (*) son obligatorios</h3>
	                        </div>
	                        <div class="card-body">
								<form id="frm-empleado" name="frm-empleado" action="" method="post" class="form_sdv">
								  <input type="hidden" id="id" name="id" value="<?php if(isset($empleado['id'])){echo utf8_encode($empleado['id']);}?>" required>
								  <div class="form-group row">
								    	<label class="col-sm-2 col-form-label" for="nombre">Nombre completo *</label>
								    	<div class="col-sm-10">
								    		<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre completo del empleado" value="<?php if(isset($empleado['nombre'])){echo utf8_encode($empleado['nombre']);}?>">
								    	</div>
								  </div>
								  <div class="form-group row">
									    <label class="col-sm-2 col-form-label" for="email">Correo electrónico *</label>
									    <div class="col-sm-10">
								    		<input type="email" class="form-control" name="email" id="email" placeholder="Correo electrónico" value="<?php if(isset($empleado['email'])){echo $empleado['email'];}?>" required>
								    	</div>
								  </div>
								  <div class="form-group">
								    <div class="row">
								      <legend class="col-sm-2 col-form-label">Sexo *</legend>
								      <div class="col-sm-10">
								        <div class="form-check">
								          <input class="form-check-input" type="radio" name="sexo" id="sexo1" value="m" <?php if(isset($empleado['sexo'])){if($empleado['sexo']  == "m"){ echo "checked";}}?>>
								          <label class="form-check-label" for="sexo1">
								            Masculino
								          </label>
								        </div>
								        <div class="form-check">
								          <input class="form-check-input" type="radio" name="sexo" id="sexo2" value="f" <?php if(isset($empleado['sexo'])){if($empleado['sexo']  == "f"){ echo "checked";}}?> >
								          <label class="form-check-label" for="sexo2">
								            Femenino
								          </label>
								        </div>
								      </div>
								    </div>
								  </div>
								  <div class="form-group row">
								      	<label class="col-sm-2 col-form-label" for="area">Área *</label>
									    <div class="col-sm-10">
									      <select name="area_id" id="area_id" class="form-control" required>
									        <option selected>Seleccione un área</option>
											<?php

											$listP = $oGlobals->verOpcionesPor("areas", "ORDER BY nombre DESC ", 1);


											foreach ($listP as $value) {
											?>
												<option value="<?=$value['id'];?>" <?php if(isset($empleado["area_id"])) {if($empleado["area_id"] == $value['id']) { echo "selected"; };}?>><?=utf8_encode($value['nombre']);?></option>

											<?php
												}
											?>
									      </select>
									    </div>
								  </div>
								  <div class="form-group row">
								    	<label class="col-sm-2 col-form-label" for="descripcion">Descripción *</label>
								      	<div class="col-sm-10">
								      		<textarea cols="30" rows="2" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción de la experiencia del empleado" required><?php if(isset($empleado['descripcion'])){echo $empleado['descripcion'];}?></textarea>
								      	</div>
								  </div>
								  <div class="form-group row">
								    <div class="col-sm-2"></div>
								    <div class="col-sm-10">
								      <div class="form-check">
								        <input class="form-check-input" type="checkbox" name="boletin" id="boletin" value="1" <?php if(isset($empleado['boletin'])){if($empleado['boletin']  == "1"){ echo "checked";}}?> >
								        <label class="form-check-label" for="boletin">Deseo recibir boletín informativo</label>
								      </div>
								    </div>
								  </div>
								  <div class="form-group row">
								    <div class="col-sm-2">Roles *</div>
								    <div class="col-sm-10">
										<?php
										$listP = $oGlobals->verOpcionesPor("roles", "ORDER BY nombre DESC ", 1);
										if( isset($id) ) {

											$listRE = $oGlobals->verOpcionesPor("empleado_rol", " AND empleado_id = '".$id."'", 1);
										} else {
											$listRE = 2;
										}

										foreach ($listP as $value) {
											$checked = "";
											if( $listRE != 2 ) {
												foreach($listRE as $valu2) {
													if( $value["id"] == $valu2['rol_id'] ) {
														$checked = "checked";
														break;
													}
												}
											}
										?>
											<div class="form-check">
										        <input class="form-check-input" name="roles[]" type="checkbox" value="<?=$value['id'];?>" <?=$checked;?> >
										        <label class="form-check-label" for="roles1"><?=utf8_encode($value['nombre']);?></label>
										    </div>

										<?php
											}
										?>
								    </div>
								  </div>
								  <div id="rsp-empleado" class="mb20"></div>
								  <div class="form-group row">
								    	<label class="col-sm-2 col-form-label" for="descripcion"></label>
								      	<div class="col-sm-10">
								      		<a href="index.php"><button type="button" class="btn btn-secondary">Atrás</button></a>
								      		<button type="button" class="btn btn-primary btnSend" onclick="Home.sendForm(event, 'functions/empleados.php')">Guardar</button>
								      	</div>
								  </div>
								</form>
							</div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
<?php
        require_once 'default/footer.php';
?>