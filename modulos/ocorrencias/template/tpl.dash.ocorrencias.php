<?php
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Central de Atendimento";

$adicional = '<div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Primary button-->
                <a href="#" class="btn btn-sm fw-bold btn-secondary"  onclick="UpdateListagens()">Atualizar listagem</a>
                <a href="#" class="btn btn-sm fw-bold btn-primary"  onclick="AberturaAtendimento.ModalAbertura()">Abrir Ocorrência</a>
                <!--end::Primary button-->
            </div>';

echo $objApp->GerarBreadCrumb($configTitulo,$adicional);
?>
<div id="kt_app_content_container" class="app-container mt-6 ">
    <div class="row g-5 g-xl-8">
        <!--begin::Col-->
        <div class="col-xl-6" id="div_ocorrencias_disponiveis">
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-6" id="div_ocorrencias_despachadas">
        </div>
        <!--end::Col-->
        
    </div>
    <div class="row g-5 g-xl-8">
        <!--begin::Col-->
        <div class="col-xl-6" id="div_ocorrencias_reguladas">
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-6" id="div_ocorrencias_finalizadas">
        </div>
        <!--end::Col-->
        
    </div>
</div>



<?php
include_once ("modulos/ocorrencias/template/js.dash.ocorrencias.php");
include_once ("modulos/ocorrencias/template/tpl.modals.ocorrencias.php");
include_once ("template/foot.php");



