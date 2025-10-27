
<div class="row p-t-20">
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_tipo_obstetricia">Tipo Obstetrícia</label>
                    <?php
                    $objTipoOb  = new TipoObstetricia();
                    $registros = $objTipoOb->ListarCombo($linha['id_tipo_obstetricia']);
                    echo Componente::GerarSelectPDO("id_tipo_obstetricia", "id_tipo_obstetricia", "", $registros, array($linha['id_tipo_obstetricia']), array('','Selecione Tipo Obstetrícia'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',''.$onchange);
                    ?>
<!--                    <input type="text" name="id_tipo_obstetricia"  id="id_tipo_obstetricia" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_tipo_obstetricia'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Id Tipo Obstetricia </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_respiracao">Respiração</label>
                    <?php
                    $objRespiracao  = new Respiracao();
                    $registros = $objRespiracao->ListarCombo($linha['id_respiracao']);
                    echo Componente::GerarSelectPDO("id_respiracao", "id_respiracao", "", $registros, array($linha['id_respiracao']), array('','Selecione Respiração'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',''.$onchange);
                    ?>
<!--                    <input type="text" name="id_respiracao"  id="id_respiracao" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_respiracao'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Id Respiracao </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_vias_aereas">Vias Aéreas</label>
                    <?php
                    $objViasAereas  = new ViasAereas();
                    $registros = $objViasAereas->ListarCombo($linha['id_vias_aereas']);
                    echo Componente::GerarSelectPDO("id_vias_aereas", "id_vias_aereas", "", $registros, array($linha['id_vias_aereas']), array('','Selecione Vias Aéreas'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',''.$onchange);
                    ?>
<!--                    <input type="text" name="id_vias_aereas"  id="id_vias_aereas" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_vias_aereas'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Id Vias Aereas </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_pupilas">Pupilas</label>
                    <?php
                    $objPupilas  = new PupilasSintomas();
                    $registros = $objPupilas->ListarCombo($linha['id_pupilas']);
                    echo Componente::GerarSelectPDO("id_pupilas", "id_pupilas", "", $registros, array($linha['id_pupilas']), array('','Selecione Pupilas'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',''.$onchange);
                    ?>
<!--                    <input type="text" name="id_pupilas"  id="id_pupilas" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_pupilas'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Id Pupilas </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_hospital">Hospital</label>
                    <?php
                    $objHospital  = new Hospital();
                    $registros = $objHospital->ListarCombo($linha['id_hospital']);
                    echo Componente::GerarSelectPDO("id_hospital", "id_hospital", "", $registros, array($linha['id_hospital']), array('','Selecione Hospital'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',''.$onchange);
                    ?>
<!--                    <input type="text" name="id_hospital"  id="id_hospital" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_hospital'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Id Hospital </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_etnia">Etnia</label>
                    <?php
                    $objEtinia = new PessoalEtnia();
                    $registros = $objEtinia->ListarCombo($linha['id_etnia']);
                    echo Componente::GerarSelectPDO("id_etnia", "id_etnia", "", $registros, array($linha['id_etnia']), array('','Selecione Etnia'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',''.$onchange);
                    ?>
<!--                    <input type="text" name="id_etnia"  id="id_etnia" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_etnia'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Id Etnia </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-5 mb-2">
                <div class="form-group">
                    <label class="form-label" for="nome">Nome</label>
                    <input type="text" name="nome"  id="nome" maxlength="150" class="form-control  " value="<?=$linha['nome'];?>"/>
                    <div class="text-muted"> Preencha o campo  Nome </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="idade">Idade</label>
                    <input type="text" name="idade"  id="idade" maxlength="" class="form-control  mask-numero" value="<?=$linha['idade'];?>"/>
                    <div class="text-muted"> Preencha o campo  Idade </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="sexo">Sexo</label>
                    <select class="form-select" id="sexo" name="sexo">
                        <option value="" <?php if($linha['sexo'] == "")  echo 'selected'; ?>>Não Informado</option>
                        <option value="M" <?php if($linha['sexo'] == "M")  echo 'selected'; ?> >Masculino</option>
                        <option value="F" <?php if($linha['sexo'] == "F")  echo 'selected'; ?>>Feminino</option>
                    </select>
                    <!--                                        <input type="text" name="genero"  id="genero" maxlength="10" class="form-control  " value="--><?//=$linha['genero'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Gênero </div> </div>
            </div>
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="rg">Rg</label>
                    <input type="text" name="rg"  id="rg" maxlength="15" class="form-control  " value="<?=$linha['rg'];?>"/>
                    <div class="text-muted"> Preencha o campo  Rg </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="cpf">Cpf</label>
                    <input type="text" name="cpf"  id="cpf" maxlength="25" class="form-control mask-cpf " value="<?=$linha['cpf'];?>"/>
                    <div class="text-muted"> Preencha o campo  Cpf </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="idade_gestacional">Idade Gestacional</label>
                    <input type="text" name="idade_gestacional"  id="idade_gestacional" maxlength="" class="form-control  mask-numero" value="<?=$linha['idade_gestacional'];?>"/>
                    <div class="text-muted"> Preencha o campo  Idade Gestacional </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="bcf">Bcf</label>
                    <input type="text" name="bcf"  id="bcf" maxlength="" class="form-control  mask-numero" value="<?=$linha['bcf'];?>"/>
                    <div class="text-muted"> Preencha o campo  Bcf </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="apgar_1">Apgar #1</label>
                    <input type="text" name="apgar_1"  id="apgar_1" maxlength="" class="form-control  mask-numero" value="<?=$linha['apgar_1'];?>"/>
                    <div class="text-muted"> Preencha o campo  Apgar 1 </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="apgar_5">Apgar #5</label>
                    <input type="text" name="apgar_5"  id="apgar_5" maxlength="" class="form-control  mask-numero" value="<?=$linha['apgar_5'];?>"/>
                    <div class="text-muted"> Preencha o campo  Apgar 5 </div> </div>
            </div>
            <!--/span-->
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="profissional">Profissional</label>
                    <input type="text" name="profissional"  id="profissional" maxlength="100" class="form-control  " value="<?=$linha['profissional'];?>"/>
                    <div class="text-muted"> Preencha o campo  Profissional </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_recebimento">Data Recebimento</label>
                    <input type="text" name="data_recebimento"  id="data_recebimento"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['data_recebimento'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Data Recebimento </div> </div>
            </div>
            <div class="col-md-2 mt-10 ">
                <div class="form-check form-check-custom form-check-solid">
                    <input type="checkbox" <? if ($linha['recusa_atendimento'] == 1) { echo "checked";} ?> name="recusa_atendimento" id="recusa_atendimento"  value="1" class="form-check-input " />
                    <label class="form-check-label" for="recusa_atendimento">* Recusa Atendimento</label>
                </div>
                <!--                    <label class="form-label" for="recusa_atendimento">Recusa Atendimento</label>-->
                <!--                    <input type="text" name="recusa_atendimento"  id="recusa_atendimento" maxlength="1" class="form-control  mask-numero" value="--><?//=$linha['recusa_atendimento'];?><!--"/>-->
            </div>
            <!--/span-->
            <div class="col-md-3  mt-10">
                <div class="form-check form-check-custom form-check-solid">
                    <input type="checkbox" <? if ($linha['recusa_transporte'] == 1) { echo "checked";} ?> name="recusa_transporte" id="recusa_atendimerecusa_transportento"  value="1" class="form-check-input " />
                    <label class="form-check-label" for="recusa_transporte">* Recusa Transporte</label>
                </div>
                <!--                    <label class="form-label" for="recusa_transporte">Recusa Transporte</label>-->
                <!--                    <input type="text" name="recusa_transporte"  id="recusa_transporte" maxlength="1" class="form-control  mask-numero" value="--><?//=$linha['recusa_transporte'];?><!--"/>-->
            </div>
        </div>