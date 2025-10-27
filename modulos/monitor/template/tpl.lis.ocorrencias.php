<?php

$objUltimas = new Ocorrencias();
$listar = $objUltimas->ListarMonitoramento($_SESSION['usuario']['id_grupo']);

die(json_encode($listar));
