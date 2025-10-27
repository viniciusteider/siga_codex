<?php
ob_start();
?>
    <style>
        table td
        {
            font-size: 11px;
        }

    </style>
    <table width="100%" border="0" cellpadding="1" cellspacing="1" style="width:100%">
        <tr>
            <td width="40%">
                <a href="#">
                    <img alt="Logo" src="assets/media/logos/default-dark.svg" width="250"/>
                </a>
            </td>
            <td width="40%">    <p style="text-align:center"><span style="font-size:13px"><strong>&nbsp;&nbsp;ESTADO DO RONDôNIA</p>
                    <p style="text-align:center"><span style="font-size:13px"><strong>MUNICÍPIO DE JI-PARANÁ</p>
                    <p style="text-align:center"><span style="font-size:13px"><strong>&nbsp;&nbsp;&nbsp;&nbsp;SAMU DE JI-PARANÁ</p>
            </td>
            <td width="35%">
                <a href="#">
                    <img alt="Logo" src="assets/media/logos/logo_samu_jiparana.png" width="170"/>
                </a>
            </td>
        </tr>
    </table>



    <p style="text-align:center"><span style="font-size:15px"><strong>BOLETIM DE ATENDIMENTO DO SAMU</strong></span></p>

    <table width="100%" border="0" cellpadding="1" cellspacing="1" style="width:100%">
        <tbody>
        <tr>
            <td colspan="6" style="background-color:rgb(255, 204, 0); text-align:center"><strong>INFORMA&Ccedil;&Otilde;ES INICIAIS</strong></td>
        </tr>
        <tr>
            <td><strong>N&ordm; do Registro:</strong></td>
            <td><?=$linha['id'];?></td>
            <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td>
            <td><strong>Base:</strong></td>
            <td><?=$linha['nome_base'];?></td>
        </tr>
        <tr>
            <td><strong>Data / Hora:</strong></td>
            <td><?=Conexao::DataHoraGMTPHP($linha['data_hora'],$_SESSION['usuario']['timezone']);?></td>
            <td>&nbsp;</td>
            <td><strong>Nome do Solicitante:</strong></td>
            <td><?=$linha['nome'];?></td>
        </tr>
        <tr>
            <td><strong>Telefone Solicitante:</strong></td>
            <td><?=$linha['telefone'];?>  <?=$linha['celular'];?>  <?=$linha['comercial'];?></td>
            <td>&nbsp;</td>
            <td><strong>Tipo Solicitante:</strong></td>
            <td><?=$linha['nome_tipo_solicitante'];?></td>
        </tr>
        </tbody>
    </table>

    <table border="0" cellpadding="1" cellspacing="1" style="width:100%">
        <tbody>
        <tr>
            <td colspan="5" style="background-color:rgb(255, 204, 0); text-align:center"><strong>OCORR&Ecirc;NCIA</strong></td>
        </tr>
        <tr>
            <td><strong>Natureza:</strong></td>
            <td><?=$linha['nome_evento'];?></td>
            <td><strong>Subnatureza:</strong></td>
            <td><?=$linha['nome_subevento'];?></td>
        </tr>
        <tr>
            <td><strong>Descritivo:</strong></td>
            <td><?=$linha['descritivo'];?></td>
            <td><strong>Classifica&ccedil;&atilde;o:</strong></td>
            <td><?=$linha['nome_classificacao'];?></td>
        </tr>
        </tbody>
    </table>

    <table border="0" cellpadding="1" cellspacing="1" style="width:100%">
        <tbody>
        <tr>
            <td colspan="5" style="background-color:rgb(255, 204, 0); text-align:center"><strong>ENDERE&Ccedil;O</strong></td>
        </tr>
        <tr>
            <td><strong>Endere&ccedil;o:</strong></td>
            <td colspan="3" rowspan="1"><?=$linha['logradouro'];?>  <?=$linha['numero'];?> <?=$linha['bairro'];?> <?=$linha['cidade'];?> <?=$linha['estado'];?></td>
        </tr>
        <tr>
            <td><strong>Latitude:</strong></td>
            <td><?=$linha['latitude'];?></td>
            <td><strong>Longitude:</strong></td>
            <td><?=$linha['longitude'];?></td>
        </tr>
        </tbody>
    </table>

    <table border="0" cellpadding="1" cellspacing="1" style="width:100%">
        <tbody>
        <tr>
            <td colspan="3" style="background-color:rgb(255, 204, 0); text-align:center"><strong>RESPONS&Aacute;VEIS PELA OCORR&Ecirc;NCIA</strong></td>
        </tr>
        <tr>
            <td><strong>Atendente:</strong></td>
            <td align="left"><?=$linha['nome_atendente'];?></td>
        </tr>
        <tr>
            <td><strong>Radioperador:</strong></td>
            <td align="left"><?=$linha['nome_radio_operador'];?></td>
        </tr>
        <tr>
            <td><strong>M&eacute;dico Regulador:</strong></td>
            <td align="left"><?=$linha['nome_regulador'];?></td>
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
            <td colspan="9" style="background-color:rgb(255, 204, 0); text-align:center"><strong>VIATURAS E EQUIPES DESLOCADAS</strong></td>
        </tr>
        <tr>
            <td style="text-align:center"><strong>Viatura</strong></td>
            <td style="text-align:center"><strong>Equipe</strong></td>
            <td style="text-align:center"><strong>Sa&iacute;da Base</strong></td>
            <td style="text-align:center"><strong>Ch Local</strong></td>
            <td style="text-align:center"><strong>Saida Loc</strong></td>
            <td style="text-align:center"><strong>Ch Hosp</strong></td>
            <td style="text-align:center"><strong>Saida Hosp</strong></td>
            <td style="text-align:center"><strong>Ch Base</strong></td>
        </tr>
        <?php

        foreach ($linha_recursos as $rec)
        {
            echo '<tr>
                        <td>'.$rec['prefixo'].'</td>
                        <td>'.$rec['nome_equipe'].'</td>
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
                        <td colspan="5" style="background-color:rgb(255, 204, 0); text-align:center"><strong>&Oacute;RG&Atilde;O DE APOIO</strong></td>
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
if(is_array($linha_pacientes) && count($linha_pacientes) > 0)
{
    ?>
    <table width="100%" border="0" cellpadding="1" cellspacing="1" style="width:100%">
        <tbody>
        <tr>
            <td colspan="5" style="background-color:rgb(255, 204, 0); text-align:center"><strong>V&Iacute;TIMAS ATENDIDAS</strong></td>
        </tr>
        <tr>
            <td><strong>V&iacute;tima</strong></td>
            <td><strong>Destino</strong></td>
            <td><strong>Les&otilde;es</strong></td>
            <td><strong>Procedimentos</strong></td>
        </tr>
        <?php
            foreach ($linha_pacientes as $paci)
    {
        echo '  <tr>
                    <td>'.$paci['nome'].'</td>
                    <td>'.$paci['nome_hospital'].'</td>
                    <td>'.$paci['lista_lesoes'].'</td>
                    <td>'.$paci['lista_Procedimento'].'</td>
                </tr>';
    }
            echo '</tbody>
            </table>
    <p>&nbsp;</p>
        ';
}
?>

<p></p>
<hr>


    <table width="100%" border="0" cellpadding="1" cellspacing="1" style="width:100%">
        <tbody>
        <tr>
            <td>Documento emitido por: <?=$_SESSION['usuario']['nome']?> &nbsp; - <?=Conexao::PrepararDataPHP(Conexao::DataHoraGMTDB(),$_SESSION['usuario']['timezone'])?></td>
            <td align="right">
<!--                <img src="--><?//= "upload/qrcode/".$_REQUEST['app_codigo'].'qr.png'?><!--">-->
                
            </td>
        </tr>
        </tbody>
    </table>

    <p>&nbsp;</p>

<?php
include_once("MPDF6/mpdf.php");
$dados = ob_get_contents();
ob_end_clean();

//pra gerar em paisagem
$mpdf = new mPDF("utf-8", "A4");
$mpdf->WriteHTML($dados);
$mpdf->Output('Boletim-Ocorrencia-'.$linha['id'].'.pdf','I');
