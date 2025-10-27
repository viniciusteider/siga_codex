<form action="#" name="frm_veiculos_acidentes" id="frm_veiculos_acidentes" method="post">
    <input type="hidden" name="id_veiculo_acidentes"  id="id_veiculo_acidentes"   value="<?=$linha['id'];?>"/>
    <input type="hidden" name="id_ocorrencia"  id="id_ocorrencia"   value="<?=$_REQUEST['id_ocorrencia'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_tipo_veiculo">Tipo Veiculo:</label>
                    <?php
                    $objFipeTipo =  new FipeTipo();
//                    $onchange = ' onchange="Squall.ListarSelect2(\'index_xml.php?app_modulo=fipe_marcas&app_comando=listar_fipe_marcas_autocomplete&app_codigo=\',\'#id_marca\',this.value)"';
                    echo $objFipeTipo->GerarSelec($linha['id_tipo_veiculo'],'id_tipo_veiculo','id_tipo_veiculo','data-placeholder="Selecione Tipo" data-validar="select2" ' . $onchange);
                    ?>
<!--                    <input type="text" name="id_tipo_veiculo"  id="id_tipo_veiculo" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_tipo_veiculo'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Id Tipo Veiculo </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="condutor">Condutor:</label>
                    <input type="text" name="condutor"  id="condutor" maxlength="100" class="form-control  " value="<?=$linha['condutor'];?>"/>
                    <div class="text-muted"> Preencha o campo  Condutor </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="cnh_condutor">Cnh Condutor:</label>
                    <input type="text" name="cnh_condutor"  id="cnh_condutor" maxlength="20" class="form-control  " value="<?=$linha['cnh_condutor'];?>"/>
                    <div class="text-muted"> Preencha o campo  Cnh Condutor </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="proprietario">Proprietario:</label>
                    <input type="text" name="proprietario"  id="proprietario" maxlength="100" class="form-control  " value="<?=$linha['proprietario'];?>"/>
                    <div class="text-muted"> Preencha o campo  Proprietario </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="destruicao_tipo">Destruicao Tipo:</label>
                    <?php
                    $objDestruicao =  new TipoDestruicao();
                    echo $objDestruicao->GerarSelec($linha['id_tipo_destruicao'],'id_tipo_destruicao','id_tipo_destruicao','data-placeholder="Selecione Tipo" ' );
                    ?>
<!--                    <input type="text" name="destruicao_tipo"  id="destruicao_tipo" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['destruicao_tipo'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Destruicao Tipo </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="placa_veiculo">Placa Veiculo:</label>
                    <input type="text" name="placa_veiculo"  id="placa_veiculo" maxlength="7" class="form-control  " value="<?=$linha['placa_veiculo'];?>"/>
                    <div class="text-muted"> Preencha o campo  Placa Veiculo </div>
                </div>
            </div>
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="destruicao_descricao">Destruicao Descricao:</label>
                    <textarea class="form-control  " name="destruicao_descricao"  id="destruicao_descricao" placeholder="Insira o texto" ><?=$linha['destruicao_descricao'];?></textarea>
                    <div class="text-muted"> Preencha o campo  Destruicao Descricao </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="seguradora">Seguradora:</label>
                    <input type="text" name="seguradora"  id="seguradora" maxlength="100" class="form-control  " value="<?=$linha['seguradora'];?>"/>
                    <div class="text-muted"> Preencha o campo  Seguradora </div>
                </div>
            </div>
            <!--/span-->

            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_marca">Marca:</label>
                    <?php
                    $objFipeMarcas =  new FipeMarcas();
//                    $onchange3 = ' onchange="Squall.ListarSelect2(\'index_xml.php?app_modulo=fipe_modelos&app_comando=listar_fipe_modelos_autocomplete&app_codigo=\',\'#id_modelo\',this.value)"';
                    echo $objFipeMarcas->GerarSelec($linha['id_marca'],'id_marca','id_marca','data-placeholder="Selecione Marca" data-validar="select2" ' . $onchange3);
                    ?>
<!--                    <input type="text" name="id_marca"  id="id_marca" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_marca'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Id Marca </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_modelo">Modelo:</label>
                    <?php
                    $objFipeModelos =  new FipeModelos();
//                    $onchange2 = ' onchange="Squall.ListarSelect2(\'index_xml.php?app_modulo=fipe_anos&app_comando=listar_fipe_anos_autocomplete&app_codigo=\',\'#id_ano\',this.value)"';
                    echo $objFipeModelos->GerarSelec($linha['id_modelo'],'id_modelo','id_modelo','data-placeholder="Selecione Modelo" data-validar="select2" ' . $onchange2);
                    ?>
<!--                    <input type="text" name="id_modelo"  id="id_modelo" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_modelo'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Id Modelo </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_ano">Ano:</label>
                    <?php
                    $objFipeAnos =  new FipeAnos();
                    echo $objFipeAnos->GerarSelec($linha['id_ano'],'id_ano','id_ano','data-placeholder="Selecione Ano" data-validar="select2" ');
                    ?>
<!--                    <input type="text" name="id_ano"  id="id_ano" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_ano'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Id Ano </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="cor">Cor:</label>
                    <input type="text" name="cor"  id="cor" maxlength="20" class="form-control  " value="<?=$linha['cor'];?>"/>
                    <div class="text-muted"> Preencha o campo  Cor </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-6 mb-2 pt-11">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="carga_perigosa" <?php if($linha['carga_perigosa'] == 1) echo 'checked="checked"'; ?>  id="carga_perigosa"/>
                    <label class="form-check-label" for="carga_perigosa">
                        Carga Perigosa
                    </label>
                </div>
            </div>
            <!--/span-->
        </div>
</form>
<?php
include_once("modulos/veiculos_acidentes/template/js.modal.veiculos_acidentes.php");
