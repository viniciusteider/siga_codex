<?php

$objUltimas = new Hospital();
$listar = $objUltimas->ListarMonitoramento($_SESSION['usuario']['id_grupo']);

$hospitais = array_map(function($row) {
    // Monta o endereço completo com segurança (evita "null" aparecendo)
    $partes = array_filter([
        $row['logradouro'] ?? '',
        $row['numero'] ?? '',
        $row['complemento'] ?? '',
        $row['bairro'] ?? '',
        $row['cidade'] ?? '',
        $row['estado'] ?? ''
    ]);
    $enderecoCompleto = implode(', ', $partes);

    return [
        'id' => $row['id'],
        'nome' => $row['nome'],
        'endereco' => $enderecoCompleto,
        'complexidade' => $row['complexidade'],
        'telefone' => $row['telefone'],
        'vagas_leitos' => (int) $row['vagas_leitos'],
        'vagas_uti' => (int) $row['vagas_uti'],
        'lat' => isset($row['latitude']) ? (float) $row['latitude'] : null,
        'lng' => isset($row['longitude']) ? (float) $row['longitude'] : null
    ];
}, $listar);

die(json_encode($hospitais));
