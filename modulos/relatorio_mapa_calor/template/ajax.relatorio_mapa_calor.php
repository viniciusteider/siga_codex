<?php
$resultado = [];
switch ($app_comando) {
    case "get_cidades":
        $relatorioMapaCalor = new RelatorioMapaCalor();
        $resultado = $relatorioMapaCalor->GetCidades();
        break;
    case "get_eventos":
        $relatorioMapaCalor = new RelatorioMapaCalor();
        $resultado = $relatorioMapaCalor->GetEventos();
        break;
    case "get_subeventos":
        $relatorioMapaCalor = new RelatorioMapaCalor();
        $resultado = $relatorioMapaCalor->GetSubEventos($_GET['eventoId']);
        break;
    case "get_ocorrencias":
        $relatorioMapaCalor = new RelatorioMapaCalor();
        $resultado = $relatorioMapaCalor->GetOcorrencias($_GET['eventoId'], $_GET['subeventoId'], $_GET['cidadeId'], $_GET['dataInicio'], $_GET['dataFim']);
        break;
    case "listar_hospitais":
        $relatorioMapaCalor = new RelatorioMapaCalor();
        $resultado = $relatorioMapaCalor->GetHospitais();
        break;
    case "listar_bases":
        $relatorioMapaCalor = new RelatorioMapaCalor();
        $resultado = $relatorioMapaCalor->GetBases();
        break;
    default:
        $resultado = [];
        break;
}
echo json_encode($resultado);
