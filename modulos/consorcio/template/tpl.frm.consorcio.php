<?php 
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Consorcio";
echo $objApp->GerarBreadCrumb($configTitulo);
?>
<div id="kt_app_content_container" class="app-container  p-0">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title"> Formulário Consorcio</h3>
            <div class="card-toolbar">
                <a href='#index_xml.php?app_modulo=consorcio&app_comando=listar_consorcio'  class="btn btn-sm btn-light "> <i class="fas fa-arrow-circle-left"></i> Voltar para listagem</a>
            </div>
        </div>
        <div class="card-body" id="formulario_consorcio">
                <form action="#" name="frm_consorcio" id="frm_consorcio" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_consorcio">*Id Consorcio</label>
			<input type="text" name="id_consorcio"  id="id_consorcio" maxlength="" class="form-control validar-obrigatorio mask-numero" value="<?=$linha['id_consorcio'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Id Consorcio </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="nome_consorcio">Nome Consorcio</label>
			<input type="text" name="nome_consorcio"  id="nome_consorcio" maxlength="255" class="form-control  " value="<?=$linha['nome_consorcio'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Nome Consorcio </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="cnpj">Cnpj</label>
			<input type="text" name="cnpj"  id="cnpj" maxlength="20" class="form-control  " value="<?=$linha['cnpj'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Cnpj </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="endereco">Endereco</label>
			<input type="text" name="endereco"  id="endereco" maxlength="255" class="form-control  " value="<?=$linha['endereco'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Endereco </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="nr_endereco">Nr Endereco</label>
			<input type="text" name="nr_endereco"  id="nr_endereco" maxlength="" class="form-control  mask-numero" value="<?=$linha['nr_endereco'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Nr Endereco </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="latitude">Latitude</label>
			<input type="text" name="latitude"  id="latitude" maxlength="10" class="form-control  " value="<?=$linha['latitude'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Latitude </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="longitudde">Longitudde</label>
			<input type="text" name="longitudde"  id="longitudde" maxlength="10" class="form-control  " value="<?=$linha['longitudde'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Longitudde </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="site">Site</label>
			<input type="text" name="site"  id="site" maxlength="255" class="form-control  " value="<?=$linha['site'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Site </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="email">Email</label>
			<input type="text" name="email"  id="email" maxlength="255" class="form-control  " value="<?=$linha['email'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Email </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="teledne">Teledne</label>
			<input type="text" name="teledne"  id="teledne" maxlength="15" class="form-control  " value="<?=$linha['teledne'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Teledne </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="presidente">Presidente</label>
			<input type="text" name="presidente"  id="presidente" maxlength="255" class="form-control  " value="<?=$linha['presidente'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Presidente </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="status">Status</label>
			<input type="text" name="status"  id="status" maxlength="" class="form-control  mask-numero" value="<?=$linha['status'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Status </small> </div>
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
include_once("modulos/consorcio/template/js.frm.consorcio.php");
?>
