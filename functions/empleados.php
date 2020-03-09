<?php

	// error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
	// ini_set('display_errors', TRUE);
	// ini_set('display_startup_errors', TRUE);

	require_once 'utils.php';
	$Utils = new Utils();

	require_once 'classGlobal.php';
	$oGlobals = new Globals();

	if( trim($_REQUEST["email"]) != "" ) {

		$_REQUEST["email"] = strtolower($_REQUEST["email"]);
		// $validateC = $Utils->test_input($_REQUEST["email"]);
		$validateC = $Utils->valida_email($_REQUEST["email"]);

		// if (!filter_var($validateC, FILTER_VALIDATE_EMAIL)) {
		if (!$validateC) {
		  echo "5";
		} else {

			if(trim($_REQUEST["nombre"]) != "" && trim($_REQUEST["sexo"]) != "" && trim($_REQUEST["area_id"]) != "" && trim($_REQUEST["descripcion"]) != "" && isset($_REQUEST["roles"]) ){

				$_REQUEST["nombre"] = ucwords(strtolower(utf8_decode($_REQUEST["nombre"])));

				$id = "";
				if(isset($_REQUEST["id"])) $id = trim($_REQUEST["id"]);

				$insert = 0;
				$update = 2;

				if($id == ""){
					$insert = $oGlobals->insert_data_array($_REQUEST, "empleados");
				} else {
					$update = $oGlobals->update_data_array($_REQUEST, "empleados", "id", $id);
				}

				if($insert != 0) {

					foreach ($_REQUEST["roles"] as $key => $value) {
						$roles["empleado_id"] = $insert;
						$roles["rol_id"] = $value;

						$oGlobals->insert_data_array($roles, "empleado_rol");
					}

					echo '1';
				} else if($update != 2){

					$oGlobals->eliminar_por("empleado_rol", "empleado_id", $id);

					foreach ($_REQUEST["roles"] as $key => $value) {
						$roles["empleado_id"] = $id;
						$roles["rol_id"] = $value;

						$oGlobals->insert_data_array($roles, "empleado_rol");
					}

					echo '2';
				} else echo "4";
			} else echo "3";

		}

	} else {
		echo "<div class='error'>Debes ingresar campos obligatorios</div>";
		}

?>


