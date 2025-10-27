<?php 
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Map Usuario Acao";
echo $objApp->GerarBreadCrumb($configTitulo);
?>
<div id="kt_app_content_container" class="app-container  p-0">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title"> Formulário Map Usuario Acao</h3>
            <div class="card-toolbar">
                <a href='#index_xml.php?app_modulo=map_usuario_acao&app_comando=listar_map_usuario_acao'  class="btn btn-sm btn-light "> <i class="fas fa-arrow-circle-left"></i> Voltar para listagem</a>
            </div>
        </div>
        <div class="card-body" id="formulario_map_usuario_acao">
                <form action="#" name="frm_map_usuario_acao" id="frm_map_usuario_acao" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_usuario">Id Usuario</label>
			<input type="text" name="id_usuario"  id="id_usuario" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_usuario'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Id Usuario </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_acao">Id Acao</label>
			<input type="text" name="id_acao"  id="id_acao" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_acao'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Id Acao </small> </div>
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

<?
include_once("modulos/map_usuario_acao/template/js.frm.map_usuario_acao.php");
?>
