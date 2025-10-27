<?php
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Almoxarifado Requisição";
echo $objApp->GerarBreadCrumb($configTitulo);
?>
<form action="#" name="frm_almoxarifado_requisicao" id="frm_almoxarifado_requisicao" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div id="kt_app_content_container" class="app-container  p-0">
        <div class="row gx-5 gx-xl-10">
            <div class="col-xxl-12 mb-5 mb-xl-10">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title"> Formulário Almoxarifado Requisição</h3>
                        <div class="card-toolbar">
                            <a href='javascript:;'  class="btn btn-sm btn-light " onclick="history.back()"> <i class="fas fa-arrow-circle-left"></i> Voltar para listagem</a>
                        </div>
                    </div>
                    <div class="card-body" id="formulario_almoxarifado_requisicao">
                        <?php include_once("modulos/almoxarifado_requisicao/template/tpl.form.almoxarifado_requisicao.php");?>

                    </div>
                </div>
            </div>
        </div>


        <div class="row gx-5 gx-xl-10">
            <div class="col-xxl-12 mb-5 mb-xl-10">
                <div class="card shadow-sm card-flush">
                    <div class="card-header">
                        <h3 class="card-title"> Produtos da Requisição</h3>
                    </div>
                    <div class="card-body" id="formulario_almoxarifado_entradas_itens">

                        <!--begin::Alert-->
                        <div class="alert alert-dismissible bg-light-primary d-flex flex-column flex-sm-row p-5 mb-10">
                            <!--begin::Icon-->
                            <i class="ki-duotone ki-notification-bing fs-2hx text-primary me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                            <!--end::Icon-->

                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                <!--begin::Title-->
                                <h4 class="fw-semibold">Atenção</h4>
                                <!--end::Title-->

                                <!--begin::Content-->
                                <span>Se no item for definido data de retorno, será colocado como cautela para o solicitante.</span>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Close-->
                            <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                                <i class="ki-duotone ki-cross fs-1 text-primary"><span class="path1"></span><span class="path2"></span></i>
                            </button>
                            <!--end::Close-->
                        </div>
                        <!--end::Alert-->



                        <?php include_once("modulos/almoxarifado_requisicao/template/tpl.form.requisicao_itens.php");?>

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
include_once("modulos/almoxarifado_requisicao/template/js.frm.almoxarifado_requisicao.php");
?>
