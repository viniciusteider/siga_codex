<?php
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Ocorrências";
echo $objApp->GerarBreadCrumb($configTitulo);
?>
<form action="#" name="frm_ocorrencias" id="frm_ocorrencias" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <input type="hidden" name="raio"  id="raio"   value="<?=$linha['raio'];?>"/>
    <input type="hidden" value="<?=$linha['id_endereco'];?>" name="id_endereco" id="id_endereco"/>
    <input type="hidden" name="latitude"  id="latitude"   value="<?=$linha['latitude'];?>"/>
    <input type="hidden" name="longitude"  id="longitude"   value="<?=$linha['longitude'];?>"/>
    <div id="kt_app_content_container" class="app-container  p-0">
        <div class="row ">
            <div class="col-md-8">
                <div class="card shadow-sm h-lg-700px">
                    <div class="card-body" id="formulario_ocorrencias">
                        <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x  mb-5 fs-6">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">
                                    <i class="ki-duotone ki-user-edit fs-3">
                                        <i class="path1"></i>
                                        <i class="path2"></i>
                                        <i class="path3"></i>
                                    </i>&nbsp;  Dados da Ocorrência</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_2"><i class="fa fa-home"></i> Endereço</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                                <div class="row p-t-20">
                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label class="form-label" for="data_hora">Data Hora</label>
                                            <input type="text" name="data_hora"  id="data_hora"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['data_hora'],$_SESSION['usuario']['timezone']);?>"/>
                                            <div class="text-muted"> Preencha o campo  Data Hora </div> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-8 mb-2">
                                        <div class="form-group">
                                            <label class="form-label" for="nome">Nome</label>
                                            <input type="text" name="nome"  id="nome" maxlength="255" class="form-control  " value="<?=$linha['nome'];?>"/>
                                            <div class="text-muted"> Preencha o campo  Nome </div> </div>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <div class="form-group">
                                            <label class="form-label" for="numero_ocorrencia">Número Ocorrência</label>
                                            <input type="text" name="numero_ocorrencia"  id="numero_ocorrencia" maxlength="" class="form-control  mask-numero" value="<?=$linha['numero_ocorrencia'];?>"/>
                                            <div class="text-muted"> Preencha o campo  Numero Ocorrência </div> </div>
                                    </div>
                                    <!--/span-->

                                    <div class="col-md-3 mb-2">
                                        <div class="form-group">
                                            <label class="form-label" for="id_regulador">Regulador</label>
                                                <select name="id_regulador" id="id_regulador"  class=" form-select" data-placeholder="Selecione o Regulador" data-validar="select2"  >
                                                <?php
                                                $objuser =  new Usuario();
                                                $user = $objuser->ListarUsuarioSelecionado($linha['id_regulador']);
                                                echo Componente::GerarCombo($user,'id','nome',$linha['id_regulador'],'','');
                                                ?>
                                              </select>
<!--                                            <input type="text" name="id_regulador"  id="id_regulador" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_regulador'];?><!--"/>-->
                                            <div class="text-muted"> Preencha o campo Regulador </div> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-3 mb-2">
                                        <div class="form-group">
                                            <label class="form-label" for="id_evento">Evento</label>
                                            <?php
                                            $objEvento     = new Evento();
                                            $registros = $objEvento->ComboEventos($linha['id_evento']);
                                            $onchange = ' onchange="Squall.ListarSelect2(\'index_xml.php?app_modulo=subevento&app_comando=filtrar_sub_eventos&app_codigo=\',\'#id_subevento\',this.value)"';
                                            echo Componente::GerarSelectPDO("id_evento", "id_evento", "", $registros, array($linha['id_evento']), array('','Selecione um Evento'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',' data-validar="select2" '.$onchange);
                                            ?>
                                            <div class="text-muted"> Preencha o campo   Evento </div> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-3 mb-2">
                                        <div class="form-group">
                                            <label class="form-label" for="id_subevento">Sub-Evento</label>
                                            <?php
                                            $objSubEvento     = new Subevento();
                                            $registros = $objSubEvento->ListarComboSubEventos($linha['id_subevento']);
                                            $lista = (is_array($registros) && count($registros) > 0) ? $registros : [['id' => '', 'nome' => "Nenhum Registro Econtrado"]] ;
                                            echo Componente::GerarSelectPDO("id_subevento", "id_subevento", "", $lista, array($linha['id_subevento']), array(), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',' data-validar="select2" ');
                                            ?>
<!--                                            <input type="text" name="id_subevento"  id="id_subevento"  class="form-control  " value="--><?//=$linha['id_subevento'];?><!--"/>-->
                                            <div class="text-muted"> Preencha o campo   Subevento </div> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label class="form-label" for="id_ocorrencia_status">Status</label>
                                            <?php
                                            $objocorrenciaStatus    = new OcorrenciasStatus();
                                            $registros = $objocorrenciaStatus->ComboStatus();
                                            $lista = (is_array($registros) && count($registros) > 0) ? $registros : [['id' => '', 'nome' => "Nenhum Registro Econtrado"]] ;
                                            echo Componente::GerarSelectPDO("id_ocorrencia_status", "id_ocorrencia_status", "", $lista, array($linha['id_ocorrencia_status']), array(), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',' data-validar="select2" ');
                                            ?>
                                            <div class="text-muted"> Preencha o campo   Ocorrencia Status </div> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label class="form-label" for="id_ocorrencia_classificacao"> Classificação</label>
                                            <?php
                                            $objClassificao    = new ClassificacaoRisco();
                                            $registros = $objClassificao->ComboClassificacaoRiscos();
                                            $lista = (is_array($registros) && count($registros) > 0) ? $registros : [['id' => '', 'nome' => "Nenhum Registro Econtrado"]] ;
                                            echo Componente::GerarSelectPDO("id_ocorrencia_classificacao", "id_ocorrencia_classificacao", "", $lista, array($linha['id_ocorrencia_classificacao']), array(), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',' data-validar="select2" ');
                                            ?>
<!--                                            <input type="text" name="id_ocorrencia_classificacao"  id="id_ocorrencia_classificacao" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_ocorrencia_classificacao'];?><!--"/>-->
                                            <div class="text-muted"> Preencha o campo   Ocorrencia Classificação </div> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label class="form-label" for="id_status_progressao">Progressão</label>
                                            <input type="text" name="id_status_progressao"  id="id_status_progressao" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_status_progressao'];?>"/>
                                            <div class="text-muted"> Preencha o campo   Status Progressão </div> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label class="form-label" for="descritivo">Descritivo</label>
                                            <textarea class="form-control  " name="descritivo"  id="descritivo" rows="5" placeholder="Insira o texto" ><?=$linha['descritivo'];?></textarea>
                                            <div class="text-muted"> Preencha o campo  Descritivo </div> </div>
                                    </div>
                                    <!--/span-->


                                </div>
                            </div>
                            <div class="tab-pane fade show  " id="kt_tab_pane_2" role="tabpanel">
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
                                            <label class="form-label" for="email_mkt">Email</label>
                                            <input type="text" name="email_mkt"  id="email_mkt" maxlength="150" class="form-control  " value="<?=$linha['email_mkt'];?>"/>

                                        </div>
                                    </div>
                                    <!--/span-->

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="form-label" for="observacao">Observação de endereço</label>
                                            <textarea class="form-control  " name="observacao" rows="4"  id="observacao" placeholder="Insira o texto" ><?=$linha['observacao'];?></textarea>

                                        </div>
                                    </div>
                                    <div class="col-6 ">
                                        <!--begin::Input wrapper-->
                                        <div class="w-lg-100">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">
                                                Raio
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Slider-->
                                            <div class="d-flex flex-column text-center text-info">
                                                <div class="d-flex align-items-start justify-content-center mb-7">
                                                    <span class="fw-bold fs-4 mt-1 me-2"></span>
                                                    <span class="fw-bold fs-3x" id="kt_modal_create_campaign_budget_label"></span>
                                                    <span class="fw-bold fs-3x"></span>
                                                </div>
                                                <div id="kt_modal_create_campaign_budget_slider" class="noUi-lg"></div>
                                            </div>
                                            <!--end::Slider-->
                                        </div>
                                        <!--end::Input wrapper-->


                                    </div>
                                    <!--/span-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="card shadow-sm h-lg-700px min-h-400px ">
                    <div class="card-body m-2" id="map">
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-5">
                <div class="card shadow-sm ">
                    <div class="card-body" id="footer">
                        <button type="button" class="btn btn-success ms-3" id="bt_salvar"> <i class="fas fa-check"></i> Salvar</button>
                        <button type="button" class="btn btn-light " id="bt_voltar" onclick="history.back()"> <i class="fas fa-arrow-circle-left"></i> Voltar para listagem</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
include_once("modulos/ocorrencias/template/js.frm.ocorrencias.php");
?>
