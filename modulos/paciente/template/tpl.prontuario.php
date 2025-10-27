<?php
ob_start();
$objpaciente = new Paciente();
$objpaciente->setId($_REQUEST['app_codigo']);
$linha = $objpaciente->ViewPacientes();

//Conexao::pr($linha);
//die;
$objOcorrencia = new Ocorrencias();
$objOcorrencia->setId($linha['id_ocorrencia']);
$linha_ocorrencia = $objOcorrencia->View();

$objPacienteSinais = new PacienteSinaisVitais();
$objPacienteSinais->setIdPaciente($linha['id']);
$linha_sinais = $objPacienteSinais->ListarSinaisPaciente();

//Conexao::pr($linha_sinais);
//die;

$objPacienteCirculacao= new PacienteCirculacao();
$objPacienteCirculacao->setIdPaciente($linha['id']);
$linha_circulacao = $objPacienteCirculacao->ListarCirculacaoPaciente();

$objOcoRecursos = new OcorrenciasRecursos();
$objOcoRecursos->setIdOcorrencia($linha['id_ocorrencia']);
$linha_recursos = $objOcoRecursos->View();

// buscar equipe
$pdo = new Conexao();
$stmt = $pdo->prepare("
    SELECT 
        er.id AS id_ocorrencias_recursos,
        er.id_recurso,
        ue.apelido,
        ue.rg
    FROM ocorrencias_recursos er
    INNER JOIN ocorrencias_recursos_equipe ore 
        ON ore.id_ocorrencias_recursos = er.id
    INNER JOIN usuario_efetivo ue 
        ON ue.id = ore.id_efetivo
    WHERE er.id_ocorrencia = ?
");
$stmt->execute([$linha['id_ocorrencia']]);
$linha_recursos_equipe = $stmt->fetchAll(PDO::FETCH_ASSOC);



$objPupilas= new PacientePupilas();
$objPupilas->setIdPaciente($linha['id']);
$linha_paciente_pupilas = $objPupilas->View();

$resultado_pupilas = ($linha['id_pupilas'] == 1) ? "Isocórica - " : " Anisocórica - ";

if(is_array($linha_paciente_pupilas) && count($linha_paciente_pupilas) > 0)
{
    foreach ($linha_paciente_pupilas as $linha_paciente_pupila) {
        $resultado_pupilas  .= ''.$linha_paciente_pupila['nome_pupila'].'['.$linha_paciente_pupila['direita'].']['.$linha_paciente_pupila['esquerda'].'] ';
    }
}


?>
    <style>
        table td
        {
            font-size: 11px;
        }

    </style>
    <table width="100%" border="0" cellpadding="1" cellspacing="1" style="width:100%; border-collapse: collapse;">
        <tr>
            <!-- Logo SIGA alinhado à esquerda -->
            <td style="width:20%; text-align: left;">
            <img alt="Logo SIGA" src="assets/media/logos/default-dark.svg" width="180"/>
            </td>

            <!-- Título centralizado -->
            <td style="width:60%; text-align: center; vertical-align: middle;">
            <p style="margin:0; font-size:14px; font-weight:bold;">ESTADO DO RONDÔNIA</p>
            <p style="margin:0; font-size:14px; font-weight:bold;">MUNICÍPIO DE JI-PARANÁ</p>
            <p style="margin:0; font-size:14px; font-weight:bold;">SAMU DE JI-PARANÁ</p>
            </td>

            <!-- Logo Ji-Paraná alinhado à direita -->
            <td style="width:20%; text-align: right;">
            <img alt="Logo Ji-Paraná" src="assets/media/logos/logo_samu_jiparana.png" width="140"/>
            </td>
        </tr>
    </table>


    <p style="text-align:center"><span style="font-size:18px"><strong>PRONTUÁRIO DE ATENDIMENTO DO PACIENTE</strong></span></p>

    <table border="0" cellpadding="1" cellspacing="1" style="width:100%">
        <tbody>
        <tr>
            <td colspan="6" style="background-color: rgb(221, 221, 221); text-align: center;"><strong>INFORMA&Ccedil;&Otilde;ES INICIAIS</strong></td>
        </tr>
        <tr>
            <td><strong>N&ordm; do Registro</strong></td>
            <td><?=$linha_ocorrencia['id']?></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><strong>Base</strong></td>
            <td><?=$linha_ocorrencia['nome_base']?></td>
        </tr>
        <tr>
            <td><strong>Data / Hora</strong></td>
            <td><?=Conexao::PrepararDataPHP($linha_ocorrencia['data_hora'],$_SESSION['usuario']['timezone'])?></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><strong>Nome do Solicitante</strong></td>
            <td><?=$linha_ocorrencia['nome']?></td>
        </tr>
        <tr>
            <td><strong>Telefone Solicitante</strong></td>
            <td><?=$linha_ocorrencia['telefone']?></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><strong>Tipo Solicitante</strong></td>
            <td><?=$linha_ocorrencia['nome_tipo_solicitante']?></td>
        </tr>
        </tbody>
    </table>

    <table border="0" cellpadding="1" cellspacing="1" style="width:100%">
        <tbody>
        <tr>
            <td colspan="5" style="background-color: rgb(204, 204, 204); text-align: center;"><strong>OCORR&Ecirc;NCIA</strong></td>
        </tr>
        <tr>
            <td><strong>Natureza</strong></td>
            <td><?=$linha_ocorrencia['nome_evento']?></td>
            <td><strong>Subnatureza</strong></td>
            <td><?=$linha_ocorrencia['nome_subevento']?></td>
        </tr>
        <tr>
            <td><strong>Descritivo</strong></td>
            <td><?=nl2br($linha_ocorrencia['descritivo'])?></td>
            <td><strong>Classifica&ccedil;&atilde;o</strong></td>
            <td><?=$linha_ocorrencia['nome_classificacao']?></td>
        </tr>
        </tbody>
    </table>

    <table border="0" cellpadding="1" cellspacing="1" style="width:100%">
        <tbody>
        <tr>
            <td colspan="5" style="background-color: rgb(221, 221, 221); text-align: center;"><strong>ENDERE&Ccedil;O</strong></td>
        </tr>
        <tr>
            <td><strong>Endere&ccedil;o</strong></td>
            <td colspan="3" rowspan="1"><?=$linha_ocorrencia['logradouro']?>, <?=$linha_ocorrencia['numero']?>, <?=$linha_ocorrencia['bairro']?>, <?=$linha_ocorrencia['cidade']?>, <?=$linha_ocorrencia['estado']?></td>
        </tr>
        <tr>
            <td><strong>Latitude</strong></td>
            <td><?=$linha_ocorrencia['latitude']?></td>
            <td><strong>Longitude</strong></td>
            <td><?=$linha_ocorrencia['longitude']?></td>
        </tr>
        </tbody>
    </table>

    <table border="0" cellpadding="3" cellspacing="1" style="width:100%">
        <tbody>
            <tr>
            <td colspan="2" style="background-color: rgb(221, 221, 221); text-align: center;">
                <strong>RESPONSÁVEIS PELA OCORRÊNCIA</strong>
            </td>
            </tr>
            <tr>
            <td style="width: 20%; text-align: left;"><strong>Atendente</strong></td>
            <td style="text-align: left;"><?=$linha_ocorrencia['nome_atendente']?></td>
            </tr>
            <tr>
            <td style="width: 20%; text-align: left;"><strong>Radioperador</strong></td>
            <td style="text-align: left;"><?=$linha_ocorrencia['nome_radio_operador']?></td>
            </tr>
            <tr>
            <td style="width: 20%; text-align: left;"><strong>Médico Regulador</strong></td>
            <td style="text-align: left;"><?=$linha_ocorrencia['nome_regulador']?></td>
            </tr>
        </tbody>
    </table>

<?php
if(is_array($linha_recursos) && count($linha_recursos) > 0)
{
    ?>
    <table border="1" cellpadding="1" cellspacing="0" style="width:100%">
        <tbody>
        <tr>
            <td colspan="9" style="background-color:rgb(221, 221, 221); text-align:center"><strong>VIATURAS E EQUIPES DESLOCADAS</strong></td>
        </tr>
        <tr>
            <td style="text-align:center"><strong>Viatura</strong></td>
            <td style="text-align:center"><strong>Equipe</strong></td>
            <td style="text-align:center"><strong>Saída Base</strong></td>
            <td style="text-align:center"><strong>Ch Local</strong></td>
            <td style="text-align:center"><strong>Saída Loc</strong></td>
            <td style="text-align:center"><strong>Ch Hosp</strong></td>
            <td style="text-align:center"><strong>Saída Hosp</strong></td>
            <td style="text-align:center"><strong>Ch Base</strong></td>
        </tr>
        <?php

        foreach ($linha_recursos as $rec) {
            $equipe_texto = '';
            foreach ($linha_recursos_equipe as $rec_equipe) {
                // compara pelo id_ocorrencias_recursos (er.id)
                if ($rec_equipe['id_ocorrencias_recursos'] == $rec['id']) {
                    $equipe_texto .= $rec_equipe['apelido'] . ' (RG: ' . $rec_equipe['rg'] . '), ';
                }
            }
            $equipe_texto = rtrim($equipe_texto, ', ');
            if ($equipe_texto === '') {
                $equipe_texto = '—'; // mostra um traço se não tiver equipe
            }

            echo '<tr>
                    <td>'.$rec['prefixo'].'</td>
                    <td>'.$equipe_texto.'</td>
                    <td>'.Conexao::PrepararDataPHP($rec['horario_saida_base'],$_SESSION['usuario']['timezone'],'d/m/y H:i').'</td>
                    <td>'.Conexao::PrepararDataPHP($rec['horario_chegada_local'],$_SESSION['usuario']['timezone'],'d/m/y H:i').'</td>
                    <td>'.Conexao::PrepararDataPHP($rec['horario_saida_local'],$_SESSION['usuario']['timezone'],'d/m/y H:i').'</td>
                    <td>'.Conexao::PrepararDataPHP($rec['horario_chegada_hospital'],$_SESSION['usuario']['timezone'],'d/m/y H:i').'</td>
                    <td>'.Conexao::PrepararDataPHP($rec['horario_saida_hospital'],$_SESSION['usuario']['timezone'],'d/m/y H:i').'</td>
                    <td>'.Conexao::PrepararDataPHP($rec['horario_chegada_base'],$_SESSION['usuario']['timezone'],'d/m/y H:i').'</td>
                </tr>';
        }

        ?>

        </tbody>
    </table>
    <?php
}

if(is_array($linha_Apoio) && count($linha_Apoio) > 0)
{
    foreach ($linha_Apoio as $apo)
    {
        echo '    <table border="0" cellpadding="1" cellspacing="1" style="width:100%">
                    <tbody>
                    <tr>
                        <td colspan="5" style="background-color:rgb(221, 221, 221); text-align:center"><strong>&Oacute;RG&Atilde;O DE APOIO</strong></td>
                    </tr>
                    <tr>
                        <td><strong>&Oacute;rg&atilde;o:</strong></td>
                        <td>'.$apo['nome_orgao'].'</td>
                        <td><strong>Respons&aacute;vel:</strong></td>
                        <td>'.$apo['responsavel_apoio'].'</td>
                    </tr>
                    <tr>
                        <td><strong>Sv Realizado:</strong></td>
                        <td>'.$apo['solicitacao'].'</td>
                        <td><strong>Vtrs/Pessoas:</strong></td>
                        <td>'.$apo['total_veiculos'].' vrts / '.$apo['total_pessoas'].' pessoas</td>
                    </tr>
                    </tbody>
                </table>';
    }
}
$sexo = ($linha['sexo'] == "M") ? 'Masculino':'Feminino';
    echo '  <table border="1" cellpadding="1" cellspacing="1" style="width:100%">
        <tbody>
        <tr>
            <td colspan="9" style="background-color: rgb(221, 221, 221); text-align: center;"><strong>DADOS DO PACIENTE ATENDIDO</strong></td>
        </tr> 
        <tr>
            <td><strong>Identificação</strong></td>
            <td colspan="7" rowspan="1" >'.$linha['nome'].', Gênero '.$sexo.' , '.$linha['idade'].' anos, RG ' .$linha['rg'].' / CPF '.$linha['cpf'].' </td>
        </tr>
        
        <tr>
            <td><strong>Endere&ccedil;o</strong></td>
            <td colspan="7" rowspan="1">'.$linha['logradouro'].' '.$linha['numero'].' '.$linha['bairro'].' '.$linha['nome_cidade'].' '.$linha['nome_estado'].'</td>
        </tr>
        <tr>
            <td><strong>F. Resp. (MRPM)</strong></td>
            <td>'.$linha_sinais['frequencia_respiratoria'].'</td>
            <td><strong>F. Cardiaca (BPM)</strong></td>
            <td>'.$linha_sinais['frequencia_cardiaca'].'</td>
            <td><strong>P.A (mmHg)</strong></td>
            <td>&nbsp;'.$linha_sinais['pressao_arterial_maxima'].'/'.$linha_sinais['pressao_arterial_minima'].'</td>
            <td><strong>SA 02 (%)</strong></td>
            <td>'.$linha_sinais['saturacao_o2'].'</td>
        </tr>
        <tr>
            <td><strong>Temperatura (&ordm; C)</strong></td>
            <td>'.$linha_sinais['temperatura'].'</td>
            <td><strong>HGT</strong></td>
            <td>'.$linha_sinais['hgt'].'</td>
            <td><strong>E. Glasgow</strong></td>
            <td colspan="3" rowspan="1">'.$linha_sinais['escala_trauma'].'</td>
        </tr>
        <tr>
            <td><strong>VA Superiores</strong></td>
            <td>'.$linha['nome_vias_aereas'].'</td>
            <td><strong>Respira&ccedil;&atilde;o</strong></td>
            <td>'.$linha['nome_respiracao'].'</td>
            <td><strong>Pupilas</strong></td>
            <td colspan="3" rowspan="1">'.$resultado_pupilas.'</td>
        </tr>
        <tr>
            <td><strong>Pele</strong></td>
            <td>'.$linha_circulacao['Pele'].'</td>
            <td><strong>Pulso</strong></td>
            <td>'.$linha_circulacao['Pulso'].'</td>
            <td><strong>Perfus&atilde;o</strong></td>
            <td colspan="3" rowspan="1">'.$linha_circulacao['Perfusão periférica'].'</td>
        </tr>
        <tr>
            <td><strong>Principais Les&otilde;es</strong></td>
            <td colspan="7" rowspan="1">'.$linha['lista_lesoes'].'</td>
        </tr>
        <tr>
            <td><strong>Padr&otilde;es</strong></td>
            <td colspan="7" rowspan="1">'.$linha['lista_padroes'].'</td>
        </tr>
        <tr>
            <td><strong>Sondagens</strong></td>
            <td colspan="7" rowspan="1">'.$linha['lista_sondagens'].'</td>
        </tr>
        <tr>
            <td><strong>Curativos</strong></td>
            <td colspan="7" rowspan="1">'.$linha['lista_curativos'].'</td>
        </tr>
        <tr>
            <td><strong>Imobiliza&ccedil;&otilde;es</strong></td>
            <td colspan="7" rowspan="1">'.$linha['lista_imobilizacoes'].'</td>
        </tr>
        <tr>
            <td><strong>Medicamentos</strong></td>
            <td colspan="7" rowspan="1">'.$linha['lista_medicamentos'].'</td>
        </tr>
        </tbody>
    </table>
';
include_once("classes/phpqrcode/qrlib.php");
QRcode::png('http://siga192.com.br:8090/index.php?app_modulo=prontuario&id_paciente='.md5($linha['id']), "upload/qrpaciente/".$linha['id'].'qr.png');
?>
    
    <table border="0" cellpadding="1" cellspacing="1" style="width:100%">
        <tbody>
        <tr>
            <td colspan="3" style="background-color:rgb(221, 221, 221); text-align:center"><strong>OBSERVAÇÕES SOBRE ATENDIMENTO AO PACIENTE E ENTREGA NA UNIDADE DE SAÚDE</strong></td>
        </tr>
        <tr>
            <td><?=$linha['observacao']?></td>
        </tr>        
        </tbody>
    </table>

    <table border="0" cellpadding="1" cellspacing="1" style="width:100%">
        <tbody>
        <tr>
            <td colspan="3" style="background-color:rgb(221, 221, 221); text-align:center"><strong>ENTREGUE A</strong></td>
        </tr>
        <tr>
            <td><strong>Unidade de Sa&uacute;de</strong></td>
            <td><?=$linha['nome_hospital']?> - Recebido em:<?=$linha['data_recebimento']?></td>
        </tr>
        <tr>
            <td><strong>Respons&aacute;vel por receber</strong></td>
            <td><?=$linha['profissional']?></td>
        </tr>
        </tbody>
    </table>

    <table border="0" cellpadding="1" cellspacing="1" style="width:100%">
        <tbody>
        <tr>
            <td>Documento emitido por: <?=$_SESSION['usuario']['nome']?> - <?=date('d/m/Y H:i:s')?>&nbsp;</td>
            <td align="right">
                <img src="upload/qrpaciente/<?=$linha['id']?>qr.png">
            </td>
        </tr>
        </tbody>
    </table>


<?php
include_once("MPDF6/mpdf.php");
$dados = ob_get_contents();
ob_end_clean();
//pra gerar em paisagem
$mpdf = new mPDF("utf-8", "A4");
$mpdf->WriteHTML($dados);
//$mpdf->Output();
$mpdf->Output('Prontuario-'.$linha['id'].'.pdf','I');
