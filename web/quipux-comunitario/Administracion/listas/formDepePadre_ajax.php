<?php
/**  Programa para el manejo de gestion documental, oficios, memorandus, circulares, acuerdos
*    Desarrollado y en otros Modificado por la SubSecretaría de Informática del Ecuador
*    Quipux    www.gestiondocumental.gov.ec
*------------------------------------------------------------------------------
*    This program is free software: you can redistribute it and/or modify
*    it under the terms of the GNU Affero General Public License as
*    published by the Free Software Foundation, either version 3 of the
*    License, or (at your option) any later version.
*    This program is distributed in the hope that it will be useful,
*    but WITHOUT ANY WARRANTY; without even the implied warranty of
*    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*    GNU Affero General Public License for more details.
*
*    You should have received a copy of the GNU Affero General Public License
*    along with this program.  If not, see http://www.gnu.org/licenses.
*------------------------------------------------------------------------------
**/
    session_start();
    $ruta_raiz = "../..";
    include_once "$ruta_raiz/rec_session.php";

    //INICIO security/sed-6-sql-inyection

    if (!empty($_GET["codInst"])) {
    $sqlDepePadre = "SELECT
                        depe_codi,
                        depe_nomb,
                        depe_codi_padre
                    FROM
                        dependencia
                    WHERE
                        depe_estado = 1
                        AND inst_codi = ?
                        AND depe_codi = COALESCE(depe_codi_padre, depe_codi)
                    ORDER BY depe_nomb";

    $stmtPadre = $db->conn->Prepare($sqlDepePadre);
    $rsDepePadre = $db->conn->Execute($stmtPadre, array($_GET["codInst"]));

    // $menu_depePadre = "<ul>";

    while (!$rsDepePadre->EOF) {
        $depeCodi = $rsDepePadre->fields["DEPE_CODI"];
        $depeNomb = $rsDepePadre->fields["DEPE_NOMB"];

        // Consulta parametrizada para contar hijos
        $sqlDepeHijo = "SELECT COUNT(depe_codi) AS depe_codi
                        FROM dependencia
                        WHERE depe_estado = 1
                          AND depe_codi_padre = ?
                          AND depe_codi <> depe_codi_padre";

        $stmtHijo = $db->conn->Prepare($sqlDepeHijo);
        $rsDepeHijo = $db->conn->Execute($stmtHijo, array($depeCodi));

        $menu_depePadre .= '<li><a href="javascript:;" onclick="buscar_depeHijo(' . $depeCodi . ');">';
        $menu_depePadre .= $depeNomb;

        if ($rsDepeHijo->fields["DEPE_CODI"] != '0') {
            $menu_depePadre .= " (" . $rsDepeHijo->fields["DEPE_CODI"] . ")";
        }

        $menu_depePadre .= "</a>";

        if ($rsDepeHijo->fields["DEPE_CODI"] != '0') {
            $menu_depePadre .= "<ul id='mnu_depeHijo_" . $depeCodi . "' class='menu'></ul>";
        }

        $menu_depePadre .= "</li>";

        $rsDepePadre->MoveNext();
    }

    // $menu_depePadre .= "</ul>";
    echo $menu_depePadre;
    //FIN security/sed-6-sql-inyection
}

?>

