<?php


		if($_REQUEST['id'] != "" && $_REQUEST['table'] != ""){


			require_once 'classGlobal.php';

			$oGlobals = new Globals();

			$id    = $_REQUEST['id'];
			$table = $_REQUEST['table'];

			$eliminar = $oGlobals->eliminar_por($table, "id", $id);

			echo '6';


		}

 ?>