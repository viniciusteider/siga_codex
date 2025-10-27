
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_almoxarifado"> Almoxarifado:</label>
                    <?php
                    $objAlmoxarifado =  new Almoxarifado();
                    $objAlmoxarifado->setIdGrupo($_SESSION['usuario']['id_grupo']);
                    $onchange = ' onchange="Squall.ListarSelect2(\'index_xml.php?app_modulo=almoxarifado_setor&app_comando=listar_setores_almoxarifado&app_codigo=\',\'#id_setor\',this.value)"';
                    echo $objAlmoxarifado->GerarSelec($linha['id_almoxarifado'],'id_almoxarifado','id_almoxarifado','data-placeholder="Selecione Almoxarifado" data-validar="select2" '.$onchange,["id","nome"],true );
                    ?>
                    <div class="text-muted"> Preencha o campo  Id Almoxarifado </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_setor"> Setor:</label>
                    <?php
                    $objAlmoxarifadoSetor =  new AlmoxarifadoSetor();
//                    $objAlmoxarifadoSetor->setIdGrupo($_SESSION['usuario']['id_grupo']);
                    echo $objAlmoxarifadoSetor->GerarSelec($linha['id_setor'],'id_setor','id_setor','data-placeholder="Selecione Setor" data-validar="select2" ',["id","nome"],true );
                    ?>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="numero_nota_fiscal">N.º Nota Fiscal:</label>
                    <input type="text" name="numero_nota_fiscal"  id="numero_nota_fiscal" maxlength="" class="form-control  mask-numero" value="<?=$linha['numero_nota_fiscal'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_emissao_nota_fiscal">Emissao Nota Fiscal:</label>
                    <div class="input-group mb-5">
                        <input type="text" name="data_emissao_nota_fiscal"  id="data_emissao_nota_fiscal"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['data_emissao_nota_fiscal'],$_SESSION['usuario']['timezone']);?>"/>
                        <span class="input-group-text" id="basic-addon2">
                        <i class="fas fa-calendar fs-4"></i>
                        </span>
                    </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="numero_documento">N.º Documento:</label>
                    <input type="text" name="numero_documento"  id="numero_documento" maxlength="" class="form-control  mask-numero" value="<?=$linha['numero_documento'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="numero_empenho">N.º Empenho:</label>
                    <input type="text" name="numero_empenho"  id="numero_empenho" maxlength="" class="form-control  mask-numero" value="<?=$linha['numero_empenho'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="numero_requisicao">N.º Requisicao:</label>
                    <input type="text" name="numero_requisicao"  id="numero_requisicao" maxlength="" class="form-control  mask-numero" value="<?=$linha['numero_requisicao'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_solicitacao">Data Solicitacao:</label>
                    <div class="input-group mb-5">
                        <input type="text" name="data_solicitacao"  id="data_solicitacao"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['data_solicitacao'],$_SESSION['usuario']['timezone']);?>"/>
                        <span class="input-group-text" id="basic-addon2">
                        <i class="fas fa-calendar fs-4"></i>
                        </span>
                    </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_recebimento">Data Recebimento:</label>
                    <div class="input-group mb-5">
                        <input type="text" name="data_recebimento"  id="data_recebimento"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['data_recebimento'],$_SESSION['usuario']['timezone']);?>"/>
                        <span class="input-group-text" id="basic-addon2">
                        <i class="fas fa-calendar fs-4"></i>
                        </span>
                    </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="valor_nota">Valor Nota:</label>
                    <div class="input-group mb-5">
                        <span class="input-group-text">R$</span>
                        <input type="text" name="valor_nota"  id="valor_nota"  class="form-control  mask-dinheiro" value="<?=number_format($linha['valor_nota'],'2',',','.');?>"/>
                    </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="descricao">Descricao:</label>
                    <textarea class="form-control  " name="descricao"  id="descricao" placeholder="Insira o texto" ><?=$linha['descricao'];?></textarea>
                    <div class="text-muted"> Preencha o campo  Descricao </div>
                </div>
            </div>
            <!--/span-->
        </div>
    </div>
