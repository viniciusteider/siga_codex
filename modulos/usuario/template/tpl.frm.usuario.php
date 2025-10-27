<?php
if ($linha['id_usuario'] != "") {$_SESSION['id_usuario_temp'] = $linha['id_usuario'];}


$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Cadastro";
$configTitulo['titulo_modulo'] = $titulo_retorno;
echo $objApp->GerarBreadCrumb($configTitulo);

echo '<script> var id_usuario_edit = "'.$linha['id_usuario'].'"; </script>'

?>
    <!--begin::Image input placeholder-->
    <style>
        .image-input-placeholder {
            background-image: url('assets/media/svg/avatars/blank.svg');
        }

        [data-bs-theme="dark"] .image-input-placeholder {
            background-image: url('assets/media/svg/avatars/blank-dark.svg');
        }
    </style>
    <!--end::Image input placeholder-->
    <div id="kt_app_content_container" class="app-container  p-0">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title"> <?=$titulo_retorno?></h3>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-sm btn-light ms-3" id="bt_voltar" onclick="history.back()"> <i class="fas fa-arrow-left"></i> Voltar para listagem</button>
                </div>
            </div>
            <div class="card-body" id="formulario_modulos">
                <form action="#" name="frm_usuario" id="frm_usuario" method="post">
                    <input type="password" style="display: none" name="numimporta" id="numimporta">
                    <input type="hidden" value="<?=$linha['id_usuario'];?>" name="id_usuario" id="id_usuario"/>
                    <input type="hidden" value="<?=$linha['id_endereco'];?>" name="id_endereco" id="id_endereco"/>
                    <input type="hidden" value="<?=$linha['id_usuario_efetivo'];?>" name="id_usuario_efetivo" id="id_usuario_efetivo"/>
                    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <input type="hidden" name="latitude"  id="latitude"   value="<?=$linha['latitude'];?>"/>
                    <input type="hidden" name="longitude"  id="longitude"   value="<?=$linha['longitude'];?>"/>

                    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x  mb-5 fs-6">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">
                                <i class="ki-duotone ki-lock fs-3">
                                    <i class="path1"></i>
                                    <i class="path2"></i>
                                    <i class="path3"></i>
                                </i>&nbsp;
                                Acesso</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_2"><i class="fa fa-home"></i> Endereço</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_3">
                                <i class="ki-duotone ki-user-edit fs-3">
                                    <i class="path1"></i>
                                    <i class="path2"></i>
                                    <i class="path3"></i>
                                </i>&nbsp;  Pessoal</a>
                            </a>
                        </li>
                        <?php
                        if($linha['id'] != "")
                        {
                            echo '
                                     <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_4">
                                            <i class="ki-duotone ki-note-2  fs-3">
                                                <i class="path1"></i>
                                                <i class="path2"></i>
                                                <i class="path3"></i>
                                            </i>&nbsp;  Atestados</a>
                                        </a>
                                    </li>
            
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_5">
                                            <i class="ki-duotone ki-book-open  fs-3">
                                                <i class="path1"></i>
                                                <i class="path2"></i>
                                                <i class="path3"></i>
                                            </i>&nbsp;  Cursos</a>
                                        </a>
                                    </li>
            
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_6">
                                            <i class="ki-duotone ki-calendar-remove  fs-3">
                                                <i class="path1"></i>
                                                <i class="path2"></i>
                                                <i class="path3"></i>
                                            </i>&nbsp;  Dispensas</a>
                                        </a>
                                    </li>
            
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_7">
                                            <i class="ki-duotone ki-calendar-tick    fs-3">
                                                <i class="path1"></i>
                                                <i class="path2"></i>
                                                <i class="path3"></i>
                                            </i>&nbsp;  Férias</a>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_8">
                                            <i class="ki-duotone ki-people   fs-3">
                                                <i class="path1"></i>
                                                <i class="path2"></i>
                                                <i class="path3"></i>
                                            </i>&nbsp;  Punições</a>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_9">
                                            <i class="ki-duotone ki-shop   fs-3">
                                                <i class="path1"></i>
                                                <i class="path2"></i>
                                                <i class="path3"></i>
                                            </i>&nbsp;  Uniformes</a>
                                        </a>
                                    </li>
                                ';
                        }
                        ?>

                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                            <div class="row ">
                                <div class="col-md-2 pt-10  ">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-empty float" data-kt-image-input="true" style="background-image: url(assets/media/svg/avatars/blank.svg)" >
                                        <!--begin::Image preview wrapper-->
                                        <div class="image-input-wrapper w-150px h-150px" style="background-image: url(<?=$linha['foto'];?>)"></div>
                                        <!--end::Image preview wrapper-->

                                        <!--begin::Edit button-->
                                        <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                               data-kt-image-input-action="change"
                                               data-bs-toggle="tooltip"
                                               data-bs-dismiss="click"

                                               title="Change avatar">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="foto" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="avatar_remove" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Edit button-->

                                        <!--begin::Cancel button-->
                                        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                              data-kt-image-input-action="cancel"
                                              data-bs-toggle="tooltip"
                                              data-bs-dismiss="click"
                                              title="Cancel avatar">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                        <!--end::Cancel button-->

                                        <!--begin::Remove button-->
                                        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                              data-kt-image-input-action="remove"
                                              data-bs-toggle="tooltip"
                                              data-bs-dismiss="click"
                                              title="Remove avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Remove button-->
                                    </div>
                                    <!--end::Image input-->
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <?php
                                        if($_SESSION['usuario']['tipo'] != 3)
                                        {
                                        ?>
                                        <div class="col-md-6 pb-3 pt-2">
                                            <div class="form-group">
                                                <label class="form-label" for="nome">* Grupo</label>
                                                <select name="id_grupo" id="id_grupo" data-placeholder="Selecione um Grupo" data-style="btn-default btn-outline-default" data-validar="select2"  class=" form-select " >
                                                    <?php
                                                    $objGrupo = New Grupo();
                                                    $preencher = $linha['id_grupo'] != "" ? $linha['id_grupo'] : $_SESSION['usuario']['id_grupo'] ;
                                                    $rs = $objGrupo->ListarCombo($preencher);
                                                    echo Componente::GerarCombo($rs,'id','nome',$preencher,'','Selecione um Grupo')
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 pb-3 pt-2">
                                            <div class="form-group">
                                                <label class="form-label" for="nome">* Tipo de usuário</label>
                                                <?php
                                                $tipo_usuario = new UsuarioTipo();
                                                $registros = $tipo_usuario->ComboTipoUsuario($_SESSION['usuario']['id_usuario_tipo']);
                                                echo Componente::GerarSelectPDO("id_usuario_tipo", "id_usuario_tipo", "", $registros, array($linha['id_usuario_tipo']), array('', ''), array("id", "nome"), false, 'form-select','data-placeholder="Selecione o Tipo de usuário" data-validar="select2"' );
                                                ?>

                                            </div>
                                        </div>
                                            <?php
                                        }
                                            ?>
                                        <div class="col-md-6 pb-3 pt-2">
                                            <div class="form-group">
                                                <label class="form-label" for="nome">* Nome</label>
                                                <input type="text" name="nome"  id="nome" maxlength="100" class="form-control validar-obrigatorio " value="<?=$linha['nome'];?>"/>

                                            </div>
                                        </div>
                                        <div class="col-md-6 pb-3 pt-2">
                                            <div class="form-group">
                                                <label class="form-label" for="email">E-mail (login de acesso)</label>
                                                <input type="text" name="email"  id="email" maxlength="50" class="form-control  validar-email-usuario" value="<?=$linha['email_usuario'];?>"/>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-3 pb-3 ">
                                            <div class="form-group">
                                                <label class="form-label" for="senha">* Senha</label>
                                                <input type="password" name="senha" id="senha" class="form-control  <? if($linha['id_usuario'] == "") echo 'validar-senha'; else echo 'validar-senha2 ';?>"/>

                                            </div>
                                        </div>
                                        <div class="col-md-3 pb-3">
                                            <div class="form-group">
                                                <label class="form-label" for="senha">* Confirmar Senha</label>
                                                <input type="password" name="confirmar_senha" id="confirmar_senha" class="form-control validar-confirma-senha"/>

                                            </div>
                                        </div>
                                        <div class="col-md-5 pb-3">
                                            <div class="form-group">
                                                <label class="form-label" for="timezone">Fuso Horário</label>
                                                <?
                                                $arrayFusoHorario = [
                                                    ["timezone" => "America/Porto_Velho", "nome" => "Rondônia"],
                                                    ["id" => "America/Fortaleza", "nome" => "CE / MA / PB / PI / RN"],
                                                    ["id" => "America/Belem", "nome" => "Amapá / Pará"],
                                                    ["id" => "America/Maceio", "nome" => "Sergipe / Alagoas"],
                                                    ["id" => "America/Bahia", "nome" => "Bahia / Tocantins"],
                                                    ["id" => "America/Rio_branco", "nome" => "Acre"],
                                                    ["id" => "America/Manaus", "nome" => "Amazonas"],
                                                    ["id" => "America/Cuiaba", "nome" => "Mato Grosso"],
                                                    ["id" => "America/Campo_Grande", "nome" => "Mato Grosso do Sul"],
                                                    ["id" => "America/Recife", "nome" => "Pernambuco"],
                                                    ["id" => "America/Sao_Paulo", "nome" => "ES / GO / MG / PR / RJ / RS / SP / DF / SC"],
                                                    ["id" => "America/Boa_Vista", "nome" => "Roraima"],
                                                ];

                                                echo Componente::GerarSelectPDO("usu_timezone", "usu_timezone", "", $arrayFusoHorario, [$linha->timezone], [], ["id", "nome"], false,'form-control select2')
                                                ?>
                                                <!--<input type="text" name="timezone"  id="timezone" maxlength="50" class="form-control  " value="--><?//=$linha['timezone'];?><!--"/>-->
                                            </div>
                                        </div>
                                        <!--/span-->

                                        <div class="col-md-2 pt-10" >
                                            <div class="form-check form-check-custom form-check-solid">
                                                <input type="checkbox" <? if ($linha['ativo'] == 1) { echo "checked";} ?> name="ativo" id="ativo" <?=$disabled?> value="1" class="form-check-input " />
                                                <label class="form-check-label" for="ativo">* Ativo</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2 pt-10" >
                                            <div class="form-check form-check-custom form-check-solid">
                                                <input type="checkbox" <? if ($linha['master'] == 1) { echo "checked";} ?> name="master" id="master" <?=$disabled?> value="1" class="form-check-input " />
                                                <label class="form-check-label" for="master">* Master</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
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
                                        $onchange3 = ' onchange="Squall.ListarSelect2(\'index_xml.php?app_modulo=cidades&app_comando=filtrar_cidade&app_codigo=\',\'#id_cidade2\',this.value)"';
                                        echo Componente::GerarSelectPDO("id_estado", "id_estado", "", $registros, array($linha['id_estado']), array('','Selecione um Estado'), array("id", "nome","sigla"), false, 'form-select  m-b-20 m-r-10',' data-validar="select2" '.$onchange3);
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
                                        echo Componente::GerarSelectPDO("id_cidade","id_cidade2","",$registros,array($linha['id_cidade']),Array("","-- Selecione uma Cidade --"),Array("id", "nome"),false, "form-select  m-b-20 m-r-10 ",' data-validar="select2"');
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
                                <!--/span-->
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label class="form-label" for="email_mkt2">Email 3</label>
                                        <input type="text" name="email_mkt2"  id="email_mkt2" maxlength="150" class="form-control  " value="<?=$linha['email_mkt2'];?>"/>
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
                        <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                            <div class="row p-t-20">
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="apelido">Apelido</label>
                                        <input type="text" name="apelido"  id="apelido" maxlength="50" class="form-control  " value="<?=$linha['apelido'];?>"/>
                                        <div class="text-muted"> Preencha o campo  Apelido </div> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="nome_mae">Nome Mãe</label>
                                        <input type="text" name="nome_mae"  id="nome_mae" maxlength="255" class="form-control  " value="<?=$linha['nome_mae'];?>"/>
                                        <div class="text-muted"> Preencha o campo  Nome Mãe </div> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="nome_pai">Nome Pai</label>
                                        <input type="text" name="nome_pai"  id="nome_pai" maxlength="255" class="form-control  " value="<?=$linha['nome_pai'];?>"/>
                                        <div class="text-muted"> Preencha o campo  Nome Pai </div> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="data_nascimento">Data Nascimento</label>
                                        <input type="text" name="data_nascimento"  id="data_nascimento"  class="form-control  mask-data" value="<?=Conexao::PrepararDataPHP($linha['data_nascimento'],$_SESSION['usuario']['timezone']);?>"/>
                                        <div class="text-muted"> Preencha o campo  Data Nascimento </div> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="naturalidade">Naturalidade</label>
                                        <input type="text" name="naturalidade"  id="naturalidade" maxlength="100" class="form-control  " value="<?=$linha['naturalidade'];?>"/>
                                        <div class="text-muted"> Preencha o campo  Naturalidade </div> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="rg">Rg</label>
                                        <input type="text" name="rg"  id="rg" maxlength="15" class="form-control  " value="<?=$linha['rg'];?>"/>
                                        <div class="text-muted"> Preencha o campo  Rg </div> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="cpf">CPF</label>
                                        <input type="text" name="cpf"  id="cpf" maxlength="50" class="form-control mask-cpf" value="<?=$linha['cpf'];?>"/>
                                        <div class="text-muted"> Preencha o campo  CPF </div> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="pis">PIS PASEP</label>
                                        <input type="text" name="pis"  id="pis" maxlength="20" class="form-control  " value="<?=$linha['pis'];?>"/>
                                        <div class="text-muted"> Preencha o campo  PIS PASEP </div> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="cnh">CNH</label>
                                        <input type="text" name="cnh"  id="cnh" maxlength="15" class="form-control  " value="<?=$linha['cnh'];?>"/>
                                        <div class="text-muted"> Preencha o campo  CNH </div> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="categoria_cnh">Categoria CNH</label>
                                        <select id="categoria_cnh" name="categoria_cnh[]" multiple class="form-select">
                                            <option value="A" <?php if(strpos($linha['categoria_cnh'],'A') !== false) echo "selected"; ?>>A</option>
                                            <option value="B" <?php if(strpos($linha['categoria_cnh'],'B') !== false) echo "selected"; ?>>B</option>
                                            <option value="C" <?php if(strpos($linha['categoria_cnh'],'C') !== false) echo "selected"; ?>>C</option>
                                            <option value="D" <?php if(strpos($linha['categoria_cnh'],'D') !== false) echo "selected"; ?>>D</option>
                                            <option value="E" <?php if(strpos($linha['categoria_cnh'],'E') !== false) echo "selected"; ?>>E</option>
                                        </select>
                                        <div class="text-muted"> Preencha o campo  Categoria CNH </div> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="validade_cnh">Validade CNH</label>
                                        <input type="text" name="validade_cnh"  id="validade_cnh"  class="form-control mask-data" value="<?=Conexao::PrepararDataPHP($linha['validade_cnh'],$_SESSION['usuario']['timezone']);?>"/>
                                        <div class="text-muted"> Preencha o campo  Validade CNH </div> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="validade_cve">Validade CVE</label>
                                        <input type="text" name="validade_cve"  id="validade_cve"  class="form-control mask-data" value="<?=Conexao::PrepararDataPHP($linha['validade_cve'],$_SESSION['usuario']['timezone']);?>"/>
                                        <div class="text-muted"> Preencha o campo  Validade CVE </div> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="genero">Gênero</label>
                                        <select class="form-select" id="genero" name="genero">
                                            <option value="" <?php if($linha['genero'] == "")  echo 'selected'; ?>>Não Informado</option>
                                            <option value="M" <?php if($linha['genero'] == "M")  echo 'selected'; ?> >Masculino</option>
                                            <option value="F" <?php if($linha['genero'] == "F")  echo 'selected'; ?>>Feminino</option>
                                        </select>
<!--                                        <input type="text" name="genero"  id="genero" maxlength="10" class="form-control  " value="--><?//=$linha['genero'];?><!--"/>-->
                                        <div class="text-muted"> Preencha o campo  Gênero </div> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="tipo_sangue">Tipo Sanguíneo</label>
                                        <?php
                                        $sangue    = new TiposSanguineos();
                                        $registros = $sangue->ListarCombo();
                                        echo Componente::GerarSelectPDO("tipo_sangue", "tipo_sangue", "", $registros, array($linha['id_tipo_sanguineo']), array('','Selecione um tipo Sanguíneo'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10','');
                                        ?>
<!--                                        <input type="text" name="tipo_sangue"  id="tipo_sangue" maxlength="5" class="form-control  " value="--><?//=$linha['tipo_sangue'];?><!--"/>-->
                                        <div class="text-muted"> Preencha o campo  Tipo Sanguíneo </div> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="id_funcao">Função</label>
                                        <?php
                                        $funcao    = new Funcao();
                                        $registros = $funcao->ComboFuncao();
                                        echo Componente::GerarSelectPDO("id_funcao", "id_funcao", "", $registros, array($linha['id_funcao']), array('','Selecione uma Função'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10','');
                                        ?>
                                        <div class="text-muted"> Selecione Função </div> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="matricula_funcional">Matrícula Funcional</label>
                                        <input type="text" name="matricula_funcional"  id="matricula_funcional" maxlength="50" class="form-control  " value="<?=$linha['matricula_funcional'];?>"/>
                                        <div class="text-muted"> Preencha o campo  Matrícula Funcional </div> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="data_inclusao">Data Inclusão</label>
                                        <input type="text" name="data_inclusao"  id="data_inclusao"  class="form-control mask-data" value="<?=Conexao::PrepararDataPHP($linha['data_inclusao'],$_SESSION['usuario']['timezone']);?>"/>
                                        <div class="text-muted"> Preencha o campo  Data Inclusão </div> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="id_base">Base</label>

                                        <?php
                                        $base   = new Base();
                                        $base->setId($linha['id_base']);
                                        $registros = $base->ComboBase();
                                        $lista = (is_array($registros) && count($registros) > 0) ? $registros : [['id' => '', 'nome' => "Nenhum Registro Econtrado"]] ;
                                        echo Componente::GerarSelectPDO("id_base", "id_base", "", $lista, array($linha['id_base']), array('','Selecione uma Base'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10','');
                                        ?>
                                        <div class="text-muted"> Preencha o campo  Id Base </div> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="altura">Altura</label>
                                        <input type="text" name="altura"  id="altura" maxlength="3"  class="form-control  mask-dinheiro" value="<?=number_format($linha['altura'],'2',',','.');?>"/>
                                        <div class="text-muted"> Preencha o campo  Altura </div> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="peso">Peso</label>
                                        <input type="text" name="peso"  id="peso" maxlength="" class="form-control  mask-numero" value="<?=$linha['peso'];?>"/>
                                        <div class="text-muted"> Preencha o campo  Peso </div> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="id_etnia">Etnia</label>
                                        <?php
                                        $etnia    = new PessoalEtnia();
                                        $registros = $etnia->ComboEtnia();
                                        echo Componente::GerarSelectPDO("id_etnia", "id_etnia", "", $registros, array($linha['id_etnia']), array('','Selecione uma Etnia'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10','');
                                        ?>
                                        <div class="text-muted"> Seelecione a Etnia </div> </div>
                                </div>
                                <!--/span-->
<!--                                <div class="col-md-6 mb-2">-->
<!--                                    <div class="form-group">-->
<!--                                        <label class="form-label" for="id_romaneio">Romaneio</label>-->
<!--                                        <input type="text" name="id_romaneio"  id="id_romaneio" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_romaneio'];?><!--"/>-->
<!--                                        <div class="text-muted"> Selecione </div> </div>-->
<!--                                </div>-->
<!--                        -->
<!--                                <div class="col-md-6 mb-2">-->
<!--                                    <div class="form-group">-->
<!--                                        <label class="form-label" for="id_formacao">Formação</label>-->
<!--                                        <input type="text" name="id_formacao"  id="id_formacao" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_formacao'];?><!--"/>-->
<!--                                        <div class="text-muted"> Selecione a Formação </div> </div>-->
<!--                                </div>-->

                            </div>
                        </div>

                        <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel">
                            <?php if($linha['id'] != "") include_once("modulos/pessoal_atestado/template/tpl.geral.pessoal_atestado.simples.php"); ?>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
                            <?php if($linha['id'] != "") include_once("modulos/pessoal_curso/template/tpl.geral.pessoal_curso.simples.php"); ?>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_6" role="tabpanel">
                            <?php if($linha['id'] != "") include_once("modulos/pessoal_dispensas/template/tpl.geral.pessoal_dispensas.simples.php"); ?>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_7" role="tabpanel">
                            <?php if($linha['id'] != "") include_once("modulos/pessoal_ferias/template/tpl.geral.pessoal_ferias.simples.php"); ?>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_8" role="tabpanel">
                            <?php if($linha['id'] != "") include_once("modulos/pessoal_punicao/template/tpl.geral.pessoal_punicao.simples.php"); ?>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_9" role="tabpanel">
                            <?php if($linha['id'] != "") include_once("modulos/pessoal_uniforme/template/tpl.geral.pessoal_uniforme.simples.php"); ?>
                        </div>

                    </div>
                </form>
            </div>
            <div class="card-footer d-flex flex-row-reverse">
                <button type="button" class="btn btn-success ms-3" id="bt_salvar"> <i class="fas fa-check"></i> Salvar</button>
                <button type="button" class="btn btn-light ms-3" id="bt_voltar" onclick="history.back()"> <i class="fas fa-arrow-left"></i> Voltar para listagem</button>
            </div>
        </div>

    </div>
<?php
include_once("modulos/usuario/template/js.frm.usuario.php");
