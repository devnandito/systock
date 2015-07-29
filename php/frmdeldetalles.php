<?php
include 'session.php';
include '../includes/charset.php';
include '../includes/DbConnector.php';
?>
<!doctype html>
<html lang="es">
<head>
  <?php include 'head.html';?>
</head>
<body>
<section class="container">
    <header>
        <?php include 'title.html';?>
        <nav>
            <?php include 'menuadmin.php';?>
        </nav>
    </header>
    <section class="content">
      <?php
      $pk=$_GET['pk'];
      $table1='detalle_solicitudes ds, insumos i, desinsumos di, tipos t';
      $table='detalle_solicitudes ';
      $array=array('pkdet','desinsumo','destipo');
      $sql=select($table1,$array);
      $sql.=" WHERE pkdet='".$pk."' AND ds.fkinsumo=i.pkinsumo AND i.fkdesinsumo=di.pkdesinsumo AND di.fktipo=t.pktipo ";
      $res = connector2($sql);
      $row=fetchArray($res);
      $rows=getNumRows($res);
      $pkt='pkdet';
      if($_SESSION['s_nivel']==2 || $_SESSION['s_nivel']==3)
      {
      	$pages='viewdetallestoapro.php';
      }
      else
      {
      	$pages='viewdetallesuser.php';
      }
      if($rows>0){
      ?>
      <form id="form" name="form" method="post" action="delete.php">
      <input type="hidden" id="table" name="table" value="<?=$table?>">
      <input type="hidden" id="pkt" name="pkt" value="<?=$pkt?>">
      <input type="hidden" id="page" name="page" value="<?=$pages?>">
      <table>
        <tr>
        	<th colspan="2">Borrar detalle</th>
        </tr>
        <tr>
          <td>PK </td>
          <td><input type="hidden" id="pk" name="pk" value="<?=$pk?>" /><?=$pk;?></td>
        </tr>
        <tr>
          <td>Descripción</td>
          <td><input type="text" id="des" name="des"  value="<?=$row['desinsumo'].' '.$row['destipo']?>" /></td>
        </tr>
        <tr>
          <td><a href="<?=$pages?>" class="boton">Volver</a></td>
          <td><input id="delete" type="submit" class="boton" value="Borrar" ></td>
        </tr>
      </table>
      </form>
      <?
      }
      ?>
    </section>
</section>
</body>
</html>