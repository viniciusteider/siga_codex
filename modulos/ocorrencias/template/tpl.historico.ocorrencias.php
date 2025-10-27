<!--begin::Timeline-->
<div class="timeline-label">
    <?php
    $objHistorico = new OcorenciasHistorico();
    $objHistorico->setIdOcorrencia($_REQUEST['id']);

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