<form action="#" name="frm_recursos" id="frm_recursos" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="prefixo">Prefixo</label>
                    <input type="text" name="prefixo"  id="prefixo" maxlength="10" class="form-control  " value="<?=$linha['prefixo'];?>"/>
                    <div class="text-muted"> Preencha o campo  Prefixo </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_tipo_recurso">Tipo Recurso</label>
                    <?php
                    $tipoRecusos   = new TipoRecursos();
                    $registros = $tipoRecusos->ListarCombo();
                    echo Componente::GerarSelectPDO("id_tipo_recurso", "id_tipo_recurso", "", $registros, array($linha['id_tipo_recurso']), array('','Selecione um Tipo Recurso'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10','data-validar="select2"');
                    ?>
                    <!--                                <input type="text" name="id_tipo_recurso"  id="id_tipo_recurso" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_tipo_recurso'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Id Tipo Recurso </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="placa">Placa</label>
                    <input type="text" name="placa"  id="placa" maxlength="10" class="form-control validar-obrigatorio " value="<?=$linha['placa'];?>"/>
                    <div class="text-muted"> Preencha o campo  Placa </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="ufplaca">UF Placa</label>
                    <?php
                    $objEstados     = new Estados();
                    $registros = $objEstados->ComboEstados();
                    echo Componente::GerarSelectPDO("ufplaca", "ufplaca", "", $registros, array($linha['ufplaca']), array('','Selecione um Estado'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',' data-validar="select2" '.$onchange);
                    ?>
                    <!--                    <input type="text" name="ufplaca"  id="ufplaca" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['ufplaca'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Ufplaca </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_marca">Marca</label>
                    <?php
                    $objMarca  = new Marca();
                    $registros = $objMarca->ListarComboMarcas();
                    $onchange = ' onchange="Squall.ListarSelect2(\'index_xml.php?app_modulo=modelo&app_comando=filtrar_modelos&app_codigo=\',\'#id_modelo\',this.value)"';
                    echo Componente::GerarSelectPDO("id_marca", "id_marca", "", $registros, array($linha['id_marca']), array('','Selecione uma Marca'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10','data-validar="select2"'.$onchange);
                    ?>
                    <!--                                <input type="text" name="id_modelo"  id="id_modelo" maxlength="" class="form-control  mask-numero validar-obrigatorio " value="--><?//=$linha['id_modelo'];?><!--"/>-->
                    <div class="text-muted"> Selecione a Marca </div> </div>
            </div>
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_modelo">Modelo</label>
                    <?php
                    $objModelo  = new Modelo();
                    $registros = $objModelo->ListarComboModelos($linha['id_modelo']);
                    $lista = (is_array($registros) && count($registros) > 0) ? $registros : [['id' => '', 'nome' => "Selecione um Modelo"]] ;
                    echo Componente::GerarSelectPDO("id_modelo", "id_modelo", "", $lista, array($linha['id_modelo']), array(), array("id", "nome"), false, 'form-select  m-b-20 m-r-10','data-validar="select2"');
                    ?>
                    <!--                                <input type="text" name="id_modelo"  id="id_modelo" maxlength="" class="form-control  mask-numero validar-obrigatorio " value="--><?//=$linha['id_modelo'];?><!--"/>-->
                    <div class="text-muted"> Selecione o Modelo </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="ano_modelo">Ano Modelo</label>
                    <input type="text" name="ano_modelo"  id="ano_modelo" maxlength="4" class="form-control  mask-numero" value="<?=$linha['ano_modelo'];?>"/>
                    <div class="text-muted"> Preencha o campo  Ano Modelo </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="ano_fabricacao">Ano Fabricação</label>
                    <input type="text" name="ano_fabricacao"  id="ano_fabricacao" maxlength="4" class="form-control  mask-numero" value="<?=$linha['ano_fabricacao'];?>"/>
                    <div class="text-muted"> Preencha o campo  Ano Fabricação </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="renavam">Renavam</label>
                    <input type="text" name="renavam"  id="renavam" maxlength="20" class="form-control  " value="<?=$linha['renavam'];?>"/>
                    <div class="text-muted"> Preencha o campo  Renavam </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="chassi">Chassi</label>
                    <input type="text" name="chassi"  id="chassi" maxlength="20" class="form-control  " value="<?=$linha['chassi'];?>"/>
                    <div class="text-muted"> Preencha o campo  Chassi </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_base">Base</label>

                    <?php
                    $base   = new Base();
                    $base->setId($linha['id_base']);
                    $registros = $base->ComboBase();
                    $lista = (is_array($registros) && count($registros) > 0) ? $registros : [['id' => '', 'nome' => "Selecione uma Base"]] ;
                    echo Componente::GerarSelectPDO("id_base", "id_base", "", $lista, array($linha['id_base']), array('','Selecione uma Base'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10','data-validar="select2"');
                    ?>
                    <div class="text-muted"> Preencha o campo  Id Base </div> </div>
            </div>
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_carga">Data Carga</label>
                    <input type="text" name="data_carga"  id="data_carga"  class="form-control  mask-data" value="<?=Conexao::PrepararDataPHP($linha['data_carga'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Data Carga </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="observacao">Observacao</label>
                    <textarea class="form-control  " name="observacao"  id="observacao" placeholder="Insira o texto" ><?=$linha['observacao'];?></textarea>
                    <div class="text-muted"> Preencha o campo  Observacao </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_tipo_combustivel">Tipo Combustível</label>
                    <?php
                    $combustivel   = new TipoCombustivel();
                    $registros = $combustivel->ListarCombo();
                    $lista = (is_array($registros) && count($registros) > 0) ? $registros : [['id' => '', 'nome' => "Selecione Combustivel"]] ;
                    echo Componente::GerarSelectPDO("id_tipo_combustivel", "id_tipo_combustivel", "", $lista, array($linha['id_tipo_combustivel']), array('','Selecione Combustivel'), array("id", "tipo_combustivel"), false, 'form-select  m-b-20 m-r-10','data-validar="select2"');
                    ?>
                    <!--                    <input type="text" name="id_tipo_combustivel"  id="id_tipo_combustivel" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_tipo_combustivel'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Tipo Combustível </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_cor">Cor</label>
                    <?php
                    $cores   = new RecursosCores();
                    $registros = $cores->ListarCombo();
                    $lista = (is_array($registros) && count($registros) > 0) ? $registros : [['id' => '', 'nome' => "Selecione uma cor"]] ;
                    echo Componente::GerarSelectPDO("id_cor", "id_cor", "", $lista, array($linha['id_cor']), array('','Selecione uma Cor'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10','data-validar="select2"');
                    ?>
                    <!--                    <input type="text" name="id_cor"  id="id_cor" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_cor'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Id Cor </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="valor_aquisicao">Valor Aquisiçao</label>
                    <input type="text" name="valor_aquisicao"  id="valor_aquisicao"  class="form-control  mask-dinheiro" value="<?=number_format($linha['valor_aquisicao'],'2',',','.');?>"/>
                    <div class="text-muted"> Preencha o campo  Valor Aquisiçao </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="valor_mercado">Valor Mercado</label>
                    <input type="text" name="valor_mercado"  id="valor_mercado"  class="form-control  mask-dinheiro" value="<?=number_format($linha['valor_mercado'],'2',',','.');?>"/>
                    <div class="text-muted"> Preencha o campo  Valor Mercado </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="km_aquisicao">Km Aquisiçao</label>
                    <input type="text" name="km_aquisicao"  id="km_aquisicao" maxlength="" class="form-control  mask-numero" value="<?=$linha['km_aquisicao'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="km_atual">Km Atual</label>
                    <input type="text" name="km_atual"  id="km_atual" maxlength="" class="form-control  mask-numero" value="<?=$linha['km_atual'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="potencia">Potência (CV)</label>
                    <input type="text" name="potencia"  id="potencia" maxlength="" class="form-control  mask-numero" value="<?=$linha['potencia'];?>"/>
                </div>
            </div>
            <!--/span-->
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="peso_liquido">Peso Liquido (Kg)</label>
                    <input type="text" name="peso_liquido"  id="peso_liquido" maxlength="" class="form-control  mask-numero" value="<?=$linha['peso_liquido'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="tanque">Tanque (L)</label>
                    <input type="text" name="tanque"  id="tanque" maxlength="" class="form-control  mask-numero" value="<?=$linha['tanque'];?>"/>
                    <div class="text-muted"> Preencha o campo  Tanque </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="disponibilidade">Disponibilidade</label>
                    <?php
                    $disponibilidade  = new Disponibilidade();
                    $registros = $disponibilidade->ListarCombo();
                    $lista = (is_array($registros) && count($registros) > 0) ? $registros : [['id' => '', 'nome' => "Selecione Disponibilidade"]] ;
                    echo Componente::GerarSelectPDO("disponibilidade", "disponibilidade", "", $lista, array($linha['disponibilidade']), array('','Selecione Disponibilidade'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10','data-validar="select2"');
                    ?>
<!--                    <input type="text" name="disponibilidade"  id="disponibilidade" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['disponibilidade'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Disponibilidade </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="proprietario">Proprietário</label>
                    <input type="text" name="proprietario"  id="proprietario" maxlength="255" class="form-control  " value="<?=$linha['proprietario'];?>"/>

                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_baixa">Data Baixa</label>
                    <input type="text" name="data_baixa"  id="data_baixa"  class="form-control  mask-data" value="<?=Conexao::PrepararDataPHP($linha['data_baixa'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Data Baixa </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="destino_baixa">Destino Baixa</label>
                    <input type="text" name="destino_baixa"  id="destino_baixa" maxlength="255" class="form-control  " value="<?=$linha['destino_baixa'];?>"/>
                    <div class="text-muted"> Preencha o campo  Destino Baixa </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_final_garantia">Data Final Garantia</label>
                    <input type="text" name="data_final_garantia"  id="data_final_garantia"  class="form-control  mask-data" value="<?=Conexao::PrepararDataPHP($linha['data_final_garantia'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Data Final Garantia </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="capacidade_carga">Capacidade Carga</label>
                    <input type="text" name="capacidade_carga"  id="capacidade_carga" maxlength="" class="form-control  mask-numero" value="<?=$linha['capacidade_carga'];?>"/>
                    <div class="text-muted"> Preencha o campo  Capacidade Carga </div> </div>
            </div>
            <!--/span-->


            <div class="col-md-12 mb-2 d-flex justify-content-center ">
                <div class=" row ">
                    <div class="col-md-3 pt-10 ">
                        <h3 class="text-gray-400">Foto Frente</h3>
                        <!--begin::Image input-->
                        <div class="image-input image-input-empty image-input-placeholder-car-front float" data-kt-image-input="true"  >
                            <!--begin::Image preview wrapper-->
                            <div class="image-input-wrapper w-150px h-150px" style="background-image: url(<?=$linha['foto_frente'];?>)"></div>
                            <!--end::Image preview wrapper-->

                            <!--begin::Edit button-->
                            <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                   data-kt-image-input-action="change"
                                   data-bs-toggle="tooltip"
                                   data-bs-dismiss="click"

                                   title="Change avatar">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <!--begin::Inputs-->
                                <input type="file" name="foto_frente" accept=".png, .jpg, .jpeg" />
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
                    <div class="col-md-3 pt-10  ">
                        <h3 class="text-gray-400">Foto Traseira</h3>
                        <!--begin::Image input-->
                        <div class="image-input image-input-empty  image-input-placeholder-car-back float" data-kt-image-input="true"  >
                            <!--begin::Image preview wrapper-->
                            <div class="image-input-wrapper w-150px h-150px" style="background-image: url(<?=$linha['foto_traseira'];?>)"></div>
                            <!--end::Image preview wrapper-->

                            <!--begin::Edit button-->
                            <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                   data-kt-image-input-action="change"
                                   data-bs-toggle="tooltip"
                                   data-bs-dismiss="click"

                                   title="Change avatar">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <!--begin::Inputs-->
                                <input type="file" name="foto_traseira" accept=".png, .jpg, .jpeg" />
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
                    <div class="col-md-3 pt-10  ">
                        <h3 class="text-gray-400">Foto Direita</h3>
                        <!--begin::Image input-->
                        <div class="image-input image-input-empty  image-input-placeholder-car-right  float" data-kt-image-input="true"  >
                            <!--begin::Image preview wrapper-->
                            <div class="image-input-wrapper w-150px h-150px" style="background-image: url(<?=$linha['foto_direita'];?>)"></div>
                            <!--end::Image preview wrapper-->

                            <!--begin::Edit button-->
                            <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                   data-kt-image-input-action="change"
                                   data-bs-toggle="tooltip"
                                   data-bs-dismiss="click"

                                   title="Change avatar">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <!--begin::Inputs-->
                                <input type="file" name="foto_direita" accept=".png, .jpg, .jpeg" />
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
                    <div class="col-md-3 pt-10  ">
                        <h3 class="text-gray-400">Foto Esquerda</h3>
                        <!--begin::Image input-->
                        <div class="image-input image-input-empty image-input-placeholder-car-left float" data-kt-image-input="true"  >
                            <!--begin::Image preview wrapper-->
                            <div class="image-input-wrapper w-150px h-150px" style="background-image: url(<?=$linha['foto_esquerda'];?>)"></div>
                            <!--end::Image preview wrapper-->

                            <!--begin::Edit button-->
                            <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                   data-kt-image-input-action="change"
                                   data-bs-toggle="tooltip"
                                   data-bs-dismiss="click"

                                   title="Change avatar">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <!--begin::Inputs-->
                                <input type="file" name="foto_esquerda" accept=".png, .jpg, .jpeg" />
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
                </div>
            </div>
            =
        </div>
</form>
