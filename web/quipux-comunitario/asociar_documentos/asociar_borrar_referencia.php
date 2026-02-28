<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 $ruta_raiz = "..";
  session_start();
  include_once "$ruta_raiz/rec_session.php";
  require_once("$ruta_raiz/funciones.php");
  require_once("$ruta_raiz/obtenerdatos.php");

  // INICIO  security/sed-7-sql-inyection
  if (!empty($_POST['radi_nume'])) {
      $radi_nume = trim(limpiar_sql($_POST['radi_nume']));
      $sql = "UPDATE radicado SET radi_cuentai = NULL WHERE radi_nume_radi = ?";
      $stmt = $db->conn->Prepare($sql);
      $db->conn->Execute($stmt, array($radi_nume));
  }
  // FIN  security/sed-7-sql-inyection

?>
