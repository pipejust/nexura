<?php

	require_once 'connect/conexion.php';

	class Globals{

		public static $instancia;
		public $dbh;

		public function __construct(){

			$this->dbh     = Conexion::singleton_conexion();

		}

		public function insert_data_array($array, $tabla){

			try {

					$query 	= $this->dbh->prepare("SHOW COLUMNS FROM $tabla");
					$query->execute();
					$campos = $query->fetchAll();

					foreach($array as $key => $data){

						if($data != '' && $key != 'id'){

							foreach($campos as $campo_key => $campo_data){

								$existe = array_search($key, $campo_data);

								if($existe) {

									if($campo_data[1]== "text")		$array_2[$key] = ($data);
									else  							$array_2[$key] = ($data);
									break;
								}
							}
						}
					}

					$array = $array_2;

					$fields		= array_keys($array);
					$values		= array_values($array);
					$fieldlist	= implode(',',$fields);
					$qs			= str_repeat("?,",count($fields)-1);
					$sql		= "INSERT INTO $tabla ($fieldlist) values(${qs}?)";
					$query 		= $this->dbh->prepare($sql);

					if ($query->execute($values) === false) return 0;	/*var_dump($errorcode = $query->errorCode());*/
					else return $this->dbh->UltimoIDInsertado();


			} catch (PDOException $e) {

				$e->getMessage();
			}
		}

		public function update_data_array($array, $tabla, $campo, $value){

			try {

					$cant      = 1;
					$coma      = ", ";
					$fieldlist = "";
					$count     = count($array);
					$array_3   = array();

					$query 	= $this->dbh->prepare("SHOW COLUMNS FROM $tabla");
					$query->execute();
					$campos = $query->fetchAll();

					foreach($array as $key => $data){

						if($data != ''){

							foreach($campos as $campo_key => $campo_data){

								$existe = array_search($key, $campo_data);
								if($existe) {

									if("id" != $campo_key) {

										if($campo_data[1]== "longtext" || $campo_data[1]== "text")	$array[$key] = ($data);
										else  														$array[$key] = ($data);

										$array_3[$cant] = $array[$key];

										$fieldlist  .= $key." = ?".$coma;
										break;
									}
								}
							}
						}
						$cant++;
					}

					$fieldlist = trim($fieldlist, ', ');

					$sql	= "UPDATE $tabla SET $fieldlist WHERE $campo = ?";
					$query 	= $this->dbh->prepare($sql);



					$i = 1;
					foreach($array_3 as $key => $data){

						$query->bindValue($i, $data);
						$i++;

					}

						$query->bindValue($i, $value);

					if ($query->execute() === false) return 2;	/*var_dump($errorcode = $query->errorCode());*/
					else return 1;


			} catch (PDOException $e) {

				$e->getMessage();
			}
		}

		public function eliminar_por($tabla, $parametro, $id){

			try {

				$query = $this->dbh->prepare("DELETE FROM $tabla WHERE $parametro = ?");
				$query->bindParam(1,$id);

				if ($query->execute() === false) return 2;
				else 							 return 1;

			}catch(PDOException $e){

				print "Error!: " . $e->getMessage();

			}

		}

		public function verOpcionesPor($tabla, $condicion, $fetchAll){

			try {

				$query = $this->dbh->prepare("
												SELECT
													$tabla.*
												FROM
													$tabla
												WHERE
													1=1 $condicion
											 ");
				$query->execute();

				if($query->rowCount() != 0)	{

					if ($fetchAll == 1)	return $query->fetchAll();
					else				return $query->fetch();

				}
				else 						return 2;

			}catch(PDOException $e){

				print "Error!: " . $e->getMessage();

			}

		}
	}
?>