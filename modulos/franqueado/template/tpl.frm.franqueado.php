<?php
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Corporações";
echo $objApp->GerarBreadCrumb($configTitulo);
?>
<div id="kt_app_content_container" class="app-container  p-0">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title"> Formulário Corporações</h3>
            <div class="card-toolbar">
                <a href='#index_xml.php?app_modulo=franqueado&app_comando=listar_franqueado'  class="btn btn-sm btn-light "> <i class="fas fa-arrow-circle-left"></i> Voltar para listagem</a>
            </div>
        </div>
        <div class="card-body" id="formulario_franqueado">
            <form action="#" name="frm_franqueado" id="frm_franqueado" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                <input type="hidden" name="id_endereco"  id="id_endereco"   value="<?=$linha['id_endereco'];?>"/>
                <input type="hidden" name="latitude"  id="latitude"   value="<?=$linha['latitude'];?>"/>
                <input type="hidden" name="longitude"  id="longitude"   value="<?=$linha['longitude'];?>"/>
                <div class="form-body">
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x  fs-5 fw-bold">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">
                                <i class="ki-duotone ki-user-edit fs-3">
                                    <i class="path1"></i>
                                    <i class="path2"></i>
                                    <i class="path3"></i>
                                </i>&nbsp;  Pessoal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_2">
                                <i class="ki-duotone ki-geolocation fs-3">
                                    <i class="path1"></i>
                                    <i class="path2"></i>
                                    <i class="path3"></i>
                                </i>&nbsp; Endereco</a>
                        </li>
                    </ul>

                    <div class="tab-content mt-6" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                            <div class="row p-t-20">
                                <div class="col-md-5 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="nome">Nome</label>
                                        <input type="text" name="nome"  id="nome" maxlength="100" class="form-control validar-obrigatorio " value="<?=$linha['nome'];?>"/>
                                        <small class="form-text text-muted"> Preencha o campo  Nome </small> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="codigo">Código</label>
                                        <input type="text" name="codigo"  id="codigo" maxlength="10" class="form-control validar-obrigatorio " value="<?=$linha['codigo'];?>"/>
                                        <small class="form-text text-muted"> Ex: PR-001 </small> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="cnpj">*Cnpj</label>
                                        <input type="text" name="cnpj"  id="cnpj" maxlength="20" class="form-control validar-obrigatorio mask-cnpj " value="<?=$linha['cnpj'];?>"/>
                                        <small class="form-text text-muted"> Preencha o campo  Cnpj </small> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="inscricao_estadual">Inscricao Estadual</label>
                                        <input type="text" name="inscricao_estadual"  id="inscricao_estadual" maxlength="20" class="form-control  " value="<?=$linha['inscricao_estadual'];?>"/>
                                        <small class="form-text text-muted"> Preencha o campo  Inscricao Estadual </small> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="responsavel">* Responsável</label>
                                        <input type="text" name="responsavel"  id="responsavel" maxlength="100" class="form-control validar-obrigatorio " value="<?=$linha['responsavel'];?>"/>
                                        <small class="form-text text-muted"> Preencha o campo  Responsavel </small> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="cpf_responsavel">CPF Responsável</label>
                                        <input type="text" name="cpf_responsavel"  id="cpf_responsavel" maxlength="14" class="form-control mask-cpf " value="<?=$linha['cpf_responsavel'];?>"/>
                                        <small class="form-text text-muted"> Preencha o campo  Cpf Responsavel </small> </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade show " id="kt_tab_pane_2" role="tabpanel">
                            <div class="row p-t-20">
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label class="form-label" for="logradouro">Logradouro</label>
                                        <input type="text" name="logradouro"  id="logradouro" maxlength="255" class="form-control  " value="<?=$linha['logradouro'];?>"/>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2 mb-4">
                                    <div class="form-group">
                                        <label class="form-label" for="numero">Numero</label>
                                        <input type="text" name="numero"  id="numero" maxlength="10" class="form-control  " value="<?=$linha['numero'];?>"/>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <label class="form-label" for="complemento">Complemento</label>
                                        <input type="text" name="complemento"  id="complemento" maxlength="50" class="form-control  " value="<?=$linha['complemento'];?>"/>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <label class="form-label" for="bairro">Bairro</label>
                                        <input type="text" name="bairro"  id="bairro" maxlength="255" class="form-control  " value="<?=$linha['bairro'];?>"/>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <label class="form-label" for="estado">Estado</label>
                                        <?php
                                        $objEstados     = new Estados();
                                        $registros = $objEstados->ComboEstados();
                                        $onchange = ' onchange="Squall.ListarSelect2(\'index_xml.php?app_modulo=cidades&app_comando=filtrar_cidade&app_codigo=\',\'#id_cidade\',this.value)"';
                                        echo Componente::GerarSelectPDO("id_estado", "id_estado", "", $registros, array($linha['id_estado']), array('','Selecione um Estado'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',' data-validar="select2" '.$onchange);
                                        ?>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <label class="form-label" for="cidade">Cidade</label>
                                        <?php
                                        $cidade = new Cidades();
                                        $cidade->setIdEstado($linha['id_estado']);
                                        $registros = $cidade->ComboCidade();
                                        echo Componente::GerarSelectPDO("id_cidade","id_cidade","",$registros,array($linha['id_cidade']),Array("","-- Selecione uma Cidade --"),Array("id", "nome"),false, "form-select  m-b-20 m-r-10 ",' data-validar="select2"');
                                        ?>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3 mb-4">
                                    <label class="form-label" for="cep">Cep</label>
                                    <div class="input-group"   >
                                        <input type="text" name="cep"  id="cep" onblur="Squall.BuscarCep(this.value)"  class="form-control  mask-cep" value="<?=$linha['cep'];?>"/>
                                        <span class="input-group-text" >
                                    <i class="fas fa-search"></i>
                                </span>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label class="form-label" for="referencia">Referencia</label>
                                        <input type="text" name="referencia"  id="referencia"  maxlength="255"  class="form-control  " value="<?=$linha['referencia'];?>"/>
                                    </div>
                                </div>
                                <!--/span-->

                                <div class="col-md-3 mb-4">
                                    <label class="form-label" for="telefone">Telefone</label>
                                    <div class="input-group"   >
                                        <input type="text" name="telefone"  id="telefone"  class="form-control  " value="<?=$linha['telefone'];?>"/>
                                        <span class="input-group-text" >
                                    <i class="fas fa-phone"></i>
                                </span>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3 mb-4">
                                    <label class="form-label" for="cep">Comercial</label>
                                    <div class="input-group"   >
                                        <input type="text" name="comercial"  id="comercial"  class="form-control  " value="<?=$linha['comercial'];?>"/>
                                        <span class="input-group-text" >
                                    <i class="fas fa-phone"></i>
                                </span>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3 mb-4">
                                    <label class="form-label" for="celular">Celular</label>
                                    <div class="input-group"   >
                                        <input type="text" name="celular"  id="celular"  class="form-control  validar-obrigatorio " value="<?=$linha['celular'];?>"/>
                                        <span class="input-group-text" >
                                    <i class="fas fa-mobile"></i>
                                </span>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label class="form-label" for="email_mkt">Email 2</label>
                                        <input type="text" name="email_mkt"  id="email_mkt" maxlength="150" class="form-control  " value="<?=$linha['email_mkt'];?>"/>

                                    </div>
                                </div>

                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label class="form-label" for="observacao">Observação de endereço</label>
                                        <textarea class="form-control  " name="observacao" rows="7"  id="observacao" placeholder="Insira o texto" ><?=$linha['observacao'];?></textarea>

                                    </div>
                                </div>
                                <!--/span-->
                                <!--/span-->
                            </div>
                        </div>
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
include_once("modulos/franqueado/template/js.frm.franqueado.php");
?>
