<?php 
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Pessoal";
echo $objApp->GerarBreadCrumb($configTitulo);
?>
<div id="kt_app_content_container" class="app-container  p-0">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title"> Formulário Pessoal</h3>
            <div class="card-toolbar">
                <a href='#index_xml.php?app_modulo=pessoal&app_comando=listar_pessoal'  class="btn btn-sm btn-light "> <i class="fas fa-arrow-circle-left"></i> Voltar para listagem</a>
            </div>
        </div>
        <div class="card-body" id="formulario_pessoal">
                <form action="#" name="frm_pessoal" id="frm_pessoal" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_grupo">Id Grupo</label>
			<input type="text" name="id_grupo"  id="id_grupo" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_grupo'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Id Grupo </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="nome">Nome</label>
			<input type="text" name="nome"  id="nome" maxlength="255" class="form-control  " value="<?=$linha['nome'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Nome </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="apelido">Apelido</label>
			<input type="text" name="apelido"  id="apelido" maxlength="50" class="form-control  " value="<?=$linha['apelido'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Apelido </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="nome_mae">Nome Mae</label>
			<input type="text" name="nome_mae"  id="nome_mae" maxlength="255" class="form-control  " value="<?=$linha['nome_mae'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Nome Mae </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="nome_pai">Nome Pai</label>
			<input type="text" name="nome_pai"  id="nome_pai" maxlength="255" class="form-control  " value="<?=$linha['nome_pai'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Nome Pai </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="data_nascimento">Data Nascimento</label>
			<input type="text" name="data_nascimento"  id="data_nascimento"  class="form-control  mask-date" value="<?=$linha['data_nascimento'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Data Nascimento </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="naturalidade">Naturalidade</label>
			<input type="text" name="naturalidade"  id="naturalidade" maxlength="100" class="form-control  " value="<?=$linha['naturalidade'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Naturalidade </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="rg">Rg</label>
			<input type="text" name="rg"  id="rg" maxlength="15" class="form-control  " value="<?=$linha['rg'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Rg </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="cpf">Cpf</label>
			<input type="text" name="cpf"  id="cpf" maxlength="25" class="form-control  " value="<?=$linha['cpf'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Cpf </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="pis">Pis</label>
			<input type="text" name="pis"  id="pis" maxlength="20" class="form-control  " value="<?=$linha['pis'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Pis </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="cnh">Cnh</label>
			<input type="text" name="cnh"  id="cnh" maxlength="15" class="form-control  " value="<?=$linha['cnh'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Cnh </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="categoria_cnh">Categoria Cnh</label>
			<input type="text" name="categoria_cnh"  id="categoria_cnh" maxlength="5" class="form-control  " value="<?=$linha['categoria_cnh'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Categoria Cnh </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="validade_cnh">Validade Cnh</label>
			<input type="text" name="validade_cnh"  id="validade_cnh"  class="form-control  mask-date" value="<?=$linha['validade_cnh'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Validade Cnh </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="validade_cve">Validade Cve</label>
			<input type="text" name="validade_cve"  id="validade_cve"  class="form-control  mask-date" value="<?=$linha['validade_cve'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Validade Cve </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="genero">Genero</label>
			<input type="text" name="genero"  id="genero" maxlength="10" class="form-control  " value="<?=$linha['genero'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Genero </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="tipo_sangue">Tipo Sangue</label>
			<input type="text" name="tipo_sangue"  id="tipo_sangue" maxlength="5" class="form-control  " value="<?=$linha['tipo_sangue'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Tipo Sangue </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_funcao">Id Funcao</label>
			<input type="text" name="id_funcao"  id="id_funcao" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_funcao'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Id Funcao </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="matricula_funcional">Matricula Funcional</label>
			<input type="text" name="matricula_funcional"  id="matricula_funcional" maxlength="50" class="form-control  " value="<?=$linha['matricula_funcional'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Matricula Funcional </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_endereco">Id Endereco</label>
			<input type="text" name="id_endereco"  id="id_endereco" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_endereco'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Id Endereco </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="data_inclusao">Data Inclusao</label>
			<input type="text" name="data_inclusao"  id="data_inclusao"  class="form-control  mask-date" value="<?=$linha['data_inclusao'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Data Inclusao </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="foto">Foto</label>
			<input type="text" name="foto"  id="foto" maxlength="200" class="form-control  " value="<?=$linha['foto'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Foto </small> </div>
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
                                      <label class="form-label" for="id_consorcio">Id Consorcio</label>
			<input type="text" name="id_consorcio"  id="id_consorcio" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_consorcio'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Id Consorcio </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_base">Id Base</label>
			<input type="text" name="id_base"  id="id_base" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_base'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Id Base </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="altura">Altura</label>
			<input type="text" name="altura"  id="altura"  class="form-control  " value="<?=$linha['altura'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Altura </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="peso">Peso</label>
			<input type="text" name="peso"  id="peso" maxlength="" class="form-control  mask-numero" value="<?=$linha['peso'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Peso </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_etnia">Id Etnia</label>
			<input type="text" name="id_etnia"  id="id_etnia" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_etnia'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Id Etnia </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_romaneio">Id Romaneio</label>
			<input type="text" name="id_romaneio"  id="id_romaneio" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_romaneio'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Id Romaneio </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_formacao">Id Formacao</label>
			<input type="text" name="id_formacao"  id="id_formacao" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_formacao'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Id Formacao </small> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="data_hora_cdastro">Data Hora Cdastro</label>
			<input type="text" name="data_hora_cdastro"  id="data_hora_cdastro"  class="form-control  mask-datetime" value="<?=$linha['data_hora_cdastro'];?>"/>
                                    <small class="form-text text-muted"> Preencha o campo  Data Hora Cdastro </small> </div>
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
include_once("modulos/pessoal/template/js.frm.pessoal.php");
?>
