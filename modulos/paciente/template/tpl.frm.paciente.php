<?php
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Paciente";
echo $objApp->GerarBreadCrumb($configTitulo);
?>
<?php include_once("modulos/paciente/template/tpl.frm.tab.paciente.php");?>
<!--<div id="kt_app_content_container" class="app-container  p-0">-->
<!--    <div class="card shadow-sm">-->
<!--        <div class="card-header">-->
<!--            <h3 class="card-title"> Formulário Paciente</h3>-->
<!--            <div class="card-toolbar">-->
<!--                <a href='javascript:;'  class="btn btn-sm btn-light " onclick="history.back()"> <i class="fas fa-arrow-circle-left"></i> Voltar para listagem</a>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="card-body" id="formulario_paciente">-->
<!--         -->
<!--        </div>-->
<!--        <div class="card-footer d-flex flex-row-reverse">-->
<!--            <button type="button" class="btn btn-success ms-3" id="bt_modal_salvar_paciente"> <i class="fas fa-check"></i> Salvar</button>-->
<!--            <button type="button" class="btn btn-light " id="bt_voltar" onclick="history.back()"> <i class="fas fa-arrow-circle-left"></i> Voltar para listagem</button>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->




<?php
include_once("modulos/paciente/template/js.frm.paciente.php");
?>
