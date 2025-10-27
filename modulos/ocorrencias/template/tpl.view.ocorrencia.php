<div class="row mb-3">
    <!--begin::Label-->
    <label class="col-lg-2 fw-semibold text-muted text-md-end">Nº Ocorrência / Data Hora:</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-10">
        <span class="fw-bold fs-6 text-gray-800"><span class="badge badge-dark"><?=$linha['id']?></span></span> &nbsp; &nbsp; &nbsp;
        <span class="fw-bold fs-6 text-gray-800"><?=Conexao::PrepararDataPHP($linha['data_hora'],$_SESSION['usuario']['timezone'])?></span>
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->
<!--begin::Input group-->
<div class="row mb-3">
    <!--begin::Label-->
    <label class="col-lg-2 fw-semibold text-muted text-md-end">Endereço:</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-10 fv-row">
        <span class="fw-semibold text-gray-800 fs-6"><?=$linha['logradouro']?>, <?=$linha['numero']?>, bairro <?=$linha['bairro']?>, <?=$linha['cidade']?> - <?=$linha['estado']?></span>
    </div>
    <!--end::Col-->
</div>
<!--end::Input group-->

<!--begin::Input group-->
<div class="row mb-2">
    <!--begin::Label-->
    <label class="col-lg-2 fw-semibold text-muted text-md-end">

        Latitude/Longitude:</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-6 fv-row">
        <span class="fw-semibold text-gray-800 fs-6"><?=$linha['latitude']?>,<?=$linha['longitude']?>    <a target="_blank" href="https://maps.google.com/?q=<?=$linha['latitude'];?>,<?=$linha['longitude'];?>">  <i class="fa fa-map-marker-alt fs-1 text-danger "></i></a></span>
    </div>
    <!--end::Col-->
    <!--end::Col-->
    <label class="col-lg-2 fw-semibold text-muted text-md-end">Tipo Solicitante:</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-2">
        <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary"><?=$linha['nome_tipo_solicitante']?></a>
    </div>
    <!--end::Col-->
</div>
<!--end::Input group-->
<!--begin::Input group-->
<div class="row mb-3">
    <!--begin::Label-->
    <label class="col-lg-2 fw-semibold text-muted text-md-end">Telefone:</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-10 d-flex align-items-center">
        <span class="fw-bold fs-6 text-gray-800 me-2"><?=$linha['telefone']?></span>
        <!--            <span class="badge badge-success">Verified</span>-->
    </div>
    <!--end::Col-->
</div>
<!--end::Input group-->
<!--begin::Input group-->
<div class="row mb-3">
    <!--begin::Label-->

    <!--begin::Label-->
    <label class="col-lg-2 fw-semibold text-muted text-md-end">Solicitante:</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-2">
        <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary"><?=$linha['nome']?></a>
    </div>
    <!--end::Col-->
    <!--begin::Label-->
    <label class="col-lg-2 fw-semibold text-muted text-md-end">Atendente:</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-2">
        <span class="fw-bold fs-6 text-gray-800"><?=$linha['nome_atendente']?></span>
    </div>
    <!--end::Col-->
    <!--begin::Label-->
    <label class="col-lg-2 fw-semibold text-muted text-md-end">Regulador:</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-2">
        <span class="fw-bold fs-6 text-gray-800"><?=$linha['nome_regulador']?></span>
    </div>
    <!--end::Col-->
</div>

<div class="row mb-3">
    <!--begin::Label-->
    <label class="col-lg-2 fw-semibold text-muted text-md-end">Evento:</label>
    <!--begin::Label-->
    <!--begin::Label-->
    <div class="col-lg-2">
            <span class="fw-semibold fs-6 text-gray-800">
                <?=$linha['nome_evento']?>
            </span>
    </div>
    <label class="col-lg-2 fw-semibold text-muted text-md-end">Subevento:</label>
    <!--begin::Label-->
    <!--begin::Label-->
    <div class="col-lg-2">
            <span class="fw-semibold fs-6 text-gray-800">
                <?=$linha['nome_subevento']?>
            </span>
    </div>
    <label class="col-lg-2 fw-semibold text-muted text-md-end">Classificação:</label>
    <!--begin::Label-->
    <!--begin::Label-->
    <div class="col-lg-2">
            <span class="fw-semibold fs-6 text-gray-800">
                <?=$linha['nome_classificacao']?>
            </span>
    </div>
    <!--begin::Label-->
</div>

<div class="row mb-3">
    <!--begin::Label-->
    <label class="col-lg-2 fw-semibold text-muted text-md-end">Descritivo:</label>
    <div class="col-lg-10 fv-row">
        <span class="fw-semibold text-gray-800 fs-6"><?=$linha['descritivo']?></span>
    </div>
    <!--begin::Label-->
</div>

<h3>Recursos</h3>
<div class="row p-3">
    <div class="col-md-3 mb-3">
        <!--begin::Label-->
        <label class="col-lg-5 fw-semibold text-muted">USA</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-7">
            <span class="fw-semibold fs-6 text-gray-800">
                <?=$linha['usa']?>
            </span>
        </div>
        <!--begin::Label-->
    </div>

    <div class="col-md-3 mb-3">
        <!--begin::Label-->
        <label class="col-lg-5 fw-semibold text-muted">USB</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-7">
            <span class="fw-semibold fs-6 text-gray-800">
                <?=$linha['usb']?>
            </span>
        </div>
        <!--begin::Label-->
    </div>

    <div class="col-md-3 mb-3">
        <!--begin::Label-->
        <label class="col-lg-5 fw-semibold text-muted">Bombeiro</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-7">
            <span class="fw-semibold fs-6 text-gray-800">
                <?=$linha['siate']?>
            </span>
        </div>
        <!--begin::Label-->
    </div>

    <div class="col-md-3 mb-3">
        <!--begin::Label-->
        <label class="col-lg-5 fw-semibold text-muted">VIR</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-7">
            <span class="fw-semibold fs-6 text-gray-800">
                <?=$linha['vir']?>
            </span>
        </div>
        <!--begin::Label-->
    </div>

</div>
<div class="separator separator-dotted border-success my-5"></div>
<?php
if(is_array($linha_recursos) && count($linha_recursos) > 0)
{
    ?>
    <table border="0" cellpadding="1" cellspacing="0" style="width:100%">
        <tbody>
        <tr>
            <td colspan="9" style="background-color:#f5f5f5; text-align:center"><strong>VIATURAS E EQUIPES DESLOCADAS</strong></td>
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
    <div class="separator separator-dotted border-success my-5"></div>
    <?php
}
if(is_array($linha_Apoio) && count($linha_Apoio) > 0)
{
    foreach ($linha_Apoio as $apo)
    {
        echo '    <table border="0" cellpadding="1" cellspacing="1" style="width:100%">
                    <tbody>
                    <tr>
                        <td colspan="5" style="background-color:#f5f5f5; text-align:center"><strong>&Oacute;RG&Atilde;O DE APOIO</strong></td>
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
echo '    <div class="separator separator-dotted border-success my-5"></div>
';
if(is_array($linha_pacientes) && count($linha_pacientes) > 0)
{
?>
<table width="100%" border="0" cellpadding="1" cellspacing="1" style="width:100%">
    <tbody>
    <tr>
        <td colspan="5" style="background-color:#f5f5f5; text-align:center"><strong>V&Iacute;TIMAS ATENDIDAS</strong></td>
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
<div class="separator separator-dotted border-success my-5"></div>
<!--begin::List widget 14-->
<div class="card card-flush">
    <!--begin::Header-->
    <div class="card-header pt-5">
        <!--begin::Title-->
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-dark">Histórico</span>
            <span class="text-gray-400 pt-2 fw-semibold fs-6">Descritivos médicos</span>
        </h3>
        <!--end::Title-->
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <style>
        .timeline-label::before {
            content: "";
            position: absolute;
            left: 81px;
            width: 3px;
            top: 0;
            bottom: 0;
            background-color: var(--bs-gray-200);
        }
    </style>
    <div class="card-body pt-6">
        <!--begin::Timeline-->
        <div class="timeline-label">
            <?php
            $objHistorico = new OcorenciasHistorico();
            $objHistorico->setIdOcorrencia($linha['id']);

            $rows = $objHistorico->ListarHistoricos();
            if(is_array($rows) && count($rows) > 0)
            {
                foreach ($rows as $row) {

                    echo '
                                <!--begin::Item-->
                                <div class="timeline-item">
                                    <!--begin::Label-->
                                    <div class="timeline-label fw-bold text-gray-800 fs-8 ajuste" style="width: 80px !important">'.str_replace(" ","<br>",Conexao::PrepararDataPHP($row['data_hora_cadastro'],$_SESSION['usuario']['timezone'],'d/m/y H:i:s')).'</div>
                                    <!--end::Label-->
                                    <!--begin::Badge-->
                                    <div class="timeline-badge">
                                        <i class="ki ki-abstract-8 text-gray-600 "> </i>
                                    </div>
                                    <!--end::Badge-->
                                    <!--begin::Text-->
                                    <div class="fw-semibold text-gray-700 ps-3 fs-7">'.$row['descricao'].'</div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->';
                }
            }
            ?>
        </div>
        <!--end::Timeline-->
    </div>
    <!--end: Card Body-->
</div>
<!--end: List widget 14-->

