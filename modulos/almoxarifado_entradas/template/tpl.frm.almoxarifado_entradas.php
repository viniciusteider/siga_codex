<?php
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Almoxarifado Entradas";
echo $objApp->GerarBreadCrumb($configTitulo);
?>
<form action="#" name="frm_almoxarifado_entradas" id="frm_almoxarifado_entradas" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
<div id="kt_app_content_container" class="app-container ">
    <div class="row gx-5 gx-xl-10">
        <div class="col-xxl-12 mb-5 mb-xl-10">
            <div class="card shadow-sm  card-flush ">
                <div class="card-header">
                    <h3 class="card-title"> Formulário Almoxarifado Entradas</h3>
                    <div class="card-toolbar">
                        <a href='javascript:;'  class="btn btn-sm btn-light " onclick="history.back()"> <i class="fas fa-arrow-circle-left"></i> Voltar para listagem</a>
                    </div>
                </div>
                <div class="card-body" id="formulario_almoxarifado_entradas">
                    <?php include_once("modulos/almoxarifado_entradas/template/tpl.form.almoxarifado_entradas.php");?>

                </div>
            </div>
        </div>
    </div>
    <div class="row gx-5 gx-xl-10">
        <div class="col-xxl-12 mb-5 mb-xl-10">
            <div class="card shadow-sm card-flush">
                <div class="card-header">
                    <h3 class="card-title"> Itens da Nota</h3>
                </div>
                <div class="card-body" id="formulario_almoxarifado_entradas_itens">
                    <?php include_once("modulos/almoxarifado_entradas_itens/template/tpl.form.almoxarifado_entradas_itens.php");?>

                </div>
                <div class="card-footer d-flex flex-row-reverse">
                    <button type="button" class="btn btn-success ms-3" id="bt_salvar"> <i class="fas fa-check"></i> Salvar</button>
                    <button type="button" class="btn btn-light " id="bt_voltar" onclick="history.back()"> <i class="fas fa-arrow-circle-left"></i> Voltar para listagem</button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

<?php
include_once("modulos/almoxarifado_entradas/template/js.frm.almoxarifado_entradas.php");
?>
