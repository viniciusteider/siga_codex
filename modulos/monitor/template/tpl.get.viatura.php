<?php

$objRecurso = new Recursos();
$viatura = $objRecurso->getViatura($_GET['id']);

die(json_encode($viatura));
