<?php
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Cidades";
echo $objApp->GerarBreadCrumb($configTitulo);
?>
<div id="kt_app_content_container" class="app-container  p-0">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title"> Formulário Cidades</h3>
            <div class="card-toolbar">
                <a href='#index_xml.php?app_modulo=cidades&app_comando=listar_cidades'  class="btn btn-sm btn-light "> <i class="fas fa-arrow-circle-left"></i> Voltar para listagem</a>
            </div>
        </div>
        <div class="card-body" id="formulario_cidades">
            <form action="#" name="frm_cidades" id="frm_cidades" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                <div class="form-body">
                    <div class="row p-t-20">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="id_estado">Estado</label>
                                <?
                                $objEstados     = new Estados();
                                $registros = $objEstados->ComboEstados();
                                echo Componente::GerarSelectPDO("id_estado", "id_estado", "", $registros, array($linha['id_estado']), array('','Selecione um Estado'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',' data-validar="select2"');
                                ?>
                               </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="nome">*Nome</label>
                                <input type="text" name="nome"  id="nome" maxlength="80" class="form-control validar-obrigatorio " value="<?=$linha['nome'];?>"/>
                                </div>
                        </div>
                        <!--/span-->
                    </div>
            </form>

        </div>
        <div class="card-footer d-flex flex-row-reverse">
            <button type="button" class="btn btn-success ms-3" id="bt_salvar"> <i class="fas fa-check"></i> Salvar</button>
            <button type="button" class="btn btn-light " id="bt_voltar" onclick="history.back()"> <i class="fas fa-arrow-circle-left"></i> Voltar para listagem</button>
        </div>
    </div>
</div>

<?php
include_once("modulos/cidades/template/js.frm.cidades.php");
?>
