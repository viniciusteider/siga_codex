<?php
require_once __DIR__ . "/../ocorrencias/classe.ocorrencias.php";
require_once __DIR__ . "/../ocorrencias_recursos/classe.ocorrencias_recursos.php";
require_once __DIR__ . "/../ocorrencias_apoio/classe.ocorrencias_apoio.php";
require_once __DIR__ . "/../paciente/classe.paciente.php";
require_once __DIR__ . "/../ocorencias_historico/classe.ocorencias_historico.php";

switch ($app_comando) {
    case "pesquisa_ficha_ocorrencias":
        $template = "tpl.pesquisa.ficha_ocorrencias.php";
        break;
    case "ajax_pesquisa_ficha_ocorrencias":
        $template = "tpl.lis.pesquisa.ficha_ocorrencias.php";
        break;
    case "view_ficha_ocorrencia":
        $objOcorrencias = new Ocorrencias();
        $objOcorrencias->setId($_REQUEST['app_codigo']);
        $linha = $objOcorrencias->View();

        $objOcoRecursos = new OcorrenciasRecursos();
        $objOcoRecursos->setIdOcorrencia($_REQUEST['app_codigo']);
        $linha_recursos = $objOcoRecursos->View();

        $objOcoApoio = new OcorrenciasApoio();
        $objOcoApoio->setIdOcorrencia($_REQUEST['app_codigo']);
        $linha_Apoio = $objOcoApoio->View();

        $objPacientes = new Paciente();
        $objPacientes->setIdOcorrencia($_REQUEST['app_codigo']);
        $linha_pacientes = $objPacientes->View();

        $template = "tpl.view.ficha_ocorrencia.php";
        break;
    default:
        $template = "tpl.pesquisa.ficha_ocorrencias.php";
        break;
}
