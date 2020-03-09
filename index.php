<!DOCTYPE html>
<html lang="en">
<?php
        require_once 'default/head.php';
?>
<body>
    <div class="col-md-12 table-responsive text-nowrap p20">
      <div class="col-sm-2"><h2>Lista de empleados</h2></div>
      <br>
      <div class="col-md-12">
        <a href="crear_empleados.php">
            <button class="btn btn-primary fR mb10" type="button"><i class="fa fa-user-plus"></i> Crear</button>
        </a>
      </div>
      <br>
            <?php
            $listP = $oGlobals->verOpcionesPor("empleados", "ORDER BY nombre DESC ", 1);
            if( $listP != 2 ) {
            ?>
      <table class="table">
        <thead>
          <tr>
            <th scope="col"><i class="fa fa-user"></i> Nombre</th>
            <th scope="col"><i class="fa fa-at"></i> Email</th>
            <th scope="col"><i class="fa fa-venus-mars"></i> Sexo</th>
            <th scope="col"><i class="fa fa-briefcase"></i> Área</th>
            <th scope="col" width="5px"><i class="fa fa-envelope"></i> Boletín</th>
            <th scope="col" width="5px">Modificar</th>
            <th scope="col" width="5px">Eliminar</th>
          </tr>
        </thead>
        <tbody>
            <?php
                foreach ($listP as $value) {
                ?>
                <tr>
                    <td><?=utf8_encode($value['nombre']);?></td>
                    <td><?=$value['email'];?></td>
                    <td><?php if($value['sexo'] == "f") { echo "Femenino"; } else { echo "Masculino"; }?></td>
                <?php

                    $listA = $oGlobals->verOpcionesPor("areas", " AND id = ".$value['area_id']." ORDER BY id DESC ", 0);

                 ?>
                    <td><?=utf8_encode($listA['nombre']);?></td>
                    <td><?php if($value['boletin'] == 1) { echo "Si"; } else { echo "No"; }?></td>
                    <td class="tAC mA">
                        <a href="crear_empleados.php?id=<?=$value['id'];?>" class="color_negro"><i class="fa fa-pencil-square-o"></i></a>
                    </td>
                    <td class="tAC mA" onclick="Home.delete('<?=$value['id'];?>')"><i class="fa fa-trash"></i></td>

                </tr>
                <?php
                    }
            } else {
            ?>
                <div class="col-sm-2"><h4>No se han creado empleados</h4></div>
            <?php
            }
            ?>

        </tbody>
      </table>

        <div id="rsp-empleados mb20"></div>

    </div>

<?php
        require_once 'default/footer.php';
?>