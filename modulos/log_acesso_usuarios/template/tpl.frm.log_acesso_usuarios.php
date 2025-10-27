<?php 
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Log Acesso Usuarios";
echo $objApp->GerarBreadCrumb($configTitulo);
?>
<div id="kt_app_content_container" class="app-container  p-0">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title"> Formulário Log Acesso Usuarios</h3>
            <div class="card-toolbar">
                <a href='#index_xml.php?app_modulo=log_acesso_usuarios&app_comando=listar_log_acesso_usuarios'  class="btn btn-sm btn-light "> <i class="fas fa-arrow-circle-left"></i> Voltar para listagem</a>
            </div>
        </div>
        <div class="card-body" id="formulario_log_acesso_usuarios">
                <form action="#" name="frm_log_acesso_usuarios" id="frm_log_acesso_usuarios" method="post">
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
                                      <label class="form-label" for="nome_usuario">Nome Usuario</label>
			<input type="text" name="nome_usuario"  id="nome_usuario" maxlength="45" class="form-control  " value="<?=$linha['nome_usuario'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Nome Usuario </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="pagina">Pagina</label>
			<textarea class="form-control  " name="pagina"  id="pagina" placeholder="Insira o texto" ><?=$linha['pagina'];?></textarea>
                                    <small class="form-text text-muted"> Preencha o campo  Pagina </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="ip">Ip</label>
			<input type="text" name="ip"  id="ip" maxlength="45" class="form-control  " value="<?=$linha['ip'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Ip </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="dados">Dados</label>
			<textarea class="form-control  " name="dados"  id="dados" placeholder="Insira o texto" ><?=$linha['dados'];?></textarea>
                                    <small class="form-text text-muted"> Preencha o campo  Dados </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="data_hora">*Data Hora</label>
			<input type="text" name="data_hora"  id="data_hora"  class="form-control validar-obrigatorio mask-datetime" value="<?=$linha['data_hora'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Data Hora </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="aplicativo">Aplicativo</label>
			<input type="text" name="aplicativo"  id="aplicativo" maxlength="" class="form-control  mask-numero" value="<?=$linha['aplicativo'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Aplicativo </small> </div>
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
include_once("modulos/log_acesso_usuarios/template/js.frm.log_acesso_usuarios.php");
?>
