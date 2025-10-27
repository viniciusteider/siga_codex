<?php
switch($app_comando) {
    case "filtrar_sub_eventos":
        $sub = new Subevento();
        $listar = $sub->ListarComboSubEventosId($app_codigo);
        echo json_encode($listar);
}
