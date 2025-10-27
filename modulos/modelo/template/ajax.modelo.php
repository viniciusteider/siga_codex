<?php
switch($app_comando) {
	case "filtrar_modelos":
        $modelo = new Modelo();
        $listar = $modelo->ListarComboModelosMarca($app_codigo);
        echo json_encode($listar);
        break;
		break;
}
