<?php
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Função";
echo $objApp->GerarBreadCrumb($configTitulo);
?>
<div id="kt_app_content_container" class="app-container  p-0">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title"> Formulário Função</h3>
            <div class="card-toolbar">
                <a href='#index_xml.php?app_modulo=funcao&app_comando=listar_funcao'  class="btn btn-sm btn-light "> <i class="fas fa-arrow-circle-left"></i> Voltar para listagem</a>
            </div>
        </div>
        <div class="card-body" id="formulario_funcao">
            <form action="#" name="frm_funcao" id="frm_funcao" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                <div class="form-body">
                    <div class="row p-t-20">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="nome">Nome</label>
                                <input type="text" name="nome"  id="nome" maxlength="50" class="form-control  " value="<?=$linha['nome'];?>"/>
                                <small class="form-text text-muted"> Preencha o campo  Nome </small> </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="descricao">Descricao</label>
                                <input type="text" name="descricao"  id="descricao" maxlength="255" class="form-control  " value="<?=$linha['descricao'];?>"/>
                                <small class="form-text text-muted"> Preencha o campo  Descricao </small> </div>
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
include_once("modulos/funcao/template/js.frm.funcao.php");
?>
