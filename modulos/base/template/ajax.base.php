<?php
switch($app_comando) {
	case "listar_bases_auto_complete":
        $objbase = new Base();
        $busca = $_REQUEST['term']?:$_REQUEST['buscar']?:$_REQUEST['busca'];
        $id_grupo = $_SESSION['usuario']['id_grupo'];
        echo json_encode($objbase->BuscarBases($id_grupo,$busca));
		break;
}
